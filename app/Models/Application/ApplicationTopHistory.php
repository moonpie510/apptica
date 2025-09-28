<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;

class ApplicationTopHistory extends Model
{
    public const string TABLE_NAME = 'application_top_histories';
    protected $table = self::TABLE_NAME;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
