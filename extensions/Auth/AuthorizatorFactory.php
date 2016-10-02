<?php
/**
 * Created by PhpStorm.
 * User: Barvoj
 * Date: 05.06.2016
 * Time: 10:51
 */

namespace Auth;


use Auth\Enums\Role;
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

        $acl->addRole(Role::GUEST);
        $acl->addRole(Role::REGULAR, Role::GUEST);
        $acl->addRole(Role::ADMIN, Role::GUEST);

        $acl->addResource('Article');
        $acl->addResource('Article:User');
        $acl->addResource('Article:User:List', 'Article:User');
        $acl->addResource('Article:User:Add', 'Article:User');
        $acl->addResource('Article:User:Edit', 'Article:User');
        $acl->addResource('Article:User:Detail', 'Article:User');

        $acl->allow(Role::GUEST, 'Article');
        $acl->allow(Role::REGULAR, 'Article:User');
        $acl->allow(Role::ADMIN, 'Article:User');

        return $acl;
    }
}