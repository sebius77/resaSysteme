<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("dateReservation", DateTimeType::class, array(
                'widget' => 'single_text',
                'attr' => array(
                    'style' => 'display:none'
                ),
                'label' => false
            ))
            ->add("nbreBillet", IntegerType::class, array(
                'attr' => array(
                    'style' => 'display:none'
                ),
                'label' => false
            ))
            ->add("demiJournee", CheckboxType::class, array(
                'required' => false,
                'attr' => array(
                    'style' => 'display:none'
                ),
                'label' => false

            ))
            ->add('billets', CollectionType::class, array(
                'entry_type' => BilletType::class,
                'allow_add' => true,
                'allow_delete' => true
            ))


            ->add('Etape suivante', SubmitType::class)
        ;


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Commande',
        ));

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_commande';
    }


}
