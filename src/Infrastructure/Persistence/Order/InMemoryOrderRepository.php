<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Order;

use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository;
use App\Domain\Order\OrderNotFoundException;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;


class InMemoryOrderRepository implements OrderRepository
{


    /**
     * @var OrderRepository
     *
     */
    private $OrderRepository;

    private $logger;

    private $entityManager;

    /**
     * InMemoryOrderRepository constructor.
     *
     * @param array|null $Orders
     */
    public function __construct(LoggerInterface $logger,OrderRepository $OrderRepository, EntityManager $entityManager)
    {
        $this->OrderRepository = $OrderRepository;
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $Orderrepo = $this->entityManager->getRepository(Order::class);
        $res = $Orderrepo->findAll();
        return $res;

    }

    /**
     * {@inheritdoc}
     */
    public function findOrderOfId(int $id): Order
    {
        $Orderrepo = $this->entityManager->getRepository(Order::class);
        $val = $Orderrepo->findOneBy(array('idOrder' => $id));
        if($val == null)
        {
            throw new OrderNotFoundException;
        }
        return $val;
    }
    
    public function createOrder(Order $Order) : bool
    {
        $this->logger->debug("Order created");
        $this->entityManager->persist($Order);
        $this->entityManager->flush();
        return true;
        
    }
}
