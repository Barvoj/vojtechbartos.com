<?php

namespace VojtechBartos\Model\Queries;

use VojtechBartos\Model\Entities\User;
use Doctrine\ORM\QueryBuilder;
use Kdyby\Doctrine\QueryObject;
use Kdyby\Persistence\Queryable;

class UserQuery extends QueryObject
{
    /** @var array */
    private $filter = [];

    /** @var array */
    private $select = [];

    /**
     * @param string $username
     * @return UserQuery
     */
    public function byUsername(string $username) : UserQuery
    {
        $this->filter[] = function (QueryBuilder $qb) use ($username) {
            $qb->andWhere('u.username = :username')->setParameter('username', $username);
        };
        return $this;
    }

    /**
     * @param Queryable $repository
     * @return QueryBuilder
     */
    protected function doCreateQuery(Queryable $repository)
    {
        $qb = $this->createBasicDql($repository);

        foreach ($this->select as $modifier) {
            $modifier($qb);
        }

        return $qb->addOrderBy('u.id', 'DESC');
    }

    /**
     * @param Queryable $repository
     * @return QueryBuilder
     */
    protected function doCreateCountQuery(Queryable $repository)
    {
        return $this->createBasicDql($repository)->select('COUNT(q.id)');
    }

    /**
     * @param Queryable $repository
     * @return QueryBuilder
     */
    private function createBasicDql(Queryable $repository)
    {
        $qb = $repository->createQueryBuilder()
            ->select('u')->from(User::class, 'u');

        foreach ($this->filter as $modifier) {
            $modifier($qb);
        }

        return $qb;
    }
}