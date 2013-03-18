<?php

namespace Smirik\ExamBundle\Controller;

use Smirik\ExamBundle\Controller\Base\AdminExamController as BaseController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
 
use Smirik\ExamBundle\Model\ExamQuery;

class AdminExamController extends BaseController
{
	
    /**
     * @Route("/admin/exams/{id}/assign", name="admin_exams_assign")
     * @Template("SmirikExamBundle:Admin/Exam:assign.html.twig")
     * @ParamConverter("exam", options={ "mapping"={ "id" : "id" }})
     */
    public function assignAction(\Smirik\ExamBundle\Model\Exam $exam)
    {
        if ('POST' == $this->getRequest()->getMethod()) {
            $ids = $this->getRequest()->request->get('checkbox', false);
            $exam_manager = $this->get('exam.manager');
            $exam_manager->assign($exam, $ids);
            return $this->redirect($this->generateUrl('admin_exams_index'));
        }
        return array(
            'exam'  => $exam,
            'users' => array(),
        );
    }

    /**
     * @Route("/admin/exams/{id}/show", name="admin_exams_show")
     * @Template("SmirikExamBundle:Admin/Exam:show.html.twig")
     * @ParamConverter("exam", options={ "mapping"={ "id" : "id" }})
     */
    public function showAction(\Smirik\ExamBundle\Model\Exam $exam)
    {
        $exam_manager = $this->get('exam.manager');
        $exam_users   = $exam_manager->getResults($exam);
        return array(
            'exam'       => $exam,
            'exam_users' => $exam_users,
        );
    }
    
    /**
     * @Route("/admin/exams/{id}/start", name="admin_exams_start")
     * @ParamConverter("exam", options={ "mapping"={ "id" : "id" }})
     */
    public function startAction(\Smirik\ExamBundle\Model\Exam $exam)
    {
        $exam_manager = $this->get('exam.manager');
        $exam_manager->start($exam);
        return $this->redirect($this->generateUrl('admin_exams_index'));
    }
    
}

