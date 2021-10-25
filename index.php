<?php

require_once './vendor/autoload.php';

/*
-------Database

use PhpFramework\Database\Adaptor;

Adaptor::setup('mysql:dbname=phpblog', 'root', '40387961As!!');

class Post{

}

$posts = Adaptor::getAll('select * from posts', [], Post::class); //::class 하면 class이름 호출 __CLASS__와 비슷
var_dump($posts);
*/


/*
-------Http

use PhpFramework\Http\Request;

$_SERVER['REQUEST_METHOD'] = 'GET'; // GET
$_SERVER['PATH_INFO'] = '/posts/write'; // /posts/write

var_dump(Request::getPath()); 
*/

/*
--------Route
use PhpFramework\Routing\Route;
use PhpFramework\Database\Adaptor;
use PhpFramework\Routing\Middleware;

Adaptor::setup('mysql:dbname=phpblog', 'root', '40387961As!!');

class HelloMiddleware extends Middleware{
    
    public static function process()
    {
        return false;
    }
}

Route::add('get', '/', function(){ //root로 요청했을 때
    echo 'Hello world';             // Hello world 출력
}, [HelloMiddleware::class]);

Route::add('get', '/posts/{id}', function($id){
    if($post = Adaptor::getAll('select * from posts where id=?', [$id])){
        return var_dump($post);
    }else {
        http_response_code(404);
    }
});

Route::run();
*/

/*
--------Session
use PhpFramework\Database\Adaptor;
use PhpFramework\Session\DatabaseSessionHandler;

Adaptor::setup('mysql:dbname=sessions', 'root', '40387961As!!');
session_set_save_handler(new DatabaseSessionHandler());
session_start();

$_SESSION['message'] = 'Hello, world';
$_SESSION['foo'] = new stdClass();
*/

//serviceProvider

use PhpFramework\Support\ServiceProvider;
use Phpframework\Application;

class SessionServiceProvider extends ServiceProvider
{
    public static function register()
    {

    }

    public static function boot()
    {

    }
}

    $app = new Application([
        SessionServiceProvider::class
    ]);

    $app->boot();