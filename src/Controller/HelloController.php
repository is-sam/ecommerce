<?php

namespace App\Controller;

use App\Taxes\Calculator;
use App\Taxes\Detector;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello/{name}", name="hello")
     */
    public function hello(String $name = "World", Calculator $calculator, Detector $detector) 
    {
        $tva = $calculator->calculate(250);
        return $this->render('hello.html.twig', [
            'name'  => $name,
            'tva'   => $tva
        ]);
    }
}