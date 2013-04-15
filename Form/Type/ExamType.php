<?php

namespace Smirik\ExamBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ExamType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('started_at', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('exam_type', 'model', array(
                  'class' => 'Smirik\ExamBundle\Model\ExamType',
                  'required' => false,
            ))
            ->add('quiz', 'model', array(
                  'class' => 'Smirik\QuizBundle\Model\Quiz',
                  'required' => false,
            ))
            ->add('quiz')
            ->add('description')
            ->add('status', 'choice', array(
                'choices' => array(
                    0 => 'Pending',
                    1 => 'Started',
                    2 => 'Closed' ,  
                ),
            ));
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

