<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TodoItem extends Model
{
    public function toggle()
	{
		if ($this->complated_at) return $this->complated_at = null;
		return $this->complated_at = Carbon::now();
	}
}
