<?php
namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{
    /**
     * @var \App\Repository\ArticleRepository
     */
    private $repository;
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $manager;

    public function __Construct(ArticleRepository $repository, EntityManagerInterface $manager)
    {

        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route ("/admin", name="admin_article_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
       $articles = $this->repository->findAll();
       return $this->render('admin/article/index.html.twig',
           compact('articles'));
    }

    /**
     * @Route ("/admin/article/create", name="admin_article_new")
     */
    public function new(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->persist($article);
            $this->manager->flush();
            $this->addFlash('success', 'Article créé avec succès');
            return  $this->redirectToRoute('admin_article_index');
        }
        return $this->render('admin/article/new.html.twig',[
            'article' => $article,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route ("/admin/article/{id}", name="admin_article_edit", methods="GET|POST")
     */
    public function edit(Article $article, Request $request)
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->flush();
            $this->addFlash('success', 'Article modifié avec succès');
            return  $this->redirectToRoute('admin_article_index');
        }

        return $this->render('admin/article/edit.html.twig',[
          'article' => $article,
          'form' => $form->createView()
        ]);
    }

    /**
     * @Route ("/admin/article/{id}", name="admin_article_delete", methods="DELETE")
     * @param \App\Entity\Article $article
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Article $article, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token')))
        {
            $this->manager->remove($article);
            $this->manager->flush();
            $this->addFlash('success', 'Article supprimé avec succès');
        }

        return  $this->redirectToRoute('admin_article_index');
    }
}