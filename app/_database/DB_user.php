<?php

/**
 * Description of DB_user
 *
 * @author Bartosz Jakubowiak
 * @link http://bartosz.jakubowiak.pl/ Authors home page
 */
class DB_user extends Database
{

    /**
     * 
     * @param string $email
     * @return boolean
     * @return string
     */
    public static function getSalt($email)
    {
        $return = App::$db->
                create('SELECT salt FROM user WHERE email = :email AND `active` = 1 LIMIT 1')->
                bind($email, 'email')->
                execute();
        if (empty($return)) {
            return false;
        }
        return $return[0]['salt'];
    }

    /**
     * 
     * @param string $email 
     * @param string $password
     * @return boolean
     * @return array
     */
    public static function authenticateUser($email, $password)
    {
        $return = App::$db->
                create('SELECT * FROM user WHERE password = :password AND email = :email LIMIT 1')->
                bind($password, 'password')->
                bind($email, 'email')->
                execute();

        if (empty($return)) {
            return false;
        }
        return $return[0];
    }

    /**
     * 
     * @param int $id valid user ID
     * @return void
     */
    public static function updateLastActivity($id = null)
    {
        if ($id == null) {
            $id = User::getID();
        }

        App::$db->
                create('UPDATE `user` SET `lastactivity` = :time WHERE `id` = :id')->
                bind((int) $id, 'id')->
                bind(time(), 'time')->
                execute();
    }

    /**
     * 
     * @param int $id valid user ID
     * @return unixtimestamp 
     */
    public static function getLastActivity($id = null)
    {
        if ($id == null) {
            $id = User::getID();
        }

        $return = App::$db->
                create('SELECT `lastactivity` FROM `user`  WHERE `id` = :id LIMIT 1')->
                bind((int) $id, 'id')->
                execute();

        if (empty($return)) {
            return false;
        }
        return $return[0]['lastactivity'];
    }

}
