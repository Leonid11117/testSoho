<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string biography
 */
class Author extends Model
{
    use HasFactory;
    use AsSource;

    public const TABLE_NAME = 'authors',
        COLUMN_ID = 'id',
        COLUMN_NAME = 'name',
        COLUMN_BIOGRAPHY = 'biography';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_BIOGRAPHY
    ];

    protected $casts = [
        self::UPDATED_AT => 'datetime:Y-m-d H:i:s',
        self::CREATED_AT => 'datetime:Y-m-d H:i:s',
    ];
}
