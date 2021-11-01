<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('cart', []);
        $detailedCart = [];
        $totalPrice = 0;

        foreach ($cart as $id => $qty) {
            $product = $productRepository->find($id);
            $detailedCart[] = [
                'product'   => $product,
                'qty'       => $qty
            ];
            $totalPrice += $product->getPrice() * $qty;
        }


        return $this->render('cart/index.html.twig', [
            'cart'  => $detailedCart,
            'total' => $totalPrice
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        if (!array_key_exists($id, $cart)) {
            $cart[$id] = 0;
            $this->addFlash('success', "Product $id added to cart !");
        }

        $cart[$id]++;

        $session->set('cart', $cart);


        return $this->redirectToRoute('cart_index');
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        if (!array_key_exists($id, $cart)) {
            return $this->redirectToRoute('cart_index');
        }

        $cart[$id]--;

        if ($cart[$id] === 0) {
            unset($cart[$id]);
            $this->addFlash('success', "Product $id removed from cart !");
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('cart_index');
    }

          /**
     * @Route("/cart/clear", name="cart_clear")
     */
    public function clear(SessionInterface $session): Response
    {
        $session->set('cart', []);

        return $this->redirectToRoute('cart_index');
    }
}
