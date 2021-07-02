<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Service\CategoryHandler;
use App\Repository\ArtistRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtistController extends AbstractController
{
    private array $categories;
    private ArtistRepository $artistRepository;

    public function __construct(ArtistRepository $artistRepository, CategoryRepository $categoryRepository, CategoryHandler $categoryHandler)
    {
        $this->categories = $categoryHandler->handle($categoryRepository->findAll());
        $this->artistRepository = $artistRepository;
    }
    /**
     * @Route("/artist", name="artist")
     */
    public function artist(CategoryRepository $categoryRepository, ArtistRepository $artistRepository): Response
    {
        // $border_color = ["secondary", "danger", "info", "warning", "light", "success"];
        // $bg_color = ["secondary", "danger", "info", "warning"];
        $categoryColors=[
            "Mélodique" => "danger",
            "Industrielle" => "info",
            "Groovy" => "secondary",
            "Deep" => "warning",
            "Détroit" => "success",
        ];

        $categories = $categoryRepository->findAll();

        foreach($categories as $category){
            $category->color=$categoryColors[$category->getLabel()];
           
        }
            
        $artists = $artistRepository->findAll();
        
        foreach($artists as $artist){
            $categoryName= $artist->getCategory()? $artist->getCategory()->getLabel(): null;
            $color= $categoryName? $categoryColors[$categoryName] : 'dark';
           
                $artist->color=$color; 
        
        }

        return $this->render('artist/artist.html.twig', [
            'categories' => $categories,
            'artists' => $artists,            
            'categoryColors' => $categoryColors,
        ]);
    }

    /**
     * @Route("/artist/{id}", name="artist_id", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function artist_id(ArtistRepository $artistRepository,$id): Response
    {
        $artists = $artistRepository->find($id);
        return $this->render('artist/detailartist.html.twig', [
            'artists' => $artists,
        ]);
    }

    /**
     * @Route("/artist/category/{id}", name="category_id", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function artist_category(CategoryRepository $categoryRepository,ArtistRepository $artistRepository,$id): Response
    {
        $categories = $categoryRepository->findAll();
       
        $artists = $artistRepository->findBy(['category' =>$id]);
        
        return $this->render('artist/artist.html.twig', [
            'artists' => $artists,
            'categories' => $categories,
        ]);

    }
}
