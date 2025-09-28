<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public const string TABLE_NAME = 'countries';
    protected $table = self::TABLE_NAME;

    protected $guarded = ['created_at', 'updated_at'];
}
