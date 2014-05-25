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

}
