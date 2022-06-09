<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MenuRepository;

class ShowMenuController extends AbstractController
{
    #[Route('/show/menu', name: 'show_all_menu')]
    public function index(MenuRepository $menuRepository): Response
    {
        $menu = $menuRepository->findAll();
        return $this->render('show_all_menu/index.html.twig',
        [ 'menu' => $menu]);
    }
    #[Route('/show/menu/{id}', name: 'show_menu')]
    public function index2(MenuRepository $menuRepository , int $id): Response
    { 
        $menu = $menuRepository ->find($id);

    if (is_null($menu)){
        return $this->redirectToRoute('show_all_menu');
    }
    
    return $this->render('show_menu/index.html.twig',[
        'menu' =>$menu]);
}
}
