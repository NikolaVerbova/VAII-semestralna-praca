<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * Kniha (tabuľka `books`). Cudzí kľúč `roomId` odkazuje na miestnosť (`rooms.id`).
 */
class Book extends Model
{
    protected ?int $id = null;
    protected ?string $title = null;
    protected ?string $author = null;
    protected ?int $publishYear = null;
    protected ?string $shelf = null;
    protected ?int $isAvailable = 1;
    protected ?int $roomId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    public function getPublishYear(): ?int
    {
        return $this->publishYear;
    }

    public function setPublishYear(?int $publishYear): void
    {
        $this->publishYear = $publishYear;
    }

    public function getShelf(): ?string
    {
        return $this->shelf;
    }

    public function setShelf(?string $shelf): void
    {
        $this->shelf = $shelf;
    }

    public function isAvailable(): bool
    {
        return (int)$this->isAvailable === 1;
    }

    public function setAvailable(bool $available): void
    {
        $this->isAvailable = $available ? 1 : 0;
    }

    public function getRoomId(): ?int
    {
        return $this->roomId;
    }

    public function setRoomId(?int $roomId): void
    {
        $this->roomId = $roomId;
    }
}
