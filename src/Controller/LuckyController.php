<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{


    /**
     * @Route("/lucky/number", name="luck_number")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        /**
         *With Twig
         */
        return $this->render('luck/number.html.twig', [
            'number' => $number,
        ]);


        /**
         * With Response
         * return new Response(
         * '<html><body>Lucky number: ' . $number . '</body></html>'
         * );*/


    }

    /**
     * @Route("/lucky/number/{max}")
     */
    public function number2(int $max, LoggerInterface $logger): Response
    {
        $number = random_int(0, $max);
        $logger->info('We are logging!');

        /**
         *With Twig
         */
        return $this->render('luck/number.html.twig', [
            'number' => $number,
        ]);

    }

    public function download(): Response
    {
        // send the file contents and force the browser to download it
        return $this->file('/path/to/some_file.pdf');
    }

    /**
     * @Route("/home")
     * @return RedirectResponse

    public function redirect(): RedirectResponse
    {
        return $this->redirect('http://symfony.com/doc');
    } */
}
