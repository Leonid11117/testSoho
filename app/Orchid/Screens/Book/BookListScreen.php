<?php

namespace App\Orchid\Screens\Book;

use App\Models\Book;
use Orchid\Screen\Screen;
use Orchid\Screen\Action;
use Orchid\Screen\Layout;
use Orchid\Screen\Actions\Link;
use JetBrains\PhpStorm\ArrayShape;
use App\Orchid\Layouts\Book\BookListLayout;

class BookListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    #[ArrayShape(
        [
            Book::TABLE_NAME => "\Illuminate\Contracts\Pagination\LengthAwarePaginator",
        ]
    )]
    public function query(): iterable
    {
        return [
            Book::TABLE_NAME => Book::query()->filters()->defaultSort('id')->paginate(20),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Книги';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить книгу')
                ->icon('pencil')
                ->route('books.edit'),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            BookListLayout::class,
        ];
    }
}
