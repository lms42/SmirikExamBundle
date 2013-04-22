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
    
    /**
     * @Route("/admin/exams/{id}/close", name="admin_exams_close")
     * @ParamConverter("exam", options={ "mapping"={ "id" : "id" }})
     */
    public function closeAction(\Smirik\ExamBundle\Model\Exam $exam)
    {
        $exam_manager = $this->get('exam.manager');
        $exam_manager->close($exam);
        return $this->redirect($this->generateUrl('admin_exams_index'));
    }
    
    /**
     * @Route("/admin/exams/{id}/diff", name="admin_exams_user_diff")
     * @ParamConverter("$exam_user", options={ "mapping"={ "id" : "id" }})
     * @Template("SmirikExamBundle:Admin/Exam:diff.html.twig")
     */
    public function diffAction(\Smirik\ExamBundle\Model\ExamUser $exam_user)
    {
        $exam_user_manager = $this->get('exam_user.manager');
        $diff = $exam_user_manager->diff($exam_user);
        
        return array(
            'diff' => $diff,
            'exam_user' => $exam_user,
            'exam' => $exam_user->getExam(),
            'user' => $exam_user->getUser(),
        );
    }
    
}

