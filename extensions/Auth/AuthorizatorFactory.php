<?php
/**
 * Created by PhpStorm.
 * User: Barvoj
 * Date: 05.06.2016
 * Time: 10:51
 */

namespace Auth;


use Nette\Security\IAuthorizator;
use Nette\Security\Permission;

class AuthorizatorFactory
{
    /**
     * @return IAuthorizator
     */
    public static function create() : IAuthorizator
    {
        $acl = new Permission();

        $acl->addRole('guest');
        $acl->addRole('admin', 'guest');

        $acl->addResource('Article');
        $acl->addResource('Article:User');
        $acl->addResource('Article:User:List', 'Article:User');
        $acl->addResource('Article:User:Add', 'Article:User');
        $acl->addResource('Article:User:Edit', 'Article:User');
        $acl->addResource('Article:User:Detail', 'Article:User');

        $acl->allow('guest', 'Article');
        $acl->allow('admin', 'Article:User');

        return $acl;
    }
}