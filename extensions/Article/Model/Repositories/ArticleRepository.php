<?php

namespace Article\Model\Repositories;

use Article\Model\Entities\Article;
use Kdyby\Doctrine\EntityDao;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Kdyby\Persistence\Query;
use Nette\Object;

class ArticleRepository extends Object
{
    /** @var EntityManager */
    private $em;

    /** @var EntityRepository */
    private $articles;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->articles = $em->getRepository(Article::class);
    }

    /**
     * @param int $id
     * @return Article
     */
    public function find(int $id) : Article
    {
        return $this->articles->find($id);
    }

    /**
     * @param Query $query
     * @return Article
     */
    public function fetchOne(Query $query) : Article
    {
        return $this->articles->fetchOne($query);
    }

    /**
     * @param Article $article
     */
    public function insert(Article $article)
    {
        $this->em->persist($article);
    }
}