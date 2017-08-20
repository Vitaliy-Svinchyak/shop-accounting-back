<?php

namespace Application\Controller;

use Application\Entity\User;
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
        /** @var User $user */
        $user = $this->em->getRepository(User::class)->find(1);
        echo '<pre>';
        print_r(count($user->getAuth()));
        exit;
        return new ViewModel();
    }
}
