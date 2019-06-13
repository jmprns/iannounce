<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    protected $fillable = ['title', 'message', 'receiver', 'type', 'status', 'sender'];
}
