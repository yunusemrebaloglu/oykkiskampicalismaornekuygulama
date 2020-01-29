<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TodoItem extends Model
{
    public function toggle()
	{
		if ($this->completed_at) return $this->completed_at = null;
		return $this->completed_at = Carbon::now();
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
