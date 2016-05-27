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
     * @param Article $article
     * @throws \Exception
     */
    public function insert(Article $article)
    {
        $this->articleRepository->insert($article);
        $this->em->flush();
    }
}