<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\Login\LoginRepository;
use App\Domain\User\UserRepository;

abstract class LoginAction extends Action
{
    /**
     * @var LoginRepository
     */
    protected $loginRepository;

    /**
     * 
     *
     * @var UserRepository
     */
    protected $userRepository;
    /**
     * @param LoggerInterface $logger
     * @param LoginRepository  $loginRepository
     */
    public function __construct(LoggerInterface $logger, LoginRepository $loginRepository, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->loginRepository = $loginRepository;
        $this->userRepository = $userRepository;

    }
}
