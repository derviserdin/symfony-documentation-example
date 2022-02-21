<?php

// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/deneme", name="deneme")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        // Task oluşturma
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

        // form kontrollerinde methodun önemi $request->isMethod('POST');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() request ile gelen değeri tutar
            // ama orijinal '$task' değeride güncelleniyor
            $task = $form->getData();


            //veritabanı nesnesi
            $entityManager = $doctrine->getManager();
            // Taski Kaydetmek  için persist çağırıyoruz
            $entityManager->persist($task); // Gelen data veritabanına kaydetdilecek

            //flush() ile sorguyu çalıştırıyoruz
            $entityManager->flush();

            //yönlendirilmek istenen yer
            return $this->redirectToRoute('sonuc',[
                'sonuc' => 'Kaydedildi'
            ]);
        }

        //form submit edilmemiş ise formun render edileceği yer
        return $this->renderForm('task/index.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/sonuc/{sonuc}", name="sonuc")
     * @return Response
     */
    public function sonuc(string $sonuc)
    {
        return new Response($sonuc);
    }

    public function new2(Request $request): Response
    {
        //görev nesnesi oluşturup bazı verileri içerisine yazalım
        $task=new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form= $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();
    }

}