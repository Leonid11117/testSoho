<?php

namespace App\Services\Author;

use App\Models\Author;
use App\Helpers\ArrayHelper;
use App\DTO\Author\AuthorItemDTO;
use Illuminate\Database\Eloquent\Model;

class AuthorService
{
    /**
     * Method for adding new records
     *
     * @param AuthorItemDTO $item
     *
     * @return Model|null
     */
    public function create(AuthorItemDTO $item): ?Model
    {
        return Author::query()->create($this->formDataArray($item));
    }

    /**
     * @param AuthorItemDTO $item
     *
     * @return array
     */
    private function formDataArray(AuthorItemDTO $item): array
    {
        return ArrayHelper::filterEmpty([
            Author::COLUMN_NAME => $item->getName(),
            Author::COLUMN_BIOGRAPHY => $item->getBiography(),
        ]);
    }

    /**
     * Updating the record
     *
     * @param AuthorItemDTO $item
     *
     * @return int
     */
    public function update(AuthorItemDTO $item): int
    {
        return Author::query()->where(Author::COLUMN_ID, $item->getId())->update($this->formDataArray($item));
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function delete(int $id): bool
    {
        return Author::query()->where(Author::COLUMN_ID, $id)->delete();
    }
}
