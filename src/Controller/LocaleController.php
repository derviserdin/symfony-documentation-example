<?php
/**
 * Created by Dervish
 * Project Name: symfony-documentation-example
 * Date: 13.02.2022 - 12:38
 * File Name: LocaleController.php
 */


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blogg", requirements={"_locale": "en|es|fr"}, name="blog_")
 */
class LocaleController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="index")
     */
    public function index(): Response
    {
      return new Response("İndex Sayfasına geldik");
    }

    /**
     * @Route("/{_locale}/posts/{slug}", name="show")
     */
    public function show(string $slug): Response
    {
        return new Response($slug." Show Sayfasına geldik");
    }
}