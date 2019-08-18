<?php

namespace App\Controllers\Admin;

//User admin controller
class Users extends \Core\Controller
{

    //before
    protected function before()
    {
        // Make sure an admin user is logged in for example
        // return false;
    }

    //show index
    public function indexAction()
    {
        echo 'User admin index';
    }
}
