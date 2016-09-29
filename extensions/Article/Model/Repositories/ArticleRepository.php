<?php

namespace Article\Model\Repositories;

use Article\Model\Entities\Article;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Kdyby\Persistence\Query;
use Nette\Object;

class ArticleRepository extends Object
{
    /** @var EntityManager */
    protected $em;

    /** @var EntityRepository */
    protected $articles;

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
     * @throws ArticleNotFoundException
     */
    public function get(int $id) : Article
    {
        $article = $this->articles->find($id);

        if ($article === null) {
            throw new ArticleNotFoundException();
        }

        return $article;
    }

    /**
     * @return Article[]
     */
    public function findAll() : array
    {
        return $this->articles->findAll();
    }

    /**
     * @param Query $query
     * @return Article
     * @throws ArticleNotFoundException
     */
    public function fetchOne(Query $query) : Article
    {
        $article = $this->articles->fetchOne($query);

        if ($article === null) {
            throw new ArticleNotFoundException();
        }

        return $article;
    }

    /**
     * @param Query $query
     * @return Article[]
     */
    public function fetchAll(Query $query) : array
    {
        return $this->articles->fetch($query)->toArray();
    }

    /**
     * @param Article $article
     */
    public function insert(Article $article)
    {
        $this->em->persist($article);
    }

    /**
     * @param Article $article
     */
    public function update(Article $article)
    {
    }

    /**
     * @param Article $article
     */
    public function delete(Article $article)
    {
        $this->em->remove($article);
    }
}