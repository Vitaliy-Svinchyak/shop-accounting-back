<?php


namespace Application\Service;


use Application\Entity\Product;
use Application\Entity\ProductToStock;
use Application\Entity\Stock;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceManager;

class StockService
{
    /**
     * @var ServiceManager
     */
    protected $serviceLocator;

    public function __construct(ContainerInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getStockProducts(int $stockId)
    {
        /** @var EntityManager $em */
        $em = $this->serviceLocator->get(EntityManager::class);
        $stockRepo = $em->getRepository(Stock::class);
        /** @var Stock $stock */
        $stock = $stockRepo->find($stockId);
        $relations = $stock->getProductsToStock();
        $ids = [];

        foreach ($relations as $relation) {
            $ids[] = $relation->getProduct()->getId();
        }

        $ids = array_unique($ids);
        $productRepo = $em->getRepository(Product::class);
        /** @var Product[] $products */
        $products = $productRepo->createQueryBuilder('p')
            ->where('p.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();

        return $products;
    }
}