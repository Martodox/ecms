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

    public static function logActivity($action, $what = "", $where = "")
    {
        $user = User::getID();
        $level = User::getField('level');
        $time = time();
        $action = ($action == '' ? 'DEFAULT' : $action);
        App::$db->
                create('INSERT INTO `user_logs` (`user_id`, `user_level`, `timestamp`, `action`, `where`, `what`) VALUES (:id, :level, :timestamp, :action, :where, :what)')->
                bind($user, 'id')->
                bind($level, 'level')->
                bind($time, 'timestamp')->
                bind($action, 'action')->
                bind($where, 'where')->
                bind($what, 'what')->
                execute();
    }

}
