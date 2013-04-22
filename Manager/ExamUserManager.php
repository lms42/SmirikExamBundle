<?php
    
namespace Smirik\ExamBundle\Manager;

class ExamUserManager
{
    
    protected $question_manager;
    
    public function setManagers($question_manager)
    {
        $this->question_manager = $question_manager;
    }
    
    public function diff($exam_user)
    {
        $user_quiz = $exam_user->getUserQuiz();
        
        $questions      = $this->question_manager->getByIds(json_decode($user_quiz->getQuestions()));
        $user_questions = $this->question_manager->getUserQuestions($user_quiz);
        $answers        = $this->question_manager->getRightAnswers($questions);
        
        $user_answers   = $this->question_manager->getUserAnswers($user_questions);
        
        $user_questions = $user_questions->toArray('QuestionId');
        
        return array(
            'user_quiz'      => $user_quiz,
            'questions'      => $questions,
            'user_questions' => $user_questions,
            'answers'        => $answers,
            'user_answers'   => $user_answers,
        );
    }
    
}