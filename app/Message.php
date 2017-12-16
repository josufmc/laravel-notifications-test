<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];    // No se puede asignar masivamente el id

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }
}
