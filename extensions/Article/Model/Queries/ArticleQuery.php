<?php

namespace Article\Model\Queries;

use Article\Model\Entities\Article;
use Doctrine\ORM\QueryBuilder;
use Kdyby\Doctrine\QueryObject;
use Kdyby\Persistence\Queryable;

class ArticleQuery extends QueryObject
{
    /** @var array */
    private $filter = [];

    /** @var array */
    private $select = [];

    /**
     * @return ArticleQuery
     */
    public function published() : ArticleQuery
    {
        $this->filter[] = function (QueryBuilder $qb) {
            $qb->andWhere('a.published != null');
        };
        return $this;
    }

    /**
     * @param Queryable $repository
     * @return QueryBuilder
     */
    protected function doCreateQuery(Queryable $repository) : QueryBuilder
    {
        $qb = $this->createBasicDql($repository);

        foreach ($this->select as $modifier) {
            $modifier($qb);
        }

        return $qb->addOrderBy('a.id', 'DESC');
    }

    /**
     * @param Queryable $repository
     * @return QueryBuilder
     */
    protected function doCreateCountQuery(Queryable $repository) : QueryBuilder
    {
        return $this->createBasicDql($repository)->select('COUNT(a.id)');
    }

    /**
     * @param Queryable $repository
     * @return QueryBuilder
     */
    private function createBasicDql(Queryable $repository)
    {
        $qb = $repository->createQueryBuilder()
            ->select('a')->from(Article::class, 'a');

        foreach ($this->filter as $modifier) {
            $modifier($qb);
        }

        return $qb;
    }
}