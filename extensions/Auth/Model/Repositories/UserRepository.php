<?php

namespace Auth\Model\Repositories;

use Auth\Model\Entities\User;
use Kdyby\Doctrine\EntityDao;
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
     */
    public function get(int $id) : User
    {
        return $this->users->find($id);
    }

    /**
     * @param Query $query
     * @return User
     */
    public function fetchOne(Query $query) : User
    {
        return $this->users->fetchOne($query);
    }
}