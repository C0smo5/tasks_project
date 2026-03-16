<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomRequest extends Model
{
    protected $table = 'room_request';

    protected $fillable =[
        'room_id',
        'user_id',
        'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
