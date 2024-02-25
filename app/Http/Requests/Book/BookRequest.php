<?php

namespace App\Http\Requests\Book;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed books
 */
class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            book::TABLE_NAME . '.' . Book::COLUMN_TITLE => ['required', 'string', 'min:1', 'max:1000'],
            book::TABLE_NAME . '.' . Book::COLUMN_DESCRIPTION => ['required', 'string', 'min:10', 'max:10000'],
            book::TABLE_NAME . '.' . Book::COLUMN_PRICE => ['required', 'integer']
        ];
    }
}
