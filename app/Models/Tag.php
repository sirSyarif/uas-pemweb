<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

	public function journals()
	{
		return $this->belongsToMany('App\Models\Journal')->withTimestamps();
	}
}
