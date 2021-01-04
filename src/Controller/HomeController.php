<?php
namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param \App\Repository\ArticleRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArticleRepository $repository):Response
    {
        $articles = $repository->findLatest();
       return $this->render('pages/home.html.twig', [
        'articles' => $articles
       ]);
    }
}