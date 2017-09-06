<?php

namespace Application\Controller;

use Application\Entity\User;
use Application\Entity\UserAuth;
use Application\Service\AuthManager;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $em;
    private $serviceLocator;

    public function __construct(EntityManager $em, ServiceLocatorInterface $serviceLocator)
    {
        $this->em = $em;
        $this->serviceLocator = $serviceLocator;
    }

    public function indexAction()
    {
//        $user = $this->serviceLocator
//            ->get(AuthManager::class)
//            ->getUser();
        /** @var User $user */
        $user = $this->em->getRepository(User::class)->find(1);
//        $auth = $user->getAuth()->first();
        echo '<pre>';
        print_r($user->getShops()->count());
//        print_r($user);
        exit;

//        /** @var UserAuth $userauth */
//        $userauth = $this->em->getRepository(UserAuth::class)->find(1);
//        echo '<pre>';
//        print_r($userauth->getUser()->getId());
//        exit;

        return new ViewModel();
    }
}
