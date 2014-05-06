<?php

class SLog
{

    private function __construct()
    {
        
    }

    public static function toFile($info)
    {
        $logfile = ABSPATH . 'storage/logs/' . date('Y-m-d') . '.txt';




        $message = date('H:i:s');
        $message.= "\n-------------------------------------\n";
        if (is_array($info)) {
            $message.= print_r($info, true);
        } else {
            $message.= $info;
        }

        $message.= "\n-------------------------------------\n\n\n";



        return file_put_contents($logfile, $message, FILE_APPEND);
    }

}
