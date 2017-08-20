<?php

namespace Application\Service;

use Application\Entity\Shop;
use Application\Form\ShopForm;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ArraySerializable;
use Zend\ServiceManager\ServiceManager;

class ShopService
{
    /**
     * @var ServiceManager
     */
    protected $serviceLocator;

    public function __construct(ContainerInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function createShop(array $data): bool
    {
        $form = new ShopForm();
        $form->setData($data);

        if (!$form->isValid()) {
            return false;
        }

        $hydrator = new ArraySerializable();
        $shop = new Shop();
        $hydrator->hydrate($data, $shop);
        $em = $this->getEntityManager();
//        $em->persist($shop);
//        $em->flush($shop);

        return true;
    }

    /**
     * @return ServiceManager
     */
    public function getServiceLocator(): ServiceManager
    {
        return $this->serviceLocator;
    }

    public function getEntityManager(): EntityManager
    {
        return $this->getServiceLocator()->get(EntityManager::class);
    }
}