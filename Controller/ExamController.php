<?php

namespace Smirik\ExamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * @Route("/exams")
 */
class ExamController extends Controller
{
    /**
     * @Route("/", name="exam_index")
     * @Template()
     * @Secure(roles="ROLE_USER")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $exam_manager = $this->get('exam.manager');

        $user_exams = $exam_manager->getByUser($user);

        return array(
            'user_exams' => $user_exams,
        );
    }
}
