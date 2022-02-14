<?php
/**
 * Created by Dervish
 * Project Name: sym-doc
 * Date: 8.02.2022 - 15:57
 * File Name: BlogController.php
 */


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function list()
    {
        return new Response("List Method");
    }

    /**
     * @Route("/posts/{id}", methods={"GET","HEAD"})
     */
    public function show()
    {
        return new Response("Show Method");
    }

    /**
     * @Route("/posts/{id}", methods={"PUT"})
     */
    public function edit()
    {
        return new Response("Edit Method");
    }

    /**
     * @Route("/blog/{page}", name="blog_list_a", requirements={"page"="\d+"})
     */
    public function blogPage(int $page)
    {
        return new Response($page."  Sayfaya Ulaşıldı....");
    }

    /**
     * @Route("/blog/{slug}", name="blog_show_a")
     */
    public function blog(string $slug)
    {
        return new Response($slug." Annotations Detay sayfasına Ulaşıldı....");
    }


    /**
     * @Route("/blog/requirements/{page<\d+>?1}", name="blog_list_requirements")
     */
    public function blogPageRequirements(int $page): Response
    {
        return new Response($page." Requirements Detay sayfasına Ulaşıldı....");

    }

    /**
     * @Route("/blog/pagee/{page}", name="blog_index_title", defaults={"page": 1, "title": "Hello world!"})
     */
    public function index(int $page, string $title): Response
    {
        return new Response($page." Sayfasına ulaşıldı : Başlık :".$title);
    }

    /**
     * @Route(
     *     "/articles/{_locale}/search.{_format}",
     *     locale="en",
     *     format="html",
     *     requirements={
     *         "_locale": "en|fr",
     *         "_format": "html|xml",
     *     }
     * )
     */
    public function search(): Response
    {
    }
}