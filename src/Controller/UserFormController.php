<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\UserType;
use App\Entity\User;


class UserFormController extends AbstractController
{
    #[Route('/user/form', name: 'app_user_form')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_user_form');
        }
        return $this->render('user_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
