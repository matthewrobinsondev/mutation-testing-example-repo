<?php

namespace Modules\Inventory\Model;


class InventoryItem
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly int $quantity)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }
}
