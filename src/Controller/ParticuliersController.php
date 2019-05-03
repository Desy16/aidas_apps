<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\AssociationRepository;
use App\Entity\Particuliers;
use App\Entity\Association;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Response;
use App\Form\AssociationType;
use App\Entity\AssociationSearch;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Form\ParticuliersType;
/* use App\Controller\PaginatorInterface; */

class ParticuliersController extends AbstractController
{
    /**
     * @var AssociationRepository
     */
    private $repository;


    public function __construct(AssociationRepository $repository){

         $this->repository = $repository;
    }

    /**
     * @Route("/particuliers", name="particulier_create")
     */

    public function create(Request $request, ObjectManager $manager)
    {
        # Creation d'un particulier vide
        $particulier = new Particuliers();
        
        #Creation d'un formulaire de particulier
        $form = $this->createFormBuilder($particulier)
                     ->add('sinistre', ChoiceType::class, [
                         'choices' => [

                            '--Veuillez choisir un sinistre--' => 'choix',

                             'Evenements climatiques' => [
                                'Tempête' => 'tempete',
                                'Inondation' => 'inondation',
                                'Grêle' => 'grele',
                                'Neige' => 'neige'
                             ],

                                'Incendie' => 'incendie',
                                'Vol' => 'vol',
                                'Degâts des eaux' => 'degats_eaux',
                                'Responsabilite civile' => 'respons_civile',
                                'Catastrophes naturelles' => 'catastrophe_naturel',
                                'Accidents de la vie privée' => 'accident_vie_prive'

                         ]
                     ]) 
                      
                     ->getForm();

        
        #$form = $this->createForm(ParticuliersType::class, $particulier);
 
        #Demande au formulaire d'analyser la requete
         $form->handleRequest($request);
        

        #Est ce que le formulaire est soumi et est ce qu'il est valide
        if($form->isSubmitted() && $form->isValid())
        {
             $particulier->setCreateAt(new \DateTime());

            # Demander au manager de faire persister l'objet
            $manager->persist($particulier);

            # Enregistrer l'objet dans la BD
            $manager->flush();

            # Redirection vers le formulaire procedure particulier
            return $this->redirectToRoute('association.index');
        }

        return $this->render('particuliers/create.html.twig', [
            'formParticulier' => $form->createView(),
            'title' => "Procedure_Particulier",
            'current_menu' => 'particuliers',
            'qualif' => "Particulier"
        ]);
    }

     /**
      * @var search
     * @Route("/procedure_particuliers", name="procedure_particulier")
     * 
     */
    public function procedureParticulier(Request $request, ObjectManager $manager, AssociationRepository $repository)
    {

        $associations = $repository->findLatest();

        /* $search = new AssociationSearch();
        $form = $this->createForm(AssociationType::class, $search);
        $form->handleRequest($request);

        $associations = $this->repository->findAllVisibleQuery($search); */

        /* $associations = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            5,
        ); */
              
        /* $repo = $this->getDoctrine()->getRepository(Association::class);
        dump($repo); */

        # Creation d'une association vide
         /*  $assoc = new Association(); */

       /*  $assoc->setNom('Mon association du quartier')
            ->setCommune('Caen')
            ->setAdresse('Avenue de la valeuse')
            ->setCodePostal('14200');

        $manager->persist($assoc);
        $manager->flush(); */
        
        return $this->render('particuliers/procedureParticuliers.html.twig', [
            'controller_name' => 'ParticulierController',
            'title' => "Procedure_Particulier",
            'associations' => $associations
            /* 'form' => $form->createView() */
        ]);
    }


    /**
     * @Route("/particuliers", name="particuliers")
     */
    public function index()
    {
        return $this->render('particuliers/index.html.twig', [
            'controller_name' => 'ParticuliersController',
        ]);
    }

     /**
     * @Route("/procedure_particuliers/{slug}-{id}", name="particuliers.show", requirements={"slug" : "[a-z0-9\-]*"})
     * 
     */
    public function show(Association $association, string $slug, Request $request)
    {
        # code...ContactNotification $notification
       /*  $association = $this->repository->find($id); */

       if ($association->getSlug() !== $slug) {
           # code...
           return $this->redirectToRoute('particuliers.show', [
                'id' => $association->getId(),
                'slug' => $association->getSlug()
           ], 301);
       }

       /* $contact = new Contact();
       $form = $this->createForm(ContactType::class, $contact);
       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()) {

            $notification->notify($contact);
           $this->addFlash('success', 'Votre email a bien été envoyé');
           return $this->redirectToRoute('particuliers.show', [
                'id' => $association->getId(),
                'slug' => $association->getSlug()
            ]); 
       } */

        return $this->render('particuliers/show.html.twig', [
            'association' => $association,
            /* 'form' => $form->createView(), */
            'title' => 'Association'
        ]);

    }
}
