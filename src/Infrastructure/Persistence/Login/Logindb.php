<?php

use App\Domain\Login\Login;
use Doctrine\ORM\Mapping as ORM;

/**
 * Logindb
 *
 * @ORM\Table(name="login")
 * @ORM\Entity
 */
class Logindb
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="login_id_user_seq", allocationSize=1, initialValue=1)
     */
    private $idLogin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=256, nullable=true)
     */
    private $password;


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

    public function convert() : Login
    {
        $res = new Login();
        $res->setUsername($this->username);
        $res->setPassword($this->password);
        return $res;
    }
}
