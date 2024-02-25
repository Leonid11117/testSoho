<?php

namespace App\Orchid\Screens\Book;

use App\Models\Book;
use App\Models\Author;
use Orchid\Screen\Screen;
use App\DTO\Book\BookItemDTO;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use JetBrains\PhpStorm\ArrayShape;
use Orchid\Support\Facades\Layout;
use App\Services\Book\BookService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Book\BookRequest;

class BookEditScreen extends Screen
{

    private bool $exists = false;

    private string $name = 'Добавление новой Книги';

    /**
     * Query data.
     *
     * @return array
     */
    #[ArrayShape(
        [
            Book::TABLE_NAME => "\App\Models\Book",
        ]
    )]
    public function query(Book $book): iterable
    {
        $this->exists = $book->exists;

        if ($this->exists) {
            $this->name = 'Редактирование книгу';
        }

        return [
            Book::TABLE_NAME => $book,
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
                Select::make(Book::TABLE_NAME . '.' . Book::COLUMN_AUTHOR_ID)->title('Автор id')
                    ->fromModel(Author::class, 'name')->empty('Не выбрано'),
                Input::make(Book::TABLE_NAME . '.' . Book::COLUMN_TITLE)
                    ->title('Название')
                    ->placeholder('Введите название')
                    ->value(old(Book::TABLE_NAME . '.' . Book::COLUMN_TITLE, '')),
                Input::make(Book::TABLE_NAME . '.' . Book::COLUMN_DESCRIPTION)
                    ->title('Описание')
                    ->placeholder('Введите описание')
                    ->value(old(Book::TABLE_NAME . '.' . Book::COLUMN_DESCRIPTION, '')),
                Input::make(Book::TABLE_NAME . '.' . Book::COLUMN_PRICE)
                    ->title('Цена')
                    ->placeholder('Введите цену')
                    ->value(old(Book::TABLE_NAME . '.' . Book::COLUMN_PRICE, '')),
            ]),
        ];
    }

    /**
     * @param BookRequest $request
     * @param BookService $bookService
     *
     * @return RedirectResponse
     */
    public function create(
        BookRequest $request,
        BookService $bookService
    ): RedirectResponse {
        $item = new BookItemDTO(
            authorId: $request->books[Book::COLUMN_AUTHOR_ID],
            title: $request->books[Book::COLUMN_TITLE],
            description: $request->books[Book::COLUMN_DESCRIPTION],
            price: $request->books[Book::COLUMN_PRICE]
        );

        $bookService->create($item);
        Alert::info('Книга успешно создана');

        return redirect()->route('books.list');
    }

    /**
     * @param Book $book
     * @param BookRequest $request
     * @param BookService $bookService
     *
     * @return RedirectResponse
     */
    public function update(
        Book $book,
        BookRequest $request,
        BookService $bookService
    ): RedirectResponse {
        $item = new BookItemDTO(
            authorId: $request->books[Book::COLUMN_AUTHOR_ID],
            title: $request->books[Book::COLUMN_TITLE],
            description: $request->books[Book::COLUMN_DESCRIPTION],
            price: $request->books[Book::COLUMN_PRICE]
        );

        $item->setId($book->id);
        $bookService->update($item);

        Alert::info('Книга успешно обновилена');

        return redirect()->route('books.list');
    }

    /**
     * @param Book $book
     * @param BookService $authorService
     *
     * @return RedirectResponse
     */
    public function remove(Book $book, BookService $authorService): RedirectResponse
    {
        $authorService->delete(id: $book->id);

        Alert::info('Книга был успешно удалена');

        return redirect()->route('books.list');
    }
}
