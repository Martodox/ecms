<?php

App::$route->
        addCAction('moveCatUp', 'pl', 'kategoria-wyzej', 'en', 'category-up')->
        addCAction('moveCatDown', 'pl', 'kategoria-nizej', 'en', 'category-down')->
        addCAction('ajaxSaveGalleryCat', 'pl', 'zapisz-kategorie-galerii')->
        addCAction('ajaxDelGalleryCat', 'pl', 'skasuj-kategorie-galerii')->
        addCAction('ajaxEditGalleryCat', 'pl', 'zapisz-zmiany-kategorii')->
        addCAction('AdminGalleryChangeStatus', 'pl', 'zmien-publicznosc-galerii')->
        addCAction('ajaxSimpleUpload', 'pl', 'wgraj-zdjecia')->
        addCAction('ajaxRemovePicture', 'pl', 'skasuj-zdjecie');

class AdminGalleryController extends Controller
{

    public function moveCatUp()
    {
        $this->model->hideTemplate();
        self::toggleOrder('up');
    }

    public function moveCatDown()
    {
        $this->model->hideTemplate();
        self::toggleOrder('down');
    }

    private static function toggleOrder($dir)
    {
        Help::ajaxAuthenticateRequest();
        $id = json_decode(Help::serverVar('post', 'data'));
        $pos = App::$db->
                create('SELECT `order` FROM `gallery_category` WHERE `id` = :id')->
                bind((int) $id, 'id', 'int')->
                execute();

        $oldPos = $pos[0]['order'];
        $newPos = ($dir == 'up' ? $pos[0]['order'] - 1 : $pos[0]['order'] + 1);

        $oldID = App::$db->
                create('SELECT `id` FROM `gallery_category` WHERE `order` = :order')->
                bind((int) $newPos, 'order', 'int')->
                execute();
        $oldID = $oldID[0]['id'];


        App::$db->
                create("UPDATE `gallery_category` SET `order` = :order WHERE `id` = :id")->
                bind((int) $oldPos, 'order', 'int')->
                bind((int) $oldID, 'id', 'int')->
                execute()->
                bind((int) $newPos, 'order', 'int')->
                bind((int) $id, 'id', 'int')->
                execute();

        $return['token'] = Model::newToken();
        echo json_encode($return);
    }

    public function ajaxSaveGalleryCat()
    {
        Help::ajaxAuthenticateRequest();


        $json = json_decode(Help::serverVar('post', 'data'));

        $data = Help::ajaxSimplifyObjectArray($json);

        $isEmpty = false;
        foreach ($data as $value) {
            if (empty($value)) {
                $isEmpty = true;
                break;
            }
        }

        $msg = '';
        $error = false;
        $token = Model::validateToken($data['csrftoken']);
        $return = array();
        $name = $data['name'];
        $slug = Help::slug($name);
        if (!$isEmpty && $token) {

            if (Help::dbCheckIfValueExists('gallery_category', 'slug', $slug)) {
                $msg = $msg . ',nameexists';
                $error = true;
            }
        } else {
            if (!$token) {
                $msg = $msg . ',badtoken';
            }
            $error = true;
            $msg = $msg . ',generalerror';
        }

        if (!$error) {

            $order = App::$db->simpleQuery("SELECT count(id) as `sum` FROM gallery_category");
            $order = $order[0]['sum'] + 1;

            App::$db->
                    create('INSERT INTO gallery_category (`order`, `name`, `slug`, `active`) VALUES (:order, :name, :slug, :active)')->
                    bind($order, 'order')->
                    bind($name, 'name')->
                    bind($slug, 'slug')->
                    bind(0, 'active')->
                    execute();
            SLog::logActivity('ADDGALLERY', $name);
        }

        $return['token'] = Model::newToken();
        $return['error'] = $error;
        $return['msg'] = $msg;
        echo json_encode($return);

        $this->model->hideTemplate();
    }

    public function ajaxEditGalleryCat()
    {
        Help::ajaxAuthenticateRequest();


        $json = json_decode(Help::serverVar('post', 'data'));

        $data = Help::ajaxSimplifyObjectArray($json);

        $isEmpty = false;
        foreach ($data as $value) {
            if (empty($value)) {
                $isEmpty = true;
                break;
            }
        }

        $msg = '';
        $error = false;
        $token = Model::validateToken($data['csrftoken']);
        $return = array();
        $name = $data['categoryname'];
        $id = $data['catid'];
        $slug = Help::slug($data['seoname']);
        if (!$isEmpty && $token) {

            $db = App::$db->
                    create('SELECT `name`, `slug` FROM `gallery_category` WHERE `id` = :id')->
                    bind($id, 'id')->
                    execute();

            if ($db[0]['name'] !== $name) {
                if (Help::dbCheckIfValueExists('gallery_category', 'name', $name)) {
                    $msg = $msg . ',nameexists';
                    $error = true;
                }
            }
            if ($db[0]['slug'] !== $slug) {
                if (Help::dbCheckIfValueExists('gallery_category', 'slug', $slug)) {
                    $msg = $msg . ',slugexists';
                    $error = true;
                }
            }
        } else {
            if (!$token) {
                $msg = $msg . ',badtoken';
            }
            $error = true;
            $msg = $msg . ',generalerror';
        }

        if (!$error) {
            App::$db->
                    create('UPDATE gallery_category SET `name` = :name, `slug` = :slug WHERE `id` = :id')->
                    bind($name, 'name')->
                    bind($slug, 'slug')->
                    bind($id, 'id')->
                    execute();
            SLog::logActivity('EDITGALLERY', $name);
        }

        $return['token'] = Model::newToken();
        $return['error'] = $error;
        $return['msg'] = $msg;
        echo json_encode($return);
        $this->model->hideTemplate();
    }

    public function ajaxRemovePicture()
    {

        Help::ajaxAuthenticateRequest();

        $json = json_decode(Help::serverVar('post', 'data'));

        $data = Help::ajaxSimplifyObjectArray($json);

        $isEmpty = false;
        foreach ($data as $value) {
            if (empty($value)) {
                $isEmpty = true;
                break;
            }
        }

        $msg = '';
        $error = false;
        $token = Model::validateToken($data['csrftoken']);
        $return = array();
        $id = $data['pictureid'];
        if ($token) {


            $filename = App::$db->
                    create("SELECT p.filename, c.name AS category FROM gallery_pictures p LEFT JOIN gallery_category c ON p.category = c.id WHERE  p.id= :id LIMIT 1")->
                    bind($id, 'id')->
                    execute();
            $categoryname = $filename[0]['category'];
            $filename = $filename[0]['filename'];

            Upload::handle()->
                    setDirectory('gallery')->
                    remove($filename);

            App::$db->
                    create("DELETE FROM `gallery_pictures` WHERE  `id`= :id")->
                    bind($id, 'id')->
                    execute();
            SLog::logActivity('REMOVEPICTURE', $categoryname);
        } else {
            if (!$token) {
                $msg = $msg . ',badtoken';
            }
            $error = true;
            $msg = $msg . ',generalerror';
        }

        $return['token'] = Model::newToken();
        $return['error'] = $error;
        $return['msg'] = $msg;
        $return['pictureid'] = $id;
        echo json_encode($return);
        $this->model->hideTemplate();
    }

    public function ajaxDelGalleryCat()
    {

        Help::ajaxAuthenticateRequest();


        $json = json_decode(Help::serverVar('post', 'data'));

        $data = Help::ajaxSimplifyObjectArray($json);

        $isEmpty = false;
        foreach ($data as $value) {
            if (empty($value)) {
                $isEmpty = true;
                break;
            }
        }

        $msg = '';
        $error = false;
        $token = Model::validateToken($data['csrftoken']);
        $return = array();
        $id = $data['catid'];
        if ($token) {
            $name = App::$db->
                    create("SELECT name FROM `gallery_category` WHERE  `id`= :id")->
                    execute()->
                    create("DELETE FROM `gallery_category` WHERE  `id`= :id")->
                    bind($id, 'id');
            SLog::logActivity('DELETECAT', $name[0]['name']);
        } else {
            if (!$token) {
                $msg = $msg . ',badtoken';
            }
            $error = true;
            $msg = $msg . ',generalerror';
        }

        $return['token'] = Model::newToken();
        $return['error'] = $error;
        $return['msg'] = $msg;
        echo json_encode($return);
        $this->model->hideTemplate();
    }

    /**
     * 
     * @return ArrayObject
     */
    public function AdminGalleryChangeStatus()
    {
        Help::ajaxAuthenticateRequest();
        $this->model->hideTemplate();
        $id = ST::currentVars(1);
        $status = App::$db->
                create('UPDATE `gallery_category` SET `active` = 1 - `active` WHERE `id` = :id')->
                bind((int) $id, 'id', 'int')->
                execute()->
                create('SELECT `active` FROM `gallery_category` WHERE `id` = :id')->
                bind((int) $id, 'id', 'int')->
                execute();
        $return['token'] = Model::newToken();
        $return['status'] = $status[0]['active'];

        if ($return['status'] == 1) {
            $return['tooltip'] = ST::gD('clicktohide');
            $return['button'] = ST::gD('yes');
        } else {
            $return['tooltip'] = ST::gD('clicltomakeublic');
            $return['button'] = ST::gD('no');
        }



        Help::ajaxJSON($return);
    }

    public function ajaxSimpleUpload()
    {
        $filename = Help::uniqueId();
        $upload = Upload::handle()->
                setDirectory('gallery')->
                setNewFileName($filename)->
                upload($_FILES['upl']);

        if (!$upload['error']) {
            $lastID = App::$db->
                    create('INSERT INTO `gallery_pictures` (`category`, `filename`) VALUES (:id, :filename);')->
                    bind(ST::currentVars(1), 'id')->
                    bind($upload['name'], 'filename')->
                    execute()->
                    lastId();
            $name = App::$db->
                    create("SELECT name FROM `gallery_category` WHERE  `id`= :id")->
                    bind(ST::currentVars(1), 'id')->
                    execute();
            SLog::logActivity('ADDPICTURE', $name[0]['name']);
        }
        $return['name'] = $upload['name'];
        $return['id'] = $lastID;
        $return['link'] = rootpatch . ST::gP('Admin') . '/' . ST::gC('AdminGallery') . '/' . ST::gAM('ajaxShowEditPicture') . '/' . $lastID;

        $this->model->hideTemplate();
        echo json_encode($return);
    }

}
