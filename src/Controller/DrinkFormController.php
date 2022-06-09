<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\DrinkType;
use App\Entity\Drink;
use Doctrine\ORM\EntityManagerInterface;


class DrinkFormController extends AbstractController
{
    #[Route('/drink/form', name: 'app_drink_form')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $drink = new Drink();
        $form = $this->createForm(DrinkType::class, $drink);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //faire persister les données
            $entityManagerInterface->persist($drink);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_drink_form');
        }
        return $this->render('drink_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
