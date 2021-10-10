<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function hello(String $name = "World") {
        return new Response("Hello $name !");
    }
}