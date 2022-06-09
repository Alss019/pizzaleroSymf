<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientRepository;

class ShowIngredientController extends AbstractController
{
    #[Route('/show/ingredient', name: 'show_all_ingredient')]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        $ingredient = $ingredientRepository->findAll();
        return $this->render('show_all_ingredient/index.html.twig',
        [ 'ingredient' => $ingredient]);
    }
    #[Route('/show/ingredient/{id}', name: 'show_ingredient')]
    public function index2(IngredientRepository $ingredientRepository , int $id): Response
    { 
        $ingredient = $ingredientRepository ->find($id);

    if (is_null($ingredient)){
        return $this->redirectToRoute('show_all_ingredient');
    }
    
    return $this->render('show_ingredient/index.html.twig',[
        'ingredient' =>$ingredient]);
}
}
