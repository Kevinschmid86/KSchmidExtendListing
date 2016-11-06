<?php
/**
 * Created by PhpStorm.
 * User: kevin.schmid
 * Date: 15.08.2016
 * Time: 16:19
 */

namespace KSchmidExtendListing;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use KSchmidExtendListing\StoreFrontBundle\ListProductService;

class KSchmidExtendListing extends Plugin
{

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Bootstrap_AfterInitResource_shopware_storefront.list_product_service' => 'registerListProductService'
        ];
    }

    public function registerListProductService()
    {
        Shopware()->Container()->set(
            'shopware_storefront.list_product_service',
            new ListProductService(
                Shopware()->Container()->get('shopware_storefront.list_product_service'),
                Shopware()->Container()->get('shopware_storefront.property_service')
            )
        );
    }

    /**
     * @inheritdoc
     */
    public function install(InstallContext $context)
    {
        parent::install($context);
    }

    /**
     * @inheritdoc
     */
    public function uninstall(UninstallContext $context)
    {
        parent::uninstall($context);
    }



}