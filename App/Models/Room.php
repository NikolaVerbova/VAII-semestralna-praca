<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Miestnosť v domácej knižnici (tabuľka `rooms`).
 */
class Room extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?int $floorNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getFloorNumber(): ?int
    {
        return $this->floorNumber;
    }

    public function setFloorNumber(?int $floorNumber): void
    {
        $this->floorNumber = $floorNumber;
    }
}
