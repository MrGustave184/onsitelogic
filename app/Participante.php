<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
		// All dates in the dates array are automatically converted into Carbon instances
		protected $dates = ['fechaNacimiento'];

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
