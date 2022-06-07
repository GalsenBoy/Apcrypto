<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouteController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/nft', name: 'app_nft')]
    public function nft(): Response
    {
        return $this->render('index/nft.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/crypto', name: 'app_crypto')]
    public function crypto(): Response
    {
        return $this->render('index/crypto.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    #[Route('/metavers', name: 'app_metavers')]
    public function metaverse(): Response
    {
        return $this->render('index/metavers.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
