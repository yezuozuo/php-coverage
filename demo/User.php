<?php
/**
 * Created by PhpStorm.
 * User: zoco
 * Date: 16/10/31
 * Time: 11:37
 */

class User
{
    public $id;
    public $name;
    public $email;

    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}