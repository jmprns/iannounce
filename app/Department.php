<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $fillable = ['dept_name', 'lvl'];

	public function year()
	{
		return $this->hasMany('App\Year', 'dept_id');
	}
}
