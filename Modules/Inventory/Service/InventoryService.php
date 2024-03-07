<?php

declare(strict_types=1);

namespace Modules\Inventory\Service;

use Modules\Inventory\Exceptions\LowInventoryException;
use Modules\Inventory\Exceptions\OutOfStockException;
use Modules\Inventory\Model\InventoryItem;
use Modules\Inventory\Repository\InventoryRepository;

class InventoryService
{
    public function __construct(private readonly InventoryRepository $repository)
    {
    }

    public function createInventoryItem(string $id, string $name, int $quantity): InventoryItem
    {
        $item = new InventoryItem($id, $name, $quantity);
        $this->repository->addItem($item);
        return $item;
    }

    public function getInventoryItem(string $id): ?InventoryItem
    {
        return $this->repository->getItem($id);
    }

    /**
     * @throws OutOfStockException
     * @throws LowInventoryException
     */
    public function checkInventory(string $itemId): int
    {
        $item = $this->repository->getItem($itemId);

        $quantity = $item->getQuantity();

        if ($quantity === 0) {
            throw new OutOfStockException("Remove {$itemId} from being available.");
        }

        if ($quantity < 10) {
            throw new LowInventoryException("Order stock for {$itemId}");
        }

        return $quantity;
    }
}
