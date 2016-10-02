<?php

namespace Auth;


use Auth\Enums\Identity;

class User extends \Nette\Security\User
{
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getFromIdentity(Identity::USERNAME);
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getFromIdentity(Identity::FIRST_NAME);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->getFromIdentity(Identity::LAST_NAME);
    }

    /**
     * @return string
     */
    public function getName()
    {
        $firstName = $this->getFromIdentity(Identity::FIRST_NAME);
        $lastName = $this->getFromIdentity(Identity::LAST_NAME);

        $name = trim("$firstName $lastName");

        return strlen($name) > 0 ? $name : null;
    }

    /**
     * @param string $column
     * @return mixed
     */
    protected function getFromIdentity($column)
    {
        return ($identity = $this->getIdentity()) ? $identity->{$column} : null;
    }
}