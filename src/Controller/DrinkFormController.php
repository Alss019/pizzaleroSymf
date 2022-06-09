<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\DrinkType;

class DrinkFormController extends AbstractController
{
    #[Route('/drink/form', name: 'app_drink_form')]
    public function index(): Response
    {
        $form = $this->createForm(DrinkType::class);
        return $this->render('drink_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
