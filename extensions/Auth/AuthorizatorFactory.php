<?php
/**
 * Created by PhpStorm.
 * User: Barvoj
 * Date: 05.06.2016
 * Time: 10:51
 */

namespace Auth;


use Nette\Security\Permission;

class AuthorizatorFactory
{
    /**
     * @return Permission
     */
    public static function create()
    {
        $acl = new Permission();

        $acl->addRole('guest');
        $acl->addRole('admin', 'guest');

        $acl->addResource('Article:Admin:Article');

        $acl->allow('guest', 'Article:Admin:Article', 'show');
        $acl->allow('admin', 'Article:Admin:Article', ['list', 'add', 'edit']);

        return $acl;
    }
}