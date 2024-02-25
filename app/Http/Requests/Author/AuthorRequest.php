<?php

namespace App\Http\Requests\Author;

use App\Models\Author;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed authors
 */
class AuthorRequest extends FormRequest
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
            Author::TABLE_NAME . '.' . Author::COLUMN_NAME => ['required', 'string', 'min:1', 'max:255'],
            Author::TABLE_NAME . '.' . Author::COLUMN_BIOGRAPHY => ['required', 'string', 'min:10', 'max:10000']
        ];
    }
}
