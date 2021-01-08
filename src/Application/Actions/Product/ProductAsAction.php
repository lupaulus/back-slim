<?php
declare(strict_types=1);

namespace App\Application\Actions\Product;

use Psr\Http\Message\ResponseInterface as Response;

class ProductAsAction extends ProductAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $arrayP = $this->productRepository->findAll();
        $this->response->getBody()->write(json_encode($arrayP));
        return $this->response;
    }
}
