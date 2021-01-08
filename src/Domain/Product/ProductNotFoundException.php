<?php
declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ProductNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The Product you requested does not exist.';
    
    public function __construct()
    {}
}
