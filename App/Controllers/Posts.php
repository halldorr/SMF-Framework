<?php
namespace App\Controllers;

use \Core\View;
use App\Models\Post;

class Posts extends \Core\Controller
{

    //show the index page
    public function indexAction()
    {
        $posts = Post::getAll();

		View::renderTemplate('Posts/index.html', ['posts' => $posts]);
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
