<?php
namespace App\Controllers;

class Posts extends \Core\Controller
{

    //show the index page
    public function indexAction()
    {
        echo 'Hello from the index action in the Posts controller!';
    }

    //show the addnew page
    public function addNewAction()
    {
        echo 'Hello from the addNew action in the Posts controller!';
    }

	public function editAction()
    {
        echo 'Hello from the edit action in the Posts controller!';
		echo 'Querey params: ' . print_r($this->route_params, true);
    }
}
