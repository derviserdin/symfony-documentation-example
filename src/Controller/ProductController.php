<?php
/**
 * Created by Dervish
 * Project Name: symfony-documentation-example
 * Date: 16.02.2022 - 12:14
 * File Name: ProductController.php
 */


namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\MessageGenerator;
use Doctrine\Persistence\ManagerRegistry;
use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
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

    /**
     * @Route("/product/add", name="create_product")
     */
    public function createProduct(ManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {


        $product = new Product();
        $product->setName('');
        $product->setPrice('1999');
        $product->setDescription("Ergonomic and stylish!");

        //Valid control

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return $this->render('service/index.html.twig', [
                'errors' => $errors,
            ]);
        }
        $entityManager = $doctrine->getManager();
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        /// https://symfony.com/doc/current/doctrine.html buna sonra bak
        /// https://symfony.com/doc/current/validation.html buna da bak
        return new Response('Saved new product with id ' . $product->getId());
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(ManagerRegistry $doctrine, ProductRepository $productRepository, int $id): Response
    {
        //Manager Registry ile
        $product = $doctrine->getRepository(Product::class)->find($id);

        //repo örneği için oluşturuldu
        $repository = $doctrine->getRepository(Product::class);

        //Eğer repositoryden  işlem yapmak istersek
        $productRepo = $productRepository->find($id);

        //isme göre tek bir ürün aramak için
        $productOneBy = $repository->findOneBy(['name' => 'Camera']);

        //Ad ve fiyatına göre 1 tane listeler
        $productOneByOr = $repository->findOneBy([
            'name' => 'Keyboard',
            'price' => 1999,
        ]);

        //Fiyata göre sıralanıp Ad alanı ile eşleşenleri sıralar
        $productsFindBy = $repository->findBy(
            ['name' => 'Keyboard'],
            ['price' => 'ASC']
        );

        //Tüm tablodaki verileri getirir
        $productsAll = $repository->findAll();


        if (!$product) {
            throw $this->createNotFoundException('NO product found for id ' . $id);
        }

        $textMessage = 'Check out this great product: ' . $product->getName().
            '<br><br> Repository kullanılarak gelen: '.$productRepo->getName().
            '<br><br> İsime göre Ürün arayan repo methodu: '.$productOneBy->getName().
            '<br><br> Fiyata göre sıralanıp Ad alanı ile eşleşenleri sıralama methodu: '.print_r($productsFindBy).
            '<br><br> Tablodak verileri sıralama methodu: '.print_r($productsAll).
            '<br><br> İsime göre Ürün ve Fiyat arayan repo methodu: '.$productOneByOr->getName();

        return new Response($textMessage);



        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }


    /**
     * @Route("/product/edit/{id}")
     */
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('Keyboard');
       // gerekli değil zaten değişiklik için seçilmiş nesneyi biliyoruz $entityManager->persist($product)
        $entityManager->flush();

        return $this->redirectToRoute('product_show', [
            'id' => $product->getId()
        ]);
    }


    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function showOne(Product $product,int $id): Response
    {
        return new Response($product->getName());
    }

    /**
     * @Route("/product/delete/{id}")
     */
    public function delete(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($product);
        // gerekli değil zaten değişiklik için seçilmiş nesneyi biliyoruz $entityManager->persist($product)
        $entityManager->flush();

       return new Response('Kayıt Silindi...');
    }

}