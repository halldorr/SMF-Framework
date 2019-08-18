<?php
namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller
{

    //show the index page
    public function indexAction()
    {
        echo 'Hello from the index action in the Home controller!';
		View::render('Home/index.php', ['name' => 'Jeff', 'colours' => ['red', 'green', 'blue']]);
    }

	protected function before()
	{
		//echo 'before';
		//return false;
	}

	protected function after()
	{
		//echo 'after';
	}
}
