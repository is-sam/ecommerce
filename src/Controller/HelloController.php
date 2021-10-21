<?php

namespace App\Controller;

use App\Taxes\Calculator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function hello(String $name = "World", Calculator $calculator) {
        $tva = $calculator->calculate(250);
        return new Response("Hello $name !<br>TVA: $tva.");
    }
}