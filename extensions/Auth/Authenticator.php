<?php

namespace Auth;

use Auth\Enums\Identity as IdentityData;
use Auth\Enums\Role;
use Auth\Model\Queries\UserQuery;
use Auth\Model\Repositories\UserNotFoundException;
use Auth\Model\Repositories\UserRepository;
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

        try {
            $user = $this->userRepository->fetchOne($query);
        } catch (UserNotFoundException $ex) {
            throw new AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
        }

        if (!Passwords::verify($password, $user->getPassword())) {
            throw new AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
        } elseif (Passwords::needsRehash($user->getPassword())) {
            $user->setPassword(Passwords::hash($password));
        }

        $data = [
            IdentityData::USERNAME => $user->getUsername(),
            IdentityData::FIRST_NAME => $user->getFirstName(),
            IdentityData::LAST_NAME => $user->getLastName(),
        ];

        return new Identity($user->getId(), $roles = [Role::ADMIN], $data);
    }
}