<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @Route("/agenda", name="agenda_pages")
     */
    public function agenda(ArtistRepository $artistRepository): Response
    {
        $days = ["20/08/2021", "21/08/2021", "22/08/2021"];
        $hours= ["16h-18h", "18h-20h", "21h-23h"];

        return $this->render('pages/agenda.html.twig', [
            'days' => $days,
            'hours' => $hours,
            'artists' => $artistRepository->findByConcert()
            
        ]);
       
    }

    /**
     * @Route("/ticket/artist/{artist_id?0}", name="ticket_home")
     */
        public function ticket(ArtistRepository $artistRepository, $artist_id): Response
    {
        $days = ["20/08/2021", "21/08/2021", "22/08/2021"];
        $hours= ["16h-18h", "18h-20h", "21h-23h"];

        if(!$this->getUser()) return $this->redirectToRoute('app_login');

        return $this->render('pages/ticket.html.twig', [
            'days' => $days,
            'hours' => $hours,
            'artists' => $artistRepository->findByConcert(),
            'artist' => $artistRepository->findOneBy(['id' => $artist_id])
        ]);
    }
    }

