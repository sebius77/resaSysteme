<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;


class CommandeDemiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('billets');
        $builder->remove('demiJournee');
        $builder->add("demiJournee", CheckboxType::class, array(
            'data' => true,
            'disabled' => true
    ));

    }

    public function getParent()
    {
        return CommandeType::class;
    }


}
