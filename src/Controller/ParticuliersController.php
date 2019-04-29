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
use Symfony\Component\HttpFoundation\Response;

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
            return $this->redirectToRoute('procedure_particulier');
        }

        return $this->render('particuliers/create.html.twig', [
            'formParticulier' => $form->createView(),
            'qualif' => "Particulier"
        ]);
    }

     /**
     * @Route("/procedure_particuliers", name="procedure_particulier")
     * 
     */
    public function procedureParticulier(Request $request, ObjectManager $manager)
    {
        
        $associations = $this->repository->findAllVisible();
         

        /* $repo = $this->getDoctrine()->getRepository(Association::class);
        dump($repo); */

        # Creation d'une association vide
        /* $assoc = new Association();

        $assoc->setNom('ADAVEM Association déodatienne d\'aide aux victimes et de médiation de Saint-Dié des Vosges France Victimes 45')
            ->setCommune('LE MANS');

        $manager->persist($assoc);
        $manager->flush(); */
        
        return $this->render('particuliers/procedureParticuliers.html.twig', [
            'controller_name' => 'ParticulierController',
            'title' => "Procedure_Particulier",
            'associations' => $associations
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
}
