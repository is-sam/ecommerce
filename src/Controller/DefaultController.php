<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    public function index() {
        dd('ça marche');
    }

    /**
     * @Route("/test/{age}", name="test", defaults={age: 0}, requirements={age: \d+})
     */
    public function test(Request $request, int $age) {
        // dump($request);

        return new Response("page test $age");
    }
}