<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Helpers\ArrayHelper;
use App\DTO\Book\BookItemDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class BookService
{

    /**
     * Метод для создание книги
     *
     * @param BookItemDTO $item
     *
     * @return Model|Builder
     */
    public function create(BookItemDTO $item): Model|Builder
    {
        return Book::query()->create($this->formDataArray($item));
    }

    /**
     * @param BookItemDTO $item
     *
     * @return array
     */
    private function formDataArray(BookItemDTO $item): array
    {
        return ArrayHelper::filterEmpty([
            Book::COLUMN_AUTHOR_ID => $item->getAuthorId(),
            Book::COLUMN_TITLE => $item->getTitle(),
            Book::COLUMN_DESCRIPTION => $item->getDescription(),
            Book::COLUMN_PRICE => $item->getPrice(),
        ]);
    }


    /**
     * Метод для обновления
     *
     * @param BookItemDTO $item
     *
     * @return int
     */
    public function update(BookItemDTO $item): int
    {
        return Book::query()->where(Book::COLUMN_ID, $item->getId())->update($this->formDataArray($item));
    }

    /**
     * Метод для удаления
     *
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id): bool
    {
        return Book::query()->where(Book::COLUMN_ID, $id)->delete();
    }
}
