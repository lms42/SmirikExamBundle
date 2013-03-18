<?php

namespace Smirik\ExamBundle\Form\Type\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ExamTypeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Smirik\ExamBundle\Model\ExamType',
        );
    }

    public function getName()
    {
        return 'ExamType';
    }

}

