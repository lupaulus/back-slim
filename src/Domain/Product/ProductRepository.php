<?php
declare(strict_types=1);

namespace App\Domain\Product;

interface ProductRepository
{
    
    /**
     * @return Product[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Product
     * @throws ProductNotFoudException
     */
    public function findProductOfId(int $id): ProductRepository;

    /**
     * @param int $id
     * @return Product
     * @throws ProductNotFoudException
     */
    public function findProductWithIdLogin(int $idLogin) : ProductRepository;

    public function createProduct(ProductRepository $Product) : bool;
}
