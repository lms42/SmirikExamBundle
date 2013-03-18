<?php

namespace Smirik\ExamBundle\Model;

use Smirik\ExamBundle\Model\om\BaseExam;

class Exam extends BaseExam
{
    
    public function isStarted()
    {
        return ($this->getStatus() == 1);
    }

    public function isClosed()
    {
        return ($this->getStatus() == 2);
    }
    
}
