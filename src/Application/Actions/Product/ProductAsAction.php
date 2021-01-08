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
        $this->response = $this->response->withHeader("Content-Type", "application/json");
        $arrayP = $this->productRepository->findAll();
        $this->response->getBody()->write(json_encode($arrayP));
        return $this->response;
    }
}
