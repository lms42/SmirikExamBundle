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
    
    public function start()
    {
        $this->setStatus(1);
    }
    
    public function close()
    {
        $this->setStatus(2);
    }
    
}
