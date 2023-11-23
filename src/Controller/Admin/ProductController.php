<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductFormType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/my-admin')]
class ProductController extends AbstractController
{

    public function __construct(private ProductRepository $productRepository, private RequestStack $requestStack) {
    
    }

    #[Route('/products', name: 'app_admin_product')]
    public function index(): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $this->productRepository->findAll(),
        ]);
    }

        #[Route('/products/form', name: 'app_admin_product_form')]
    public function form(): Response
    {
        $entity = new Product();
        $type = ProductFormType::class;
        $form = $this->createForm($type, $entity);

        $form->handleRequest($this->requestStack->getMainRequest());

        if($form->isSubmitted() && $form->isValid()){
            dd($entity);
        }

        return $this->render('admin/product/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}