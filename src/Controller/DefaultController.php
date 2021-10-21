<?php

namespace App\Controller;

use App\Taxes\Calculator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Calculator $calculator) {
        $tva = $calculator->calculate(100);
        return new Response("home page $tva");
    }

    /**
     * @Route("/test/{age}", name="test", defaults={"age"=0}, requirements={"age"="\d+"})
     */
    public function test(Request $request, int $age) {
        // dump($request);

        return new Response("page test $age");
    }
}