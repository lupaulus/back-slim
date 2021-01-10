<?php
declare(strict_types=1);

namespace App\Application\Actions\Order;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Application\Actions\Product\ProductAsAction;
use App\Domain\Order\OrderRepository;
use App\Domain\Product\ProductRepository;
use App\Domain\User\UserRepository;

abstract class OrderAction extends Action
{
    protected $productRepository;
    protected $userRepository;
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @param LoggerInterface $logger
     * @param OrderRepository  $loginRepository
     */
    public function __construct(LoggerInterface $logger, OrderRepository $repo,ProductRepository $productRepository, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->orderRepository = $repo;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
    }
}
