<?php


namespace App\Http;


use Core\Database\QueryBuilder;
use Core\Http\{Request, Response};
use Core\View;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        return $response
            ->header('Content-type', 'application/json')
            ->status(500)
            ->send(View::render('home.index', []));
        // return $response->send('Ok!');
        // return View::render('home.index', []);
    }

    public function testDb()
    {
        $query = new QueryBuilder();
        var_dump($query->table('users')->select(['id', 'name'])->where('age', '=', 27)->toSql());
    }
}