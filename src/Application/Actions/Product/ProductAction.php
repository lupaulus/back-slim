<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\Product\ProductRepository;

abstract class ProductAction extends Action
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param LoggerInterface $logger
     * @param ProductRepository  $loginRepository
     */
    public function __construct(LoggerInterface $logger, ProductRepository $productRepository)
    {
        parent::__construct($logger);
        $this->productRepository = $productRepository;

    }
}
