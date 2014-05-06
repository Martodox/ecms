<?php

class Upload
{

    protected $directory;
    protected $rootDir;
    protected $newFileName;
    private static $allowed = array('png', 'jpg', 'gif', 'jpeg');

    private function __construct()
    {
        $this->rootDir = strstr(getcwd(), 'includes', true);
    }

    public static function handle()
    {
        return new Upload;
    }

    public function setDirectory($dir)
    {
        $this->directory = $this->rootDir . 'storage/upload/' . $dir . '/';
        return $this;
    }

    public function setNewFileName($newFileName)
    {
        $this->newFileName = $newFileName;
        return $this;
    }

    public function upload($file)
    {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $return = array();
        $return['error'] = false;
        $return['message'] = "";
        if (in_array(strtolower($extension), static::$allowed)) {
            $name = explode(".", basename($file['name']));
            $name = $this->newFileName . "." . $name[count($name) - 1];
            if (!is_dir($this->directory)) {
                mkdir($this->directory, 0777);
            }

            $fileToUpload = $this->directory . $name;
            move_uploaded_file($file['tmp_name'], $fileToUpload);
            $return['name'] = $name;
        } else {
            $return['message'] .= "extention not allowed,";
            $return['error'] = true;
        }
        $return['code'] = $file['error'];
        return $return;
    }

    public function remove($file)
    {
        unlink($this->directory . $file);
    }

}
