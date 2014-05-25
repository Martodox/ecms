<?php

/**
 * Description of DB_gallery_category
 *
 * @author Bartosz Jakubowiak
 * @link http://bartosz.jakubowiak.pl/ Authors home page
 */
class DB_gallery_category extends Database
{

    /**
     * Returns category position based on ID
     * @param int $id
     * @return int
     */
    public static function categoryPosition($id)
    {
        $return = App::$db->
                create('SELECT `order` FROM `gallery_category` WHERE `id` = :id LIMIT 1')->
                bind((int) $id, 'id', 'int')->
                execute();

        return (int) $return[0]['order'];
    }

    /**
     * Returns category ID based on order
     * @param int $order
     * @return int
     */
    public static function idFromOrder($order)
    {
        $return = App::$db->
                create('SELECT `id` FROM `gallery_category` WHERE `order` = :order LIMIT 1')->
                bind((int) $order, 'order', 'int')->
                execute();
        return (int) $return[0]['id'];
    }

    /**
     * Swaps gallery category order
     * @param int $oldPos
     * @param int $oldID
     * @param int $newPos
     * @param int $id
     */
    public static function swapPositions($oldPos, $oldID, $newPos, $id)
    {
        App::$db->
                create("UPDATE `gallery_category` SET `order` = :order WHERE `id` = :id")->
                bind((int) $oldPos, 'order', 'int')->
                bind((int) $oldID, 'id', 'int')->
                execute()->
                bind((int) $newPos, 'order', 'int')->
                bind((int) $id, 'id', 'int')->
                execute();
    }

}
