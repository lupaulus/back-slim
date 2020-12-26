<?php
declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Userdb
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="user_id_client_seq", allocationSize=1, initialValue=1)
     */
    private $id;
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
    * @ORM\OneToOne(targetEntity=Login::class)
    */
    private $login;


    public function __construct()
    {}

    public static function constructClassic(?int $id, string $username,string $password, string $firstName, string $lastName, 
    string $address, string $zipcode, string $tel, string $city, string $mail, string $country) : User
    {
        $u = new User();
        $u->id = $id;
        $u->username = $username;
        $u->password = $password;
        $u->firstName = ucfirst($firstName);
        $u->lastName = ucfirst($lastName);
        $u->address = $address;
        $u->zipcode = $zipcode;
        $u->tel = $city;
        $u->mail = $mail;
        $u->country = $country;
        return $u;
    }

    function set($data)
    {
        foreach ($data AS $key => $value) 
        {
            $this->{$key} = $value;
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of zipcode
     */ 
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Get the value of tel
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

        /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'civilite' => $this->civilite,
            'username' => $this->username,
            'password' => $this->password,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'address' => $this->address,
            'zipcode' => $this->zipcode,
            'tel' => $this->tel,
            'city' => $this->tel,
            'mail' => $this->mail,
            'country' => $this->country
        ];
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of civilite
     *
     * @return  self
     */ 
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
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

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }



    /**
     * Set the value of zipcode
     *
     * @return  self
     */ 
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }


    /**
     * Set the value of tel
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

}
