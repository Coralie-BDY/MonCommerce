<?php
namespace App\Controller;


use App\Entity\Article;
use App\Entity\ArticleSearch;
use App\Form\ArticleSearchType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @var \App\Repository\ArticleRepository
     */
    private $repository;
    /**
     * @var \EntityManager
     */
    private $manager;

    public function __construct(ArticleRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/articles", name="article_index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response
    {
        $search = new ArticleSearch();
        $form = $this->createForm(ArticleSearchType::class, $search);
        $form->handleRequest($request);

        $articles = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1), 12
        );
        return $this->render('article/index.html.twig', [
            'current_menu' =>'articles',
            'articles' => $articles,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/articles/{slug}-{id}", name="article_show", requirements={"slug" : "[a-z0-9\-]*"})
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function show(Article $article, string $slug) : Response
    {
        if ($article->getSlug() !== $slug)
        {
            return $this->redirectToRoute('article_show', [
                'id' => $article->getId(),
                'slug' => $article->getSlug()
            ], 301);
        }
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'current_menu' =>'articles'
        ]);
    }
}
