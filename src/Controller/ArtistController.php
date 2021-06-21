<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artist", name="artist")
     */
    public function artist(): Response
    {
        $color = ["secondary", "danger", "info", "warning", "light", "success"];
        return $this->render('artist/artist.html.twig', [
            'controller_name' => 'ArtistController',
            'colors' => $color,
            ]);
    }

    /**
     * @Route("/artist/{id}", name="artist_id", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function artist_id($id): Response
    {
        return $this->render('artist/detailartist.html.twig', [
            'id' => $id,
        ]);
    }
}
