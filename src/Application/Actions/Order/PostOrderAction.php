<?php
declare(strict_types=1);

namespace App\Application\Actions\Order;

use Psr\Http\Message\ResponseInterface as Response;


class PostOrderAction extends OrderAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return new Response();
    }
}
