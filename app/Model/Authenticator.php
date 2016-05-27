<?php

namespace VojtechBartos\Model;

use VojtechBartos\Model\Queries\UserQuery;
use VojtechBartos\Model\Repositories\UserRepository;
use Nette\Object;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\Passwords;

class Authenticator extends Object implements IAuthenticator
{

    /** @var UserRepository */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Check user identity
     * @param array $credentials
     * @return Identity
     * @throws AuthenticationException
     */
    public function authenticate(array $credentials) : Identity
    {
        list($username, $password) = $credentials;

        $query = (new UserQuery())->byUsername($username);
        $user = $this->userRepository->fetchOne($query);

        if (!isset($user)) {
            throw new AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
        } elseif (!Passwords::verify($password, $user->getPassword())) {
            throw new AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
        } elseif (Passwords::needsRehash($user->getPassword())) {
            $user->setPassword(Passwords::hash($password));
        }

        return new Identity($user->getId(), $roles = null, $user);
    }
}