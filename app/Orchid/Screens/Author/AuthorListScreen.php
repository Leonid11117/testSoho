<?php

namespace App\Orchid\Screens\Author;

use App\Models\Author;
use Orchid\Screen\Screen;
use Orchid\Screen\Layout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use JetBrains\PhpStorm\ArrayShape;
use App\Orchid\Layouts\Author\AuthorListLayout;

class AuthorListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    #[ArrayShape(
        [
            Author::TABLE_NAME => "\Illuminate\Contracts\Pagination\LengthAwarePaginator",
        ]
    )]
    public function query(): iterable
    {
        return [
            Author::TABLE_NAME => Author::query()->paginate(20),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Автора книг';
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить автора')
                ->icon('pencil')
                ->route('authors.edit'),
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
            AuthorListLayout::class,
        ];
    }
}
