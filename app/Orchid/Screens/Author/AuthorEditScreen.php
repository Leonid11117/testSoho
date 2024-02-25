<?php

namespace App\Orchid\Screens\Author;

use App\Models\Author;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Actions\Button;
use App\DTO\Author\AuthorItemDTO;
use Orchid\Support\Facades\Alert;
use JetBrains\PhpStorm\ArrayShape;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\RedirectResponse;
use App\Services\Author\AuthorService;
use App\Http\Requests\Author\AuthorRequest;

class AuthorEditScreen extends Screen
{
    private bool $exists = false;

    private string $name = 'Добавление нового Автора';

    /**
     * Query data.
     *
     * @return array
     */
    #[ArrayShape(
        [
            Author::TABLE_NAME => "\App\Models\Author",
        ]
    )]
    public function query(Author $author): iterable
    {
        $this->exists = $author->exists;

        if ($this->exists) {
            $this->name = 'Редактирование автора';
        }

        return [
            Author::TABLE_NAME => $author,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать')
                ->icon('pencil')
                ->method('create')
                ->canSee(!$this->exists),

            Button::make('Сохранить')
                ->icon('note')
                ->method('update')
                ->canSee($this->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->confirm('Уверены что хотите безвозвратно удалить выбранный элемент')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make(Author::TABLE_NAME . '.' . Author::COLUMN_NAME)
                    ->title('Имя')
                    ->placeholder('Введите Имя')
                    ->value(old(Author::TABLE_NAME . '.' . Author::COLUMN_NAME, '')),
                Input::make(Author::TABLE_NAME . '.' . Author::COLUMN_BIOGRAPHY)
                    ->title('Биография')
                    ->placeholder('Введите биографию')
                    ->value(old(Author::TABLE_NAME . '.' . Author::COLUMN_BIOGRAPHY, '')),
            ]),
        ];
    }

    /**
     * @param AuthorRequest $request
     * @param AuthorService $authorService
     *
     * @return RedirectResponse
     */
    public function create(
        AuthorRequest $request,
        AuthorService $authorService
    ): RedirectResponse {
        $item = new AuthorItemDTO(
            name: $request->authors[Author::COLUMN_NAME],
            biography: $request->authors[Author::COLUMN_BIOGRAPHY]
        );

        $authorService->create($item);

        Alert::info('Автор успешно создан');

        return redirect()->route('authors.list');
    }

    /**
     * @param Author $author
     * @param AuthorRequest $request
     * @param AuthorService $authorService
     *
     * @return RedirectResponse
     */
    public function update(
        Author $author,
        AuthorRequest $request,
        AuthorService $authorService
    ): RedirectResponse {
        $item = new AuthorItemDTO(
            name: $request->authors[Author::COLUMN_NAME],
            biography: $request->authors[Author::COLUMN_BIOGRAPHY]
        );

        $item->setId($author->id);
        $authorService->update($item);

        Alert::info('Автор успешно обновил');

        return redirect()->route('authors.list');

    }

    /**
     * @param Author $author
     * @param AuthorService $authorService
     *
     * @return RedirectResponse
     */
    public function remove(Author $author, AuthorService $authorService): RedirectResponse
    {
        $authorService->delete(id: $author->id);

        Alert::info('Автор был успешно удален');

        return redirect()->route('authors.list');
    }
}
