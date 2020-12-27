<?php
declare(strict_types=1);

namespace App\Domain\Login;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Table(name="login")
 * @ORM\Entity
 */
class Login implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLogin", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="login_id_Login_seq", allocationSize=1, initialValue=1)
     */
    private $idLogin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=true)
     */
    private  $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=256, nullable=true)
     */
    private  $password;

    public function __construct(){}

 
        /**
     * Get idLogin.
     *
     * @return int
     */
    public function getIdLogin()
    {
        return $this->idLogin;
    }

    /**
     * Set username.
     *
     * @param string|null $username
     *
     * @return Logindb
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return Logindb
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
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
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
        ];
    }

    function set($data)
    {
        foreach ($data AS $key => $value) 
        {
            $this->{$key} = $value;
        }
    }

}
