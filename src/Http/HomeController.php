<?php


namespace App\Http;


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
}