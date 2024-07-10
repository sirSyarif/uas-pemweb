<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

	public function category()
	{
		return $this->hasOne('App\Models\Category');
	}

	public function tags()
	{
		return $this->BelongsToMany('App\Models\Tag')->withTimestamps();
	}
}
