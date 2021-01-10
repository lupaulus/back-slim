<?php
declare(strict_types=1);

namespace App\Application\Actions\Order;

use App\Domain\Order\Order;
use App\Domain\Product\Product;
use Psr\Http\Message\ResponseInterface as Response;


class PostOrderAction extends OrderAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $this->logger->debug("User Action: ADD ORDER");
        $json = $this->request->getBody();
        $this->logger->debug("Data array user : ".strval($json));
        $array = json_decode(strval($json));
        $this->logger->debug("obj : ".gettype($array));
        $o = new Order();
        $decoded = $this->request->getAttribute("decoded_token_data");

        $o->setUser($this->userRepository->findUserOfId(intval($decoded["userid"])));
        $arrayProduct = ((array)$array)["products"];
        foreach( $arrayProduct as $product){
            $id = ((array)$product)["id"];
            $p = $this->productRepository->findProductOfId($id);
            $o->addProduct($p);
        }
        if($this->orderRepository->createOrder($o))
        {
            //OK with 200
 
            return $this->respondWithData(json_encode($o),200);
        }
        // User is not created 400 to client
        return $this->respondWithData(json_encode(array("error" => "order not created")),400);
    }
}
