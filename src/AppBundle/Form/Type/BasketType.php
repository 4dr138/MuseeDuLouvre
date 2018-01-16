<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class BasketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('date', DateType::class, array(
          'label' => 'Date de réservation : ',
          'widget' => 'single_text',
          'html5' => false,
          'format' => 'dd/MM/yyyy',
          'attr' => ['class' => 'js-datepicker']))
        ->add('mail', TextType::class, array(
          'label' => 'Veuillez entrer votre mail : ',
          "required" => true))
        ->add('type', ChoiceType::class, array(
          'label' => 'Type de billet : ',
          'choices' => array(
            'Demi-journée' => true,
            'Journée' => false,
          ),
        ))
        ->add('billet', CollectionType::class, array(
           "entry_type" => BilletType::class,
           "entry_options" => array(
             'attr' => array('class' => 'formBillet')
           ),
           "allow_add" => true,
           "allow_delete" => true,
            "by_reference" => false
         ))
        ->add('payer', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Basket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_basket';
    }


}
