<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Product;

use App\Domain\Login\Login;
use App\Domain\Login\LoginRepository;
use App\Domain\Login\LoginNotFoundException;
use App\Domain\Product\Product;
use App\Domain\Product\ProductNotFoundException;
use App\Domain\Product\ProductRepository;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;


class InMemoryProductRepository implements ProductRepository
{

    private $logger;

    private $entityManager;

    /**
     * InMemoryProductRepository constructor.
     *
     * @param array|null $Products
     */
    public function __construct(LoggerInterface $logger, EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;

        $this->logger->debug("CreateObjProduit");
        $arrayp = json_decode($this->rawContent);
        foreach($arrayp as $product)
        {
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $repo = $this->entityManager->getRepository(Product::class);
        return $repo->findAll();

    }

    /**
     * {@inheritdoc}
     */
    public function findProductOfId(int $id): Product
    {
        $loginrepo = $this->entityManager->getRepository(Product::class);
        $val = $loginrepo->findOneBy(array('idProduct' => $id));
        if($val == null)
        {
            throw new ProductNotFoundException;
        }
        return $val;
    }
    
    public function createProduct(Product $Product) : bool
    {
        $this->logger->debug("Product created");
        $Productrepo = $this->entityManager->getRepository(Product::class);
        $this->entityManager->persist($Product);
        $this->entityManager->flush();
        return true;
    }

    private $rawContent =   
    '[
        {
           "id":"1",
           "nom":"Estomac de Porc Farci",
           "image":"https://www.alsace-charcuterie.fr/store/61-large_default/estomac-de-porc-farci-2-kg.jpg",
           "desc":"Produit phare qui a fait la réputation de notre établissement, lestomac de porc est farci à bse d\'épaule de porc, de pommes de terres, de poireaux, de carottes, d\'oignon,d\'épices»",
           "prix":"18"
        },
        {
           "id":"2",
           "nom":"Saucisse de Pommes de Terre",
           "image":"https://www.alsace-charcuterie.fr/store/71-large_default/saucisse-de-pommes-de-terre-500-gr.jpg",
           "desc":"Repas complet qui allie une viande de porc finement hachée et parfumée au vin blanc dAlsace avec des dés de pommes de terre et des fins morceaux de carottes et de poireaux entonné dans du boyau.",
           "prix":"16"
        },
        {
           "id":"3",
           "nom":"Boudin",
           "image":"https://www.alsace-charcuterie.fr/store/24-large_default/boudin-noir-traditionnel-370-gr.jpg",
           "desc":"Paquet de 3 pièces Le boudin noir est un produit cuit à base de sang, de gras, de tête de porc, doignons et damidon entonné dans du boyau.",
           "prix":"12"
        }
     ]';
   
}
