<?php
declare(strict_types=1);

namespace App\Domain\Login;

use JsonSerializable;
use Logindb;

class Login implements JsonSerializable
{
    /**
     * @var string
     */
    private  $username;

    /**
     * @var string
     */
    private  $password;

    public function __construct(){}

    public static function Construct($a) : Login
    {
        $l = new Login();
        $l->username = $a->username;
        $l->password = $a->password;
        return $l;
    }

 
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
        ];
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}
