<?php

namespace Auth\Model\Entities;

/**
 * @ORM\Entity
 * @ORM\Table( name="roles" )
 */
class Role
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