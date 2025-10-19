<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'subject',
        'message',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(Message::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Message::class, 'admin_id');
    }

}
