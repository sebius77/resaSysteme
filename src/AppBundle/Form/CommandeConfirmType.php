<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class CommandeConfirmType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('dateReservation')
            ->remove('nbreBillet')
            ->remove('demiJournee')
            ->remove('billets')
            ->remove('Etape suivante')
            ->add('mail', TextType::class)
            ->add('Confirmez', SubmitType::class)
        ;

    }

    public function getParent()
    {
        return CommandeType::class;
    }


}
