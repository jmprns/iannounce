<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['lname', 'fname','mname', 'year_id', 'number'];

    public function year()
    {
    	return $this->belongsTo('App\Year', 'year_id');
    }
}
