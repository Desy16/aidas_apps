<?php

namespace App\Form;

use App\Entity\AssociationSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Csrf\CsrfToken; 

class AssociationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commune', TextType::class, [
                'required' => true,
                'label' => true,
                'attr' => [
                    'placeholder' => 'Ex ville'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssociationSearch::class,

            # Pour que les personnes puissent partagé leur recherches
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefixe()
    {
        # code...
        return '';
    }
}
