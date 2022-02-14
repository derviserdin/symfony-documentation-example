<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function notifications(): Response
    {

        $userFirstName = 'Dervish Snow';
        $userNotifications = ['Bildirim1', 'Bildirim2'];


        return $this->render('user/notifications.html.twig', [
            'user_first_name' => $userFirstName,
            'notifications' => $userNotifications
        ]);
    }
}
