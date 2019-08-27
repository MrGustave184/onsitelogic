<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
		protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
     'remember_token',
		];
		
		public function categoria()
		{
			return $this->belongsTo(Categoria::class);
		}
}
