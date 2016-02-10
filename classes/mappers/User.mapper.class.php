<?php

/**
 * Created by PhpStorm.
 * User: Eleonora
 * Date: 10.02.2016
 * Time: 14:57
 */
class ModuleValidate_MapperUser
{
    protected $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function saveUser()
    {
        $allowed = array('first_name', 'last_name', 'patronymic', 'email', 'phone', 'password');
        $sql = "INSERT INTO user SET ". $this->insertPDO($allowed, $values);
        $res = $this->db->prepare($sql)->execute($values);
        return $res;
    }

    private function insertPDO($allowed, &$values, $source = array())
    {
        $set = '';
        $values = array();
        if (!$source) $source = &$_POST;
        foreach ($allowed as $field) {
            if (isset($source[$field])) {
                $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
                $values[$field] = $source[$field];
            }
        }
        return substr($set, 0, -2);
    }
}