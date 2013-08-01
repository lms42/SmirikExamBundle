<?php

namespace Smirik\ExamBundle\Listener;

use Smirik\AdminBundle\Event\ConfigureMenuEvent;

class ConfigureMenuListener
{

    protected $security_context;
    protected $translator;

    public function __construct($security_context, $translator)
    {
        $this->security_context = $security_context;
        $this->translator = $translator;
    }

    /**
     * @param \Smirik\AdminBundle\Event\ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();
        $menu['admin.quiz.menu']->addChild('Exams', array('route' => 'admin_exams_index'));
        $menu['admin.quiz.menu']->addChild('Exams types', array('route' => 'admin_exams_types_index'));
    }
    
    public function onMainMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $key = 'Results';


        if ($this->security_context->isGranted('ROLE_USER')) {

            if (!isset($menu[$key])) {
                $menu->addChild($key, array('route' => 'account_my'));
            }

            $menu[$key]->addChild('Exams results', array('route' => 'exam_index'));
        }
    }

}