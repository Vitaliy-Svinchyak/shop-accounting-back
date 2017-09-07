<?php

namespace Application\Controller;

use Application\Entity\Shop;
use Application\Entity\Stock;
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

        $shop = $this->em->getRepository(Shop::class)->find(2);
        echo '<pre>';
        print_r($shop->getStocks());
        exit;


        return new ViewModel();
    }
}
