<?php
declare(strict_types=1);

namespace App\Domain\Login;

use App\Domain\DomainException\DomainRecordNotFoundException;

class LoginNotFoundException extends DomainRecordNotFoundException
{
    
    public $message = 'The login failed.';

    public function __construct()
    {}
    
}
