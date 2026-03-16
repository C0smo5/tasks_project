<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends model
{
    protected $fillable = [
        'room_id',
        'by_make',
        'who_does',
        'name',
        'type',
        'priority',
        'stats',
        'descri_task',
        'date_expiration'
    ];
}
