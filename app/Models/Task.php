<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string text
 * @property boolean status
 * @property boolean is_changed
 * @property int user_id
 * @property int created_at
 * @property int updated_at
 */
class Task extends Model
{
    use HasFactory;

    public const DEFAULT_PAGE = 1;
    public const LIST_LIMIT = 3;

    protected $fillable = [
        'status',
        'text',
        'user_id',
        'is_changed',
        'user_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
