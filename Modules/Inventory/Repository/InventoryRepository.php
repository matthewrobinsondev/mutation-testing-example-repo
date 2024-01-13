<?php

namespace Modules\Inventory\Repository;

use Modules\Inventory\Model\InventoryItem;

class InventoryRepository
{
    private array $items = [];

    public function addItem(InventoryItem $item): void
    {
        $this->items[$item->getId()] = $item;
    }

    public function getItem(string $id): ?InventoryItem
    {
        return $this->items[$id] ?? null;
    }
}
