<?php

namespace App\Orchid\Layouts\Book;

use App\Models\Book;
use Orchid\Screen\TD;
use App\Models\Author;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class BookListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = Book::TABLE_NAME;

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make(Book::COLUMN_ID, 'id')->render(function (Book $book) {
                return Link::make($book->id)
                    ->route('books.edit', $book);
            }),
            TD::make(Book::COLUMN_AUTHOR_ID, 'Автор')->render(function (Book $book) {
                return $book->author->name;
            })->filter(TD::FILTER_SELECT, Author::all()->pluck('name', 'id')->toArray()),
            TD::make(Book::COLUMN_TITLE, 'Название')->filter(),
            TD::make(Book::COLUMN_DESCRIPTION, 'Описание'),
            TD::make(Book::COLUMN_PRICE, 'Цена')->filter(),
            TD::make(Book::CREATED_AT, 'Дата создания'),
        ];
    }
}
