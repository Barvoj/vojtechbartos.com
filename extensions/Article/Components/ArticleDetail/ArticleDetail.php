<?php

namespace Article\Components\ArticleDetail;


use Article\Model\Entities\Article;
use Libs\Application\UI\Control;
use Libs\Text\Preprocesor;

class ArticleDetail extends Control
{
    /** @var Article */
    protected $article;

    /** @var Preprocesor */
    private $preprocesor;

    /**
     * ArticleList constructor.
     * @param Article $article
     * @param Preprocesor $preprocesor
     */
    public function __construct(Article $article, Preprocesor $preprocesor)
    {
        parent::__construct();
        $this->article = $article;
        $this->preprocesor = $preprocesor;
    }

    public function render()
    {
        $this->template->title = $this->article->getTitle();
        $this->template->content = $this->preprocesor->process($this->article->getContent());

        parent::render();
    }
}