<?php declare(strict_types=1);

namespace Shopware\ShippingMethod\Test\Repository;

use Shopware\Context\Struct\TranslationContext;
use Shopware\Search\Criteria;
use Shopware\Search\UuidSearchResult;
use Shopware\ShippingMethod\Repository\ShippingMethodRepository;
use Shopware\ShippingMethod\Searcher\ShippingMethodSearchResult;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ShippingMethodRepositoryTest extends KernelTestCase
{
    /**
     * @var ShippingMethodRepository
     */
    private $repository;

    public function setUp()
    {
        self::bootKernel();
        $this->repository = self::$kernel->getContainer()->get('shopware.shipping_method.repository');
    }

    public function testSearchUuidsReturnsUuidSearchResult()
    {
        $context = new TranslationContext('SWAG-SHOP-UUID-1', true, null);
        $criteria = new Criteria();
        $criteria->setLimit(1);
        $result = $this->repository->searchUuids($criteria, $context);

        $this->assertInstanceOf(UuidSearchResult::class, $result);
    }

    public function testSearchReturnsSearchResult()
    {
        $context = new TranslationContext('SWAG-SHOP-UUID-1', true, null);
        $criteria = new Criteria();
        $criteria->setLimit(1);

        $result = $this->repository->search($criteria, $context);
        $this->assertInstanceOf(ShippingMethodSearchResult::class, $result);
    }
}