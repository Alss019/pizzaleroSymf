<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomPizzaController extends AbstractController
{
    #[Route('/custom/pizza', name: 'app_custom_pizza')]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        $ing = $ingredientRepository->findAll();
        return $this->render('custom_pizza/index.html.twig', ['ings'=>$ing]);
    ;}

    #[Route('/custom/pizza/{id}', name: 'app_custom_pizza1')]
    public function getIngredientById(IngredientRepository $ingredientRepository, int $id): Response{
        $ing = $ingredientRepository->find($id);
        $tab = $ingredientRepository->find($id);
        if(!$tab){
            return $this->redirectToRoute('app_custom_pizza');
        }
        return $this->render('showIngredient/index.html.twig', [
            'ing'=>$ing,
            'tab'=>$tab
        ]);
        dd($tab);
    }
}


