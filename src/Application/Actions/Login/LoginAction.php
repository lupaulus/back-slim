<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\Login\LoginRepository;

abstract class LoginAction extends Action
{
    /**
     * @var LoginRepository
     */
    protected $loginRepository;

    /**
     * @param LoggerInterface $logger
     * @param LoginRepository  $loginRepository
     */
    public function __construct(LoggerInterface $logger, LoginRepository $loginRepository)
    {
        parent::__construct($logger);
        $this->loginRepository = $loginRepository;
    }
}
