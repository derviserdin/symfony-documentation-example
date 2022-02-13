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
     * @Route("/blog/{id}", name="blog_list", methods={"GET","HEAD"})
     */
    public function list($id): Response
    {

        return new Response($id);
    }
}