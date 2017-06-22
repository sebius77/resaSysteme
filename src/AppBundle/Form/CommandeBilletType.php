<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class CommandeBilletType extends AbstractType
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
        ;

    }

    public function getParent()
    {
        return CommandeType::class;
    }


}
