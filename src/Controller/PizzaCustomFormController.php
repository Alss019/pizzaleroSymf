<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CustomPizzaType;
use App\Entity\Pizza;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
class PizzaCustomFormController extends AbstractController
{
    #[Route('/pizza/custom/form', name: 'app_pizza_custom_form')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response{
        
        $pizza = new Pizza();
        $form = $this->createForm(CustomPizzaType::class, $pizza);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($pizza);
            $entityManager->flush();
            //refresh la page :
            return $this->redirectToRoute('app_pizza_custom_form');
        }
        return $this->render('pizza_custom_form/index.html.twig', [
        'form' => $form->createView(),
        
        ]);
    }
}