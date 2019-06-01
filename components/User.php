<?php
class User
{
    public $id;
    public $username;
    public $name;
    public $login;
    public $active;
    public $email;
    //Constructor
    function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
    //Setters
    function setName($name)
    {
        $this->name = $name;
    }
    function setUsername($username)
    {
        $this->username = $username;
    }
    function setEmail($email)
    {
        $this->email = $email;
    }
    function setActive($active)
    {
        $this->active = $active;
    }
    function setUserLogin($login)
    {
        $this->login = $login;
    }
    //Getter
    function getName()
    {
        return $this->name;
    }
    function getEmail($email)
    {
        return $this->email;
    }
    function getActive($active)
    {
        return $this->active;
    }
    function getUserLogin($login)
    {
        return $this->login;
    }
    function getUsername()
    {
        return $this->username;
    }
}
