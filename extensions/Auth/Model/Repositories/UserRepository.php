<?php

namespace Auth\Model\Repositories;

use Auth\Model\Entities\User;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Kdyby\Persistence\Query;
use Nette\Object;

class UserRepository extends Object
{
    /** @var EntityManager */
    protected $em;

    /** @var EntityRepository */
    protected $users;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->users = $em->getRepository(User::class);
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function get(int $id) : User
    {
        $user = $this->users->find($id);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @param Query $query
     * @return User
     * @throws UserNotFoundException
     */
    public function fetchOne(Query $query) : User
    {
        $user = $this->users->fetchOne($query);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}