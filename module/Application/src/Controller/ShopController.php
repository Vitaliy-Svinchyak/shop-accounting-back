<?php

namespace Application\Controller;

use Application\Service\ShopService;

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
}