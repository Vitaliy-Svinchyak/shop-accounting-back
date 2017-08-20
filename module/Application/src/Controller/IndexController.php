<?php

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
}
