<?php

namespace tests;

use Generator;
use Modules\Inventory\Exceptions\LowInventoryException;
use Modules\Inventory\Exceptions\OutOfStockException;
use Modules\Inventory\Model\InventoryItem;
use Modules\Inventory\Repository\InventoryRepository;
use Modules\Inventory\Service\InventoryService;
use PHPUnit\Framework\TestCase;

final class InventoryServiceTest extends TestCase
{
    private const ITEM_ID = '123';
    private const ITEM_NAME = 'Test Item';
    private const LOW_QUANTITY = 3;
    private const OUT_OF_STOCK_QUANTITY = 0;
    private const AVAILABLE_QUANTITY = 300;

    private InventoryService $inventoryService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->inventoryService = new InventoryService(new InventoryRepository());
    }

    public function testCreateInventoryItem(): void
    {
        $item = $this->inventoryService->createInventoryItem(self::ITEM_ID, self::ITEM_NAME, 10);

        $this->assertInstanceOf(InventoryItem::class, $item);
        $this->assertEquals(self::ITEM_ID, $item->getId());
        $this->assertEquals(self::ITEM_NAME, $item->getName());
    }

    public function testGetInventoryItem(): void
    {
        $this->inventoryService->createInventoryItem(self::ITEM_ID, self::ITEM_NAME, 20);
        $item = $this->inventoryService->getInventoryItem(self::ITEM_ID);

        $this->assertInstanceOf(InventoryItem::class, $item);
        $this->assertEquals(self::ITEM_ID, $item->getId());
        $this->assertEquals(self::ITEM_NAME, $item->getName());
    }

    public function testGetNonExistentItemReturnsNull(): void
    {
        $item = $this->inventoryService->getInventoryItem('nonexistent');
        $this->assertNull($item);
    }

    /**
     * @dataProvider checkInventoryProvider
     */
    public function testCheckInventory(int $quantity, $exception): void
    {
        $this->inventoryService->createInventoryItem(self::ITEM_ID, self::ITEM_NAME, $quantity);

        if ($exception) {
            $this->expectException($exception);
        }

        $actual = $this->inventoryService->checkInventory(self::ITEM_ID);

        if (!$exception) {
            $this->assertEquals($quantity, $actual);
        }
    }

    public static function checkInventoryProvider(): Generator
    {
        yield 'Low Inventory' => [
            self::LOW_QUANTITY,
            LowInventoryException::class
        ];

        yield 'Out of Stock' => [
            self::OUT_OF_STOCK_QUANTITY,
            OutOfStockException::class
        ];

        yield 'Available Inventory' => [
            self::AVAILABLE_QUANTITY,
            null
        ];
    }
}
