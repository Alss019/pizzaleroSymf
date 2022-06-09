<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DrinkRepository;

class ShowDrinkController extends AbstractController
{
    #[Route('/show/drink', name: 'show_all_drink')]
    public function index(DrinkRepository $drinkRepository): Response
    {
        $drink = $drinkRepository->findAll();
        return $this->render('show_all_drink/index.html.twig',
        [ 'drink' => $drink]);
    }
    #[Route('/show/drink/{id}', name: 'show_drink')]
    public function index2(DrinkRepository $drinkRepository , int $id): Response
    { 
        $drink = $drinkRepository ->find($id);

    if (is_null($drink)){
        return $this->redirectToRoute('show_all_drink');
    }
    
    return $this->render('show_drink/index.html.twig',[
        'drink' =>$drink]);
}
}
