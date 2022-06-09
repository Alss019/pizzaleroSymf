<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\IngredientType;

class IngredientFormController extends AbstractController
{
    #[Route('/ingredient/form', name: 'app_ingredient_form')]
    public function index(): Response
    {
        $form = $this->createForm(IngredientType::class);
        return $this->render('ingredient_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
