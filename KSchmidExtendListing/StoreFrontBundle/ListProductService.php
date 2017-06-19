<?php

namespace KSchmidExtendListing\StoreFrontBundle;

use Shopware\Bundle\StoreFrontBundle\Service\ListProductServiceInterface;
use Shopware\Bundle\StoreFrontBundle\Struct\Attribute;
use Shopware\Bundle\StoreFrontBundle\Struct\ListProduct;
use Shopware\Bundle\StoreFrontBundle\Struct\ProductContextInterface;
use Shopware\Bundle\StoreFrontBundle\Service\PropertyServiceInterface;

class ListProductService implements ListProductServiceInterface
{
    /**
     * @var ListProductServiceInterface
     */
    private $service;

    /**
     * @var PropertyServiceInterface
     */
    private $propertyService;

    /**
     * @param ListProductServiceInterface $service
     * @param PropertyServiceInterface $propertyService
     */
    public function __construct(ListProductServiceInterface $service, PropertyServiceInterface $propertyService)
    {
        $this->service = $service;
        $this->propertyService = $propertyService;
    }

    /**
     * @inheritdoc
     */
    public function getList(array $numbers, ProductContextInterface $context)
    {
        $products = $this->service->getList($numbers, $context);
        $properties = $this->propertyService->getList($products, $context);

        //Iterate over all products an add the property attribute
        /**
         * @var $product ListProduct
         */
        foreach ($products as $product) {
            $attribute = new Attribute();
            $product->addAttribute('kschmidExtendListing', $attribute);

            if (isset($properties[$product->getNumber()])) {
                $attribute->set('productProperties', $properties[$product->getNumber()]->getGroups());
            }

            //SetManufacturerLink for Frontend
            $attribute->set('supplierLink', $product->getManufacturer()->getLink());
        }

        return $products;
    }

    /**
     * @inheritdoc
     */
    public function get($number, ProductContextInterface $context)
    {
        return array_shift($this->getList([$number], $context));
    }

}

