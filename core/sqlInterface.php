<?php

interface sqlInterface
{

    static function instance();

    static function create($query);

    function bind($value, $name, $type = "str");

    static function simpleQuery($query = null, $forceReturn = false);

    function execute();
}
