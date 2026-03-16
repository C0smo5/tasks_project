<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';

    protected $fillable = [
        'name',
        'id_share',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'room_users');
    }
}
