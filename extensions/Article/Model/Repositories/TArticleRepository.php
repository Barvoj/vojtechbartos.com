<?php
namespace Article\Model\Repositories;

trait TArticleRepository
{
    /** @var ArticleRepository */
    protected $articleRepository;

    /**
     * @param ArticleRepository $articleRepository
     */
    public function injectArticleRepository(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
}