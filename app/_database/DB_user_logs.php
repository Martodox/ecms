<?php

/**
 * Description of DB_user_extra
 *
 * @author Bartosz Jakubowiak
 * @link http://bartosz.jakubowiak.pl/ Authors home page
 */
class DB_user_logs extends Database
{

    /**
     * Returns number of failed logins for a given IP
     * @param 255.255.255.255 $ip
     * @return int Number of current failed login attempts for given IP
     */
    public static function ipLoginAttempts($ip = null)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            $ip = Help::getIp();
        }
        $return = App::$db->
                create('SELECT count(user_id) as attempts FROM user_logs WHERE ip = :ip AND `timestamp` > :timenow AND `action` = :action AND `what` = :what')->
                bind($ip, 'ip')->
                bind(time() - 1200, 'timenow')->
                bind('FAILLOGIN', 'action')->
                bind('A', 'what')->
                execute();

        return $return[0]['attempts'];
    }

    /**
     * Resets failed logins for a given IP
     * @param 255.255.255.255 $ip
     * @return void
     */
    public static function resetLoginAttempts($ip = null)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            $ip = Help::getIp();
        }
        App::$db->
                create('UPDATE user_logs SET what = :what WHERE `action` = :action AND `ip` = :ip')->
                bind($ip, 'ip')->
                bind('FAILLOGIN', 'action')->
                bind(null, 'what')->
                execute();
    }

}
