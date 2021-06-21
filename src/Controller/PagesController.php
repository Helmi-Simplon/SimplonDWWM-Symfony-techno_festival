<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/", name="home_pages")
     */
    public function home(): Response
    {
        return $this->render('pages/home.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }
}
