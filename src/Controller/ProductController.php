<?php
/**
 * Created by Dervish
 * Project Name: symfony-documentation-example
 * Date: 16.02.2022 - 12:14
 * File Name: ProductController.php
 */


namespace App\Controller;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController  extends AbstractController
{
    /**
     * @Route("/products")
     */
    public function list(MessageGenerator $messageGenerator): Response
    {

// thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...

        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);
        return $this->render('service/index.html.twig', [
            'message' => $message,
        ]);
    }


}