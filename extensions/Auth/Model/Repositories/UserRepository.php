<?php

namespace Auth\Model\Repositories;

use Auth\Model\Entities\User;
use Kdyby\Doctrine\EntityDao;
use Kdyby\Doctrine\EntityRepository;
use Kdyby\Persistence\Query;
use Nette\Object;

class UserRepository extends Object
{
    /** @var EntityRepository */
    private $users;

    /**
     * @param EntityDao $repository
     */
    public function __construct(EntityDao $repository)
    {
        $this->users = $repository;
    }

    /**
     * @param int $id
     * @return User
     */
    public function find(int $id) : User
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