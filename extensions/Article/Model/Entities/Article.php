<?php

namespace Article\Model\Entities;


use Doctrine\ORM\Mapping as ORM;
use Nette\Object;
use Nette\Utils\DateTime;


/**
 * @ORM\Entity
 * @ORM\Table( name="articles" )
 */
class Article extends Object
{
    /**
     * @ORM\Id
     * @ORM\Column( name="article_id", type="integer" )
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column( name="user_id", type="integer" )
     * @var int
     */
    protected $userId;

    /**
     * @ORM\Column(name="title", type="string", length=255)
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(name="content", type="string")
     * @var string
     */
    protected $content;

    /**
     * @ORM\Column(name="published", type="datetime")
     * @var string
     */
    protected $published;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function setId(int $id) : Article
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId() : int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Article
     */
    public function setUserId($userId) : Article
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Article
     */
    public function setTitle(string $title) : Article
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Article
     */
    public function setContent(string $content) : Article
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Article
     */
    public function publish() : Article
    {
        $this->published = DateTime::from("now");

        return $this;
    }
}