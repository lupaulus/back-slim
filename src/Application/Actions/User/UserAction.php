<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Domain\Login\LoginRepository;
use App\Domain\User\UserRepository;
use Psr\Log\LoggerInterface;

abstract class UserAction extends Action
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var LoginRepository
     */
    protected $loginRepository;

    /**
     * @param LoggerInterface $logger
     * @param UserRepository  $userRepository
     */
    public function __construct(LoggerInterface $logger, UserRepository $userRepository, LoginRepository $loginRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->loginRepository = $loginRepository;

    }
}
