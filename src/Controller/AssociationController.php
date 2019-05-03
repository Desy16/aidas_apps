<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AssociationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AssociationType;
use App\Entity\Association;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\AssociationSearch;
use App\Notification\ContactNotification;

class AssociationController extends AbstractController
{

     /**
     * @var AssociationRepository
     */
    private $repository;


    public function __construct(AssociationRepository $repository){

         $this->repository = $repository;
    }

    /**
     * @Route("/association", name="association.index")
     */
    public function index(Request $request, AssociationRepository $repository)
    {

        $associations = $repository->findLatest();

        $search = new AssociationSearch();
        $form = $this->createForm(AssociationType::class, $search);
        $form->handleRequest($request);

        /* $associations = $repository->findAllVisibleQuery($search); */

        return $this->render('association/index.html.twig', [
            'controller_name' => 'AssociationController',
            'title' => "Association",
            'associations' => $associations,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/association/{slug}-{id}", name="association.show", requirements={"slug" : "[a-z0-9\-]*"})
     * 
     */
    public function show(Association $association, string $slug, Request $request, ContactNotification $notification)
    {
        # code...
      /*  $association = $this->repository->find($id);  */

       if ($association->getSlug() !== $slug) {
           # code...
           return $this->redirectToRoute('association.show', [
                'id' => $association->getId(),
                'slug' => $association->getSlug()
           ], 301);
       }

       $contact = new Contact();
       $contact->setAssociation($association);
       $form = $this->createForm(ContactType::class, $contact);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()) {

           $notification->notify($contact);
          $this->addFlash('success', 'Votre email a bien été envoyé');
            /*return $this->redirectToRoute('particuliers.show', [
                'id' => $association->getId(),
                'slug' => $association->getSlug()
            ]);  */
       }


        return $this->render('association/show.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
            'title' => 'Association'
        ]);

    }
}
