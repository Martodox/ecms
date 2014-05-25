<?php

class SLog
{

    public $printStack;

    private function __construct()
    {
        $this->printStack = array();
    }

    public static function instance()
    {
        return new SLog();
    }

    public function addLog($info)
    {
        array_push($this->printStack, $info);
    }

    public function printLog()
    {
        foreach ($this->printStack as $log) {
            Help::printer($log);
        }
    }

    public function logToFile()
    {
        foreach ($this->printStack as $log) {
            self::toFile($log);
        }
    }

    public static function toFile($info)
    {
        $logfile = ABSPATH . 'storage/logs/' . date('Y-m-d') . '.txt';




        $message = date('H:i:s');
        $message.= "\n-------------------------------------\n";
        if (is_string($info)) {
            $message.= $info;
        } else {
            $message.= print_r($info, true);
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
        $ip = Help::getIp();
        App::$db->
                create('INSERT INTO `user_logs` (`user_id`, `user_level`, `timestamp`, `action`, `where`, `what`, `ip`) VALUES (:id, :level, :timestamp, :action, :where, :what, :ip)')->
                bind($user, 'id')->
                bind($level, 'level')->
                bind($time, 'timestamp')->
                bind($action, 'action')->
                bind($where, 'where')->
                bind($what, 'what')->
                bind($ip, 'ip')->
                execute();
    }

}
