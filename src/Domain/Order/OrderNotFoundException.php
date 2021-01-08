<?php
declare(strict_types=1);

namespace App\Domain\Order;

use App\Domain\DomainException\DomainRecordNotFoundException;

class OrderNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The user you requested does not exist.';
    
    public function __construct()
    {}
}
