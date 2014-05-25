<?php

class Help
{

    public static function printer()
    {
        $ar = func_get_args();
        echo '<pre>';

        foreach ($ar as $array) {
            if (!is_array($array)) {
                $array = array($array);
            }
            print_r($array);
            echo "-------------------------------------------------------------------------\n";
        }
        echo '</pre>';
    }

    public static function dumprint($arr)
    {
        echo '<pre>';
        var_dump($arr);
        echo '<pre>';
    }

    public static function uniqueId()
    {
        return sha1(mt_rand() . uniqid() . mt_rand() . uniqid() . mt_rand() . uniqid());
    }

    public static function getSalt()
    {
        return hash('sha256', mt_rand() . uniqid() . mt_rand() . uniqid() . mt_rand() . uniqid());
    }

    public static function getIp()
    {
        if ($_SERVER['REMOTE_ADDR'] == "::1" || $_SERVER['REMOTE_ADDR'] == "::" || !preg_match("/^((?:25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9]).){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9]?[0-9])$/m", $_SERVER['REMOTE_ADDR'])) {
            $ip = '127.0.0.1';
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }
        return '0.0.0.0';
    }

    public static function getRandString($len)
    {
        return strtoupper(substr(rtrim(base64_encode(md5(microtime())), "="), 0, $len));
    }

    public static function serverVar($where, $name = null, $escape = false)
    {
//get secure var from post, get, and cookie arrays
//work needs to be done to secure it even further
        $var = null;
        switch ($where) {
            case 'post':
                if ($name === null) {
                    $var = $_POST;
                } else {
                    if (!empty($_POST[$name])) {
                        $var = $_POST[$name];
                    }
                }
                break;
            case 'get':
                if ($name === null) {
                    $var = $_GET;
                } else {
                    if (!empty($_GET[$name])) {
                        $var = $_GET[$name];
                    }
                }
                break;
            case 'session':
                if ($name === null) {
                    $var = $_SESSION;
                } else {
                    if (!empty($_SESSION[$name])) {
                        $var = $_SESSION[$name];
                    }
                }
                break;
            case 'cookie':
                if ($name === null) {
                    $var = $_COOKIE;
                } else {
                    if (!empty($_COOKIE[$name])) {
                        $var = $_COOKIE[$name];
                    }
                }
                break;
            default:
                $name = 'post';
                $var = null;
                break;
        }
        if (is_array($var) || !$escape) {
            return $var;
        }
        return htmlspecialchars($var);
    }

    public static function redirect($pacage = null, $controll = null, $action = null, $var = null)
    {

        $location = rootpatch;
        $location = ($pacage !== null) ? $location = $location . App::$route->returnPacage($pacage) . '/' : $location;
        $location = ($controll !== null) ? $location = $location . App::$route->returnComponent($controll) . '/' : $location;
        $location = ($action !== null) ? $location = $location . App::$route->returnAction($action) . '/' : $location;
        $location = ($var !== null) ? $location = $location . $var . '/' : $location;
        header("Location: " . $location);
        die();
    }

    public static function isActionSet($name = null)
    {
        $action = App::$route->getGlobalRewrite();
        $action = $action['action'];

        if (!empty($action) && $name === null) {
            return true;
        }

        if (!empty($action)) {
            if ($action == $name) {
                return true;
            }
        }

        return false;
    }

    public static function isLoggedIn()
    {
        $var = $_SESSION['user']['logged'];
        if (empty($var)) {
            return false;
        }
        return $var;
    }

    public static function saltPassword($password, $salt)
    {
        return hash('sha256', $password . $salt);
    }

    public static function getVar($number = -1)
    {
        if ($number < 0) {
            $var = App::$route->getGlobalRewrite();
            if (!empty($var['vars'])) {
                $var = $var['vars'];
            }

            if (!empty($var)) {
                return $var;
            }
        } else {
            $number--;
            $var = App::$route->getGlobalRewrite();
            if (!empty($var['vars'][$number])) {
                $var = $var['vars'][$number];
            }

            if (!empty($var)) {
                return $var;
            }
        }
        return false;
    }

    public static function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function ajaxSimplifyObjectArray($array)
    {
        $data = array();
        foreach ($array as $arrays) {
            foreach ($arrays as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }

    public static function ajaxAuthenticateRequest()
    {

        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            self::redirect();
        }
    }

    public static function dbCheckIfValueExists($table, $field, $value)
    {
        $res = App::$db->
                create('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :value')->
                bind($value, 'value')->
                execute();
        if (empty($res)) {
            return false;
        } else {
            return true;
        }
    }

    public static function validatePassword($password, $password2, $oldPassword = "old")
    {

        if ($password !== $password2 || empty($password) || empty($password2) || empty($oldPassword)) {
            return false;
        } else {
            if (strlen($password) < 6) {
                return false;
            }
            return true;
        }
    }

    public static function slug($str, $replace = array(), $delimiter = '-')
    {
        setlocale(LC_ALL, 'en_US.UTF8');
        if (!empty($replace)) {
            $str = str_replace((array) $replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    public static function thumbnailDisplay($url, $width = false, $height = false, $maxw = false, $maxh = false)
    {
        $sImagePath = $url;

        $iThumbnailWidth = (int) $width;
        $iThumbnailHeight = (int) $height;
        $iMaxWidth = (int) $maxw;
        $iMaxHeight = (int) $maxh;

        if ($iMaxWidth && $iMaxHeight)
            $sType = 'scale';
        else if ($iThumbnailWidth && $iThumbnailHeight)
            $sType = 'exact';

        $img = NULL;

        $sExtension = strtolower(end(explode('.', $sImagePath)));
        if ($sExtension == 'jpg' || $sExtension == 'jpeg') {

            $img = @imagecreatefromjpeg($sImagePath)
                    or die("Cannot create new JPEG image");
        } else if ($sExtension == 'png') {

            $img = @imagecreatefrompng($sImagePath)
                    or die("Cannot create new PNG image");
        } else if ($sExtension == 'gif') {

            $img = @imagecreatefromgif($sImagePath)
                    or die("Cannot create new GIF image");
        }

        if ($img) {

            $iOrigWidth = imagesx($img);
            $iOrigHeight = imagesy($img);

            if ($sType == 'scale') {

                // Get scale ratio

                $fScale = min($iMaxWidth / $iOrigWidth, $iMaxHeight / $iOrigHeight);

                if ($fScale < 1) {

                    $iNewWidth = floor($fScale * $iOrigWidth);
                    $iNewHeight = floor($fScale * $iOrigHeight);

                    $tmpimg = imagecreatetruecolor($iNewWidth, $iNewHeight);

                    imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);

                    imagedestroy($img);
                    $img = $tmpimg;
                }
            } else if ($sType == "exact") {

                $fScale = max($iThumbnailWidth / $iOrigWidth, $iThumbnailHeight / $iOrigHeight);

                if ($fScale < 1) {

                    $iNewWidth = floor($fScale * $iOrigWidth);
                    $iNewHeight = floor($fScale * $iOrigHeight);

                    $tmpimg = imagecreatetruecolor($iNewWidth, $iNewHeight);
                    $tmp2img = imagecreatetruecolor($iThumbnailWidth, $iThumbnailHeight);

                    imagecopyresampled($tmpimg, $img, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $iOrigWidth, $iOrigHeight);

                    if ($iNewWidth == $iThumbnailWidth) {

                        $yAxis = ($iNewHeight / 2) -
                                ($iThumbnailHeight / 2);
                        $xAxis = 0;
                    } else if ($iNewHeight == $iThumbnailHeight) {

                        $yAxis = 0;
                        $xAxis = ($iNewWidth / 2) -
                                ($iThumbnailWidth / 2);
                    }

                    imagecopyresampled($tmp2img, $tmpimg, 0, 0, $xAxis, $yAxis, $iThumbnailWidth, $iThumbnailHeight, $iThumbnailWidth, $iThumbnailHeight);

                    imagedestroy($img);
                    imagedestroy($tmpimg);
                    $img = $tmp2img;
                }
            }

            header("Content-type: image/jpeg");
            imagejpeg($img);
        }
    }

    public static function ajaxJSON($msg = '', $json = true)
    {
        if (!empty($msg) && $json) {
            echo json_encode($msg);
        } elseif (is_string($msg)) {
            echo $msg;
        }

        exit;
    }

}
