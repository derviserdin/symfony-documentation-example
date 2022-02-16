<?php
/**
 * Created by Dervish
 * Project Name: symfony-documentation-example
 * Date: 16.02.2022 - 13:03
 * File Name: SiteController.php
 */


namespace App\Controller;

use App\Service\SiteUpdateManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/site")
     * @param SiteUpdateManager $siteUpdateManager
     * @return void
     */
    public function new(SiteUpdateManager $siteUpdateManager) : Response
    {
        if($siteUpdateManager->notifyOfSiteUpdate()){
            $this->addFlash('success', 'Notification mail was sent successfully.');
        }

        return $this->render('service/site.html.twig');
    }
}