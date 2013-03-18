<?php

namespace Smirik\ExamBundle\Controller\Base;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Smirik\PropelAdminBundle\Controller\AdminAbstractController as AbstractController;

class AdminExamTypeController extends AbstractController
{
	
	public $layout = 'SmirikAdminBundle::layout.html.twig';
	public $name   = 'exams_types';
	public $bundle = 'SmirikExamBundle';

	public function getQuery()
	{
		return \Smirik\ExamBundle\Model\ExamTypeQuery::create();
	}
	
	public function getForm()
	{
		return new \Smirik\ExamBundle\Form\Type\ExamTypeType;
	}
	
	public function getObject()
	{
		return new \Smirik\ExamBundle\Model\ExamType;
	}

}

