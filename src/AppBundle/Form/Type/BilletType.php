<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('name', TextType::class, array('label' => 'Nom : ',"required" => true))
          ->add('firstname', TextType::class, array('label' => 'Prénom : ',"required" => true))
          ->add('birthdate', DateType::class, array(
            'label' => 'Date de naissance : ',
            'widget' => 'choice',
            'html5' => false,
            'format' => 'ddMMyyyy',
            'years' => range(1920,2018)))
          ->add('country', ChoiceType::class, array(
            'label' => 'Pays de résidence : ',
            "choices" => array(
              'France' => null,
              'Angleterre' => null
            )
          ))
          ->add('discount', CheckboxType::class, array(
            'label' => 'Tarif réduit ? ',
            'required' => true
          ));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Billet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_billet';
    }


}
