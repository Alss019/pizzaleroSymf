<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PizzaType;
use App\Entity\Pizza;

class PizzaAddFormController extends AbstractController
{
    #[Route('/pizza/add/form', name: 'app_pizza_add_form')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $pizza = new Pizza();
        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($pizza);
            $em->flush();
            return $this->redirectToRoute('app_pizza_add_form');
        }
        return $this->render('pizza_add_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
