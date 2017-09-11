<?php


namespace Application\Controller;


use Application\Service\StockService;
use Zend\Http\Request;

class StockController extends ProjectRestfulController
{
    public function getProductsAction()
    {
        /** @var Request $request */
        $shopId = $this->params()->fromRoute('id');
        /** @var StockService $service */
        $service = $this->getServiceLocator()->get(StockService::class);
        $result = $service->getStockProducts((int)$shopId);

        return $this->successResponse($result);
    }
}
