<?php
/**
 * Created by Dervish
 * Project Name: symfony-documentation-example
 * Date: 13.02.2022 - 11:26
 * File Name: BlogApi.php
 */


namespace App\Controller;

use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class BlogApiController extends AbstractController
{
    public function list()
    {
        return new Response("List Method");
    }

    public function show(int $id)
    {

        if (!is_numeric($id)) {
            return new Response("Lütfen Bir sayı giriniz");

        } else {
            return new Response("Show Method  : " . $id);
        }


    }

    public function edit(int $id)
    {
        return new Response("Edit Method");
    }

    public function blog(string $slug)
    {
        return new Response($slug." Sayfasına Ulaşıldı....");
    }
}