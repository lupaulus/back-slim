<?php
declare(strict_types=1);

namespace App\Domain\Order;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;
use App\Domain\Product\Product;
use App\Domain\User\User;

/**
 * Order
 *
 * @ORM\Table(name="orderbase")
 * @ORM\Entity
 */
class Order implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="idOrder", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="order_id_seq", allocationSize=1, initialValue=1)
     */
    private $idOrder;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\User\User")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     */
    private $idUser;

    /**
     * @var ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="App\Domain\Product\Product")
     * @ORM\JoinTable(name="orders_product",
     * joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="idOrder")},
     * inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="idProduct", unique=false)})
     */
    private $products;
    

    public function __construct(){
        $this->products = new ArrayCollection();
    }

    function set($data)
    {
        foreach ($data AS $key => $value) 
        {
            $this->{$key} = $value;
        }
    }

    function setUser(User $user){
        $this->idUser = $user;
    }

    function addProduct(Product $p)
    {
        $this->products->add($p);
    }
    /**
     * @return array
     */
    public function jsonSerialize()
    {

        return [
            'id' => $this->idOrder,
            // 'idUser' => json_encode($this->idUser),
            'products' => json_encode($this->products)
        ];
    }

    
}
