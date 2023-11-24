<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    public function __construct(
        private RequestStack $requestStack,
        private EntityManagerInterface $entityManagerInterface
    ) {
    }



    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {

        $entity =  new Contact();

        $type = ContactType::class;
        
        $form = $this->createForm($type, $entity);

        $form->handleRequest($this->requestStack->getMainRequest());

        if($form->isSubmitted() && $form->isValid()){
            // dd($entity);

            $this->entityManagerInterface->persist($entity);
            $this->entityManagerInterface->flush();

            $this->addFlash('success', 'Message envoyé avec succès !');
            return $this->redirectToRoute('app_contact');
        }

                return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}