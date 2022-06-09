<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PizzaRepository;

class ShowPizzaController extends AbstractController
{
    #[Route('/show/pizza', name: 'show_all_pizza')]
    public function index(PizzaRepository $pizzaRepository): Response
    {
        $pizza = $pizzaRepository->findAll();
        return $this->render('show_all_pizza/index.html.twig',
        [ 'pizza' => $pizza]);
    }
    #[Route('/show/pizza/{id}', name: 'show_pizza')]
    public function index2(PizzaRepository $pizzaRepository , int $id): Response
    { 
        $pizza = $pizzaRepository ->find($id);

    if (is_null($pizza)){
        return $this->redirectToRoute('show_all_pizza');
    }
    
    return $this->render('show_pizza/index.html.twig',[
        'pizza' =>$pizza]);
}
}
