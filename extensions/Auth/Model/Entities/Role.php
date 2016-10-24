<?php

namespace Auth\Model\Entities;

use Doctrine\ORM\Mapping as ORM;
use Nette\Object;

/**
 * @ORM\Entity
 * @ORM\Table( name="roles" )
 */
class Role extends Object
{
    /**
     * @ORM\Id
     * @ORM\Column( name="role_id", type="integer" )
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(name="role", type="string", length=20)
     * @var string
     */
    protected $code;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }
}