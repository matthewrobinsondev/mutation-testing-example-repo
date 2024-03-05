<?php

declare(strict_types=1);

namespace Modules\Inventory\Repository;

use Modules\Inventory\Model\InventoryItem;

class InventoryRepository
{
    /**
     * @var array<string, InventoryItem> $items
     */
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
