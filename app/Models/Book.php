<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereMaxMin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int author_id
 * @property string title
 * @property string description
 * @property int price
 * @property Author[]|Collection author
 */
class Book extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public const TABLE_NAME = 'books',
        COLUMN_ID = 'id',
        COLUMN_AUTHOR_ID = 'author_id',
        COLUMN_TITLE = 'title',
        COLUMN_DESCRIPTION = 'description',
        COLUMN_PRICE = 'price';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::COLUMN_AUTHOR_ID,
        self::COLUMN_TITLE,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_PRICE
    ];

    protected array $allowedFilters = [
        self::COLUMN_AUTHOR_ID => Where::class,
        self::COLUMN_PRICE => WhereMaxMin::class,
        self::COLUMN_TITLE => Like::class
    ];

    protected $casts = [
        self::UPDATED_AT => 'datetime:Y-m-d H:i:s',
        self::CREATED_AT => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(Author::class, Author::COLUMN_ID, self::COLUMN_AUTHOR_ID);
    }
}
