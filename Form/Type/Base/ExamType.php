<?php

namespace Smirik\ExamBundle\Form\Type\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ExamType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('started_at')
            ->add('exam_type')
            ->add('quiz')
            ->add('description')
            ->add('is_active')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Smirik\ExamBundle\Model\Exam',
        );
    }

    public function getName()
    {
        return 'Exam';
    }

}

