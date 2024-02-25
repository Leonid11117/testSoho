<?php

namespace App\Repositories\Author;

use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;

class AuthorRepository
{
    /**
     * @param string $request
     *
     * @return Builder
     */
    public function getAuthorNameExists(string $request): Builder
    {
        return Author::query()->where(Author::COLUMN_NAME, '=', $request);
    }
}
