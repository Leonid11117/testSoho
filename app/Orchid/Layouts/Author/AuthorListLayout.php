<?php

namespace App\Orchid\Layouts\Author;

use Orchid\Screen\TD;
use App\Models\Author;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class AuthorListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = Author::TABLE_NAME;

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make(Author::COLUMN_ID, 'id')->render(function (Author $author) {
                return Link::make($author->id)
                    ->route('authors.edit', $author);
            }),
            TD::make(Author::COLUMN_NAME, 'Имя'),
            TD::make(Author::COLUMN_BIOGRAPHY, 'Биография'),
            TD::make(Author::CREATED_AT, 'created_at'),
            TD::make(Author::UPDATED_AT, 'updated_at'),
        ];
    }
}
