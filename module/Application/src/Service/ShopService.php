<?php

namespace Application\Service;

use Application\Entity\Shop;
use Application\Entity\User;
use Application\Form\ShopForm;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

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
        $em = $this->getEntityManager();
        $hydrator = new DoctrineHydrator($em);
        $shop = new Shop();
        $hydrator->hydrate($data, $shop);
        $shop->addUser(
            $this->getServiceLocator()
                ->get(AuthManager::class)
                ->getUser()
        );

        $em->persist($shop);
        $em->flush($shop);

        return true;
    }

    /**
     * @return Shop[]
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function getShopsByOfCurrentUser()
    {
        /** @var User $user */
        $user = $this->getServiceLocator()
            ->get(AuthManager::class)
            ->getUser();

        return $user->getShops()->toArray();
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