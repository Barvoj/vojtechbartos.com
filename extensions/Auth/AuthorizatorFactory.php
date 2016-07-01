<?php
/**
 * Created by PhpStorm.
 * User: Barvoj
 * Date: 05.06.2016
 * Time: 10:51
 */

namespace Auth;


use Nette\Security\IAuthenticator;
use Nette\Security\Permission;

class AuthorizatorFactory
{
    /**
     * @return IAuthenticator
     */
    public static function create() : IAuthenticator
    {
        $acl = new Permission();

        $acl->addRole('guest');
        $acl->addRole('admin', 'guest');

        $acl->addResource('Article');
        $acl->addResource('Article:Admin');
        $acl->addResource('Article:Admin:List', 'Article:Admin');
        $acl->addResource('Article:Admin:Add', 'Article:Admin');
        $acl->addResource('Article:Admin:Edit', 'Article:Admin');
        $acl->addResource('Article:Admin:Detail', 'Article:Admin');

        $acl->allow('guest', 'Article');
        $acl->allow('admin', 'Article:Admin');

        return $acl;
    }
}