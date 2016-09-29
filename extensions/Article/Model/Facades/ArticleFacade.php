<?php

namespace Article\Model\Facades;

use Article\Model\Entities\Article;
use Article\Model\Repositories\ArticleRepository;
use Kdyby\Doctrine\EntityManager;

class ArticleFacade
{
    /** @var EntityManager */
    protected $em;

    /** @var ArticleRepository */
    protected $articleRepository;

    /**
     * ArticleFacade constructor.
     * @param EntityManager $em
     * @param ArticleRepository $articleRepository
     */
    public function __construct(EntityManager $em, ArticleRepository $articleRepository)
    {
        $this->em = $em;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function get(int $id) : Article
    {
        return $this->articleRepository->get($id);
    }

    /**
     * @return Article[]
     */
    public function findAll() : array
    {
        return $this->articleRepository->findAll();
    }

    /**
     * @param Article $article
     */
    public function insert(Article $article)
    {
        $this->articleRepository->insert($article);
        $this->em->flush();
    }

    /**
     * @param Article $article
     */
    public function update(Article $article)
    {
        $this->articleRepository->update($article);
        $this->em->flush();
    }

    /**
     * @param Article $article
     */
    public function delete(Article $article)
    {
        $this->articleRepository->delete($article);
        $this->em->flush();
    }

    /**
     * @param Article $article
     */
    public function publish(Article $article)
    {
        $article->publish();
        $this->em->flush();
    }

    /**
     * @param Article $article
     */
    public function unPublish(Article $article)
    {
        $article->unpublish();
        $this->em->flush();
    }
}