<?php
    
namespace Smirik\ExamBundle\Manager;

use Smirik\ExamBundle\Model\ExamUserQuery;
use Smirik\ExamBundle\Model\ExamUser;

class ExamManager
{
    
    protected $user_quiz_manager;
    
    public function setUserQuizManager($user_quiz_manager)
    {
        $this->user_quiz_manager = $user_quiz_manager;
    }
    
    /**
     * Assign users to exam
     * @param \Smirik\ExamBundle\Model\Exam $exam
     * @param array $ids
     * @return void
     */
    public function assign($exam, $ids)
    {
        foreach ($ids as $id)
        {
            $this->findOrCreate($exam, $id);
        }
    }
    
    /**
     * Find or creates link between user & exam
     * @param \Smirik\ExamBundle\Model\Exam $exam
     * @param integer $user_id
     * @return \Smirik\ExamBundle\Model\ExamUser
     */
    public function findOrCreate($exam, $user_id)
    {
        $exam_user = ExamUserQuery::create()
            ->filterByUserId($user_id)
            ->filterByExamId($exam->getId())
            ->findOne()
        ;
        
        if (!$exam_user)
        {
            $exam_user = new ExamUser();
            $exam_user->setUserId($user_id);
            $exam_user->setExam($exam);
            $exam_user->save();
        }
        
        return $exam_user;
    }
    
    /**
     * Get results of exam
     * @param \Smirik\ExamBundle\Model\Exam $exam
     * @return array
     */
    public function getResults($exam)
    {
        $exam_users = ExamUserQuery::create()
            ->filterByExamId($exam->getId())
            ->joinUserQuiz('uq', 'left join')
            ->find();
        return $exam_users;
    }
        
    /**
     * @param \Smirik\ExamBundle\Model\Exam $exam
     * @return void
     */
    public function start($exam)
    {
        $quiz = $exam->getQuiz();
        foreach ($exam->getExamUsers() as $exam_user)
        {
            $user_quiz = $this->user_quiz_manager->findOrCreate($exam_user->getUser(), $quiz);
            $exam_user->setUserQuizId($user_quiz->getId());
            $exam_user->save();
        }
        $exam->setStatus(1);
        $exam->save();
    }
    
    /**
     * Get exams passed by user
     * @param object $user
     * @return PropelObjectCollection
     */
    public function getByUser($user)
    {
        $user_exams = ExamUserQuery::create()
            ->filterByUserId($user->getId())
            ->joinUserQuiz('uq', 'left join')
            ->useUserQuizQuery()
                ->orderByCreatedAt('desc')
            ->endUse()
            ->find();
        return $user_exams;
    }
    
}