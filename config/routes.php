<?php
/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 07.06.2016
 * Time: 23:25
 */

return array(
    'admin/index' => 'users/index',
    'admin/exit' => 'users/exit',
    'admin' => 'users/login',
    'comments/add' => 'comments/add',
    'comments/sort/([0-9]+)' => 'comments/sort/$1',
    'comments/publisher/([0-9]+)/([0-9]+)' => 'comments/publisher/$1/$2',
    'comments/pull/([0-9]+)' => 'comments/pull/$1',
    'comments/updateAdmin' => 'comments/updateAdmin',
    'comments' => 'comments/index',
    ''=>'comments/index'
);