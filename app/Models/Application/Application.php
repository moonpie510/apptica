<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    public const string TABLE_NAME = 'applications';
    protected $table = self::TABLE_NAME;

    protected $guarded = ['created_at', 'updated_at'];

    public function topHistories(): HasMany
    {
        return $this->hasMany(ApplicationTopHistory::class);
    }
}
