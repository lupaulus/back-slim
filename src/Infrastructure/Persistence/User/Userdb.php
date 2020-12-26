<?php


use App\Domain\User\User;
use App\Infrastructure\Persistence\Login\InMemoryLoginRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Userdb
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class Userdb
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="user_id_client_seq", allocationSize=1, initialValue=1)
     */
    private $idUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="civilite", type="string", length=30, nullable=true)
     */
    private $civilite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstName", type="string", length=30, nullable=true)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastName", type="string", length=30, nullable=true)
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=30, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zipcode", type="string", length=30, nullable=true)
     */
    private $zipcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=30, nullable=true)
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=30, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=30, nullable=true)
     */
    private $mail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=30, nullable=true)
     */
    private $country;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idLogin", type="integer", nullable=true)
     */
    private $idLogin;


    /**
     * Get idUser.
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set civilite.
     *
     * @param string|null $civilite
     *
     * @return Userdb
     */
    public function setCivilite($civilite = null)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite.
     *
     * @return string|null
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set firstName.
     *
     * @param string|null $firstName
     *
     * @return Userdb
     */
    public function setFirstName($firstName = null)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string|null $lastName
     *
     * @return Userdb
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return Userdb
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipcode.
     *
     * @param string|null $zipcode
     *
     * @return Userdb
     */
    public function setZipcode($zipcode = null)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode.
     *
     * @return string|null
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set tel.
     *
     * @param string|null $tel
     *
     * @return Userdb
     */
    public function setTel($tel = null)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel.
     *
     * @return string|null
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Userdb
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set mail.
     *
     * @param string|null $mail
     *
     * @return Userdb
     */
    public function setMail($mail = null)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail.
     *
     * @return string|null
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set country.
     *
     * @param string|null $country
     *
     * @return Userdb
     */
    public function setCountry($country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set idLogin.
     *
     * @param int|null $idLogin
     *
     * @return Userdb
     */
    public function setIdLogin($idLogin = null)
    {
        $this->idLogin = $idLogin;

        return $this;
    }

    /**
     * Get idLogin.
     *
     * @return int|null
     */
    public function getIdLogin()
    {
        return $this->idLogin;
    }

    public function convert() : User
    {
        $res = new User();
        $res->setCivilite($this->civilite);
        $res->setFirstName($this->firstName);
        $res->setLastName($this->lastName);
        $res->setAddress($this->address);
        $res->setZipcode($this->zipcode);
        $res->setTel($this->tel);
        $res->setCity($this->city);
        $res->setMail($this->mail);
        $res->setCountry($this->country);
    

        $lrepo = new InMemoryLoginRepository();
        $login = $lrepo->findLoginOfId($res->idLogin);
        
        $res->setPassword($login->getPassword());
        $res->setUsername($login->getUsername());
        
        return $res;
    }
}
