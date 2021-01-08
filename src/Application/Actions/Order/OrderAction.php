<?php
declare(strict_types=1);

namespace App\Application\Actions\Order;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\Login\LoginRepository;
use App\Domain\Order\OrderRepository;

abstract class OrderAction extends Action
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @param LoggerInterface $logger
     * @param LoginRepository  $loginRepository
     */
    public function __construct(LoggerInterface $logger, OrderRepository $repo)
    {
        parent::__construct($logger);
        $this->orderRepository = $repo;
    }
}
