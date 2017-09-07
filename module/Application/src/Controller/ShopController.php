<?php

namespace Application\Controller;

use Application\Service\ShopService;
use Zend\Http\Request;

class ShopController extends ProjectRestfulController
{
    public function create($data)
    {
        /** @var ShopService $service */
        $service = $this->getServiceLocator()->get(ShopService::class);
        $result = $service->createShop($data);

        return $this->successResponse($result);
    }

    public function getList()
    {
        /** @var ShopService $service */
        $service = $this->getServiceLocator()->get(ShopService::class);
        $result = $service->getShopsByOfCurrentUser();

        return $this->successResponse($result);
    }

    public function getShopStocksAction()
    {
        /** @var Request $request */
        $shopId = $this->params()->fromRoute('id');
        /** @var ShopService $service */
        $service = $this->getServiceLocator()->get(ShopService::class);
        $result = $service->getShopStocks((int)$shopId);

        return $this->successResponse($result);
    }
}