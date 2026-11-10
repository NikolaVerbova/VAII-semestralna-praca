<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Room;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Správa miestností (CRUD): zoznam, pridanie, úprava a zmazanie.
 */
class RoomController extends BaseController
{
    /** Zoznam miestností (Read) */
    public function index(Request $request): Response
    {
        $bookCounts = [];
        foreach (Book::getAll() as $book) {
            $roomId = $book->getRoomId();

            if ($roomId === null) {
                continue;
            }
            $bookCounts[$roomId] = ($bookCounts[$roomId] ?? 0) + 1;
        }

        return $this->html([
            'rooms' => Room::getAll(orderBy: '`name` asc'),
            'bookCounts' => $bookCounts,
        ]);
    }
    /*public function index(Request $request): Response
    {
        $bookCounts = [];
        foreach (Book::getAll() as $book) {
            $roomId = $book->getRoomId();
            $bookCounts[$roomId] = ($bookCounts[$roomId] ?? 0) + 1;
        }
        return $this->html([
            'rooms' => Room::getAll(orderBy: '`name` asc'),
            'bookCounts' => $bookCounts,
        ]);
    }*/

    /** Prázdny formulár (Create) */
    public function add(Request $request): Response
    {
        return $this->html(['room' => new Room(), 'errors' => []], 'form');
    }

    /** Predvyplnený formulár (Update) */
    public function edit(Request $request): Response
    {
        $room = $this->getRoomOr404((int)$request->value('id'));
        return $this->html(['room' => $room, 'errors' => []], 'form');
    }

    /** Uloženie nového alebo upraveného záznamu */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        // nová miestnosť, alebo úprava existujúcej?
        $id = (int)$request->post('id');
        $room = $id > 0 ? $this->getRoomOr404($id) : new Room();

        $description = trim((string)$request->post('description'));
        $floor = filter_var(trim((string)$request->post('floorNumber')), FILTER_VALIDATE_INT);

        $room->setName(trim((string)$request->post('name')));
        $room->setDescription($description === '' ? null : $description);
        $room->setFloorNumber($floor === false ? null : $floor);

        $errors = $this->validate($room, $floor !== false);
        if (count($errors) > 0) {
            return $this->html(['room' => $room, 'errors' => $errors], 'form');
        }

        $room->save();
        return $this->redirect($this->url('room.index'));
    }

    /** Zmazanie záznamu (Delete) */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }
        $room = $this->getRoomOr404((int)$request->post('id'));
        $room->delete();
        return $this->redirect($this->url('room.index'));
    }

    private function getRoomOr404(int $id): Room
    {
        $room = Room::getOne($id);
        if ($room === null) {
            throw new HttpException(404);
        }
        return $room;
    }

    private function validate(Room $room, bool $floorIsNumber): array
    {
        $errors = [];
        if ($room->getName() === '') {
            $errors[] = 'Názov miestnosti nesmie byť prázdny.';
        } elseif (mb_strlen($room->getName()) > 100) {
            $errors[] = 'Názov miestnosti môže mať najviac 100 znakov.';
        }
        if ($room->getDescription() !== null && mb_strlen($room->getDescription()) > 255) {
            $errors[] = 'Popis môže mať najviac 255 znakov.';
        }
        if (!$floorIsNumber) {
            $errors[] = 'Poschodie musí byť celé číslo.';
        }
        return $errors;
    }
}
