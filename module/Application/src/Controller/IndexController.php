<?php

namespace Application\Controller;

use Application\Entity\User;
use Application\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        /** @var UserRepository $userRepo */
        $userRepo = $em->getRepository(User::class);
        $u = $userRepo->find(1);
        echo '<pre>';
        var_dump($u);
        exit;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
}
