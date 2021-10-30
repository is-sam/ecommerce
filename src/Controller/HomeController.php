<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class HomeController.
 */
class HomeController extends AbstractController
{
    /**
     * Index Action
     * @Route("/", name="home_index")
     */
    function index(ProductRepository $productRepository)
    {
        $products = $productRepository->findAll();

        return $this->render('home/index.html.twig', [
            'products'  => $products
        ]);
    }
    
}
