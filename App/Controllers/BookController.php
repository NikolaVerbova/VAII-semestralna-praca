<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Room;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Katalóg kníh (CRUD): zoznam, pridanie, úprava (vrátane zmeny miestnosti) a zmazanie.
 */
class BookController extends BaseController
{
    /** Zoznam kníh s názvom miestnosti (Read) */
    public function index(Request $request): Response
    {
        return $this->html([
            'books' => Book::getAll(orderBy: '`title` asc'),
            'rooms' => $this->roomsById(),
        ]);
    }

    /** Prázdny formulár (Create) */
    public function add(Request $request): Response
    {
        return $this->html(
            ['book' => new Book(), 'rooms' => Room::getAll(orderBy: '`name` asc'), 'errors' => []],
            'form'
        );
    }

    /** Predvyplnený formulár (Update) */
    public function edit(Request $request): Response
    {
        $book = $this->getBookOr404((int)$request->value('id'));
        return $this->html(
            ['book' => $book, 'rooms' => Room::getAll(orderBy: '`name` asc'), 'errors' => []],
            'form'
        );
    }

    /** Uloženie novej alebo upravenej knihy */
    public function save(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }

        $id = (int)$request->post('id');
        $book = $id > 0 ? $this->getBookOr404($id) : new Book();

        $yearText = trim((string)$request->post('publishYear'));
        $year = $yearText === '' ? null : filter_var($yearText, FILTER_VALIDATE_INT);
        $shelf = trim((string)$request->post('shelf'));
        $roomId = (int)$request->post('roomId');

        $book->setTitle(trim((string)$request->post('title')));
        $book->setAuthor(trim((string)$request->post('author')));
        $book->setPublishYear($year === false ? null : $year);
        $book->setShelf($shelf === '' ? null : $shelf);
        $book->setAvailable((string)$request->post('isAvailable') === '1');
        $book->setRoomId($roomId > 0 ? $roomId : null);

        $errors = $this->validate($book, $year !== false);
        if (count($errors) > 0) {
            return $this->html(
                ['book' => $book, 'rooms' => Room::getAll(orderBy: '`name` asc'), 'errors' => $errors],
                'form'
            );
        }

        $book->save();
        return $this->redirect($this->url('book.index'));
    }

    /** Zmazanie knihy (Delete) */
    public function delete(Request $request): Response
    {
        if (!$request->isPost()) {
            throw new HttpException(405);
        }
        $book = $this->getBookOr404((int)$request->post('id'));
        $book->delete();
        return $this->redirect($this->url('book.index'));
    }

    private function getBookOr404(int $id): Book
    {
        $book = Book::getOne($id);
        if ($book === null) {
            throw new HttpException(404);
        }
        return $book;
    }

    /** Miestnosti indexované podľa id, aby sa dal rýchlo zistiť názov miestnosti knihy */
    private function roomsById(): array
    {
        $rooms = [];
        foreach (Room::getAll() as $room) {
            $rooms[$room->getId()] = $room;
        }
        return $rooms;
    }

    private function validate(Book $book, bool $yearIsNumber): array
    {
        $errors = [];
        if ($book->getTitle() === '') {
            $errors[] = 'Názov knihy nesmie byť prázdny.';
        } elseif (mb_strlen($book->getTitle()) > 150) {
            $errors[] = 'Názov knihy môže mať najviac 150 znakov.';
        }
        if ($book->getAuthor() === '') {
            $errors[] = 'Autor nesmie byť prázdny.';
        } elseif (mb_strlen($book->getAuthor()) > 100) {
            $errors[] = 'Meno autora môže mať najviac 100 znakov.';
        }
        if (!$yearIsNumber) {
            $errors[] = 'Rok vydania musí byť celé číslo.';
        }
        if ($book->getShelf() !== null && mb_strlen($book->getShelf()) > 30) {
            $errors[] = 'Polica môže mať najviac 30 znakov.';
        }
        if ($book->getRoomId() !== null && Room::getOne($book->getRoomId()) === null) {
            $errors[] = 'Vybraná miestnosť neexistuje.';
        }
        return $errors;
    }
}
