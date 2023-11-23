<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    public function __construct(private ProductRepository $productRepository,)
    {
    }

    #[Route('/products', name: 'products.index')]
    public function index(): Response
    {
        $products = $this->productRepository->findAll();
        //dd($products);
        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }


    public function add(): Response
    {
        $form = $this->createForm(ProductFormType::class);

        return $this->render('products/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/products/{id}', name: 'products.show')]
    public function show(int $id): Response
    {
        $product = $this->productRepository->find($id);
        // dd($product);
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }
}