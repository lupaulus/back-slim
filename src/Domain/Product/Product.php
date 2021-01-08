<?php
declare(strict_types=1);

namespace App\Domain\Product;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity
 */
class Product implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProduct", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_id_seq", allocationSize=1, initialValue=1)
     */
    private $idProduct;

    /**
     * @var int
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     * 
     * @ORM\Column(name="description", type="string", length=256, nullable=true)
     */
    private $desc;
    /**
     * @var float
     * 
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     * 
     * @ORM\Column(name="image", type="string", length=256, nullable=true)
     */
    private $image;
    

    public function __construct(){}

    function set($data)
    {
        foreach ($data AS $key => $value) 
        {
            $this->{$key} = $value;
        }
    }
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        
        return [
            'id' => $this->idProduct,
            'name' => $this->name,
            'desc' => $this->desc,
            'price' => $this->price,
            'image' => $this->image
        ];
    }

}
