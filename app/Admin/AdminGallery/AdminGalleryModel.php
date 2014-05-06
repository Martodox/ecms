<?php

App::$route->
        addMAction('ajaxAddGalleryCategory', 'pl', 'dodaj-kategorie-galerii')->
        addMAction('ajaxEditGalleryCategory', 'pl', 'ajax-edytuj-kategorie-galerii')->
        addMAction('uploadGalleryPhotos', 'pl', 'dodaj-zdjecia')->
        addMAction('listGalleryCategories', 'pl', 'lista-kategorii')->
        addMAction('chooseGalleryToUpload', 'pl', 'wybierz-kategorie-zdjec')->
        addMAction('ajaxShowEditPicture', 'pl', 'ajax-edytuj-obraz');

class AdminGalleryModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        Help::checkLoginRedirect();
        User::assignUserToSmarty();
        if (!ST::isActionSet()) {
            Help::redirect('Admin', 'AdminGallery', 'chooseGalleryToUpload');
        }
        $this->addJS('modal_button', 'notify.min', 'simpleValidator', 'formSubmitBind', 'formSubmit');
    }

    public function ajaxAddGalleryCategory()
    {
        $this->setTpl('addCategory');
    }

    public function ajaxEditGalleryCategory()
    {
        $info = App::$db->
                create('SELECT `id`, `name`, `slug` FROM `gallery_category` WHERE `id` = :id')->
                bind(ST::currentVars(1), 'id')->
                execute();
        App::$smarty->assign('editinfo', $info[0]);
        $this->setTpl('editCategory');
    }

    public function listGalleryCategories()
    {
        $gallery_category = App::$db->simpleQuery('SELECT * FROM gallery_category ORDER BY `order`');
        App::$smarty->assign('gallery_category', $gallery_category);
    }

    public function chooseGalleryToUpload()
    {
        $db = App::$db->
                create('SELECT `id`, `name`, `slug` FROM `gallery_category` ORDER BY `order`')->
                execute();
        App::$smarty->assign('categories', $db);
        $this->setTpl('chooseGallery');
    }

    public function uploadGalleryPhotos()
    {
        $var = ST::currentVars(1);
        if (empty($var)) {
            Help::redirect('Admin', 'AdminGallery', 'chooseGalleryToUpload');
        }

        $this->addCSS('uploader');
        $this->addJS('jquery.knob', 'jquery.ui.widget', 'jquery.iframe-transport', 'jquery.fileupload', 'fileUploader', 'galleryModal');

        $db = App::$db->
                create("SELECT * FROM `gallery_pictures` WHERE `category` = :id ORDER BY `id` DESC")->
                bind(ST::currentVars(1), "id")->
                execute();
        $name = App::$db->
                create("SELECT `name` FROM `gallery_category` WHERE `id` = :id LIMIT 1")->
                bind(ST::currentVars(1), "id")->
                execute();

        App::$smarty->
                assign('gallerypictures', $db)->
                assign('catname', $name[0]['name']);

        $this->setTpl('pictureUpload');
    }

    public function ajaxShowEditPicture()
    {
        $info = App::$db->
                create('SELECT * FROM `gallery_pictures` WHERE `id` = :id')->
                bind(ST::currentVars(1), 'id')->
                execute();
        App::$smarty->assign('editinfo', $info[0]);
        $this->setTpl('editPicture');
    }

}
