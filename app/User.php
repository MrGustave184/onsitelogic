<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
		];
		
		public function categoria()
		{
			return $this->belongsTo(Categoria::class);
		}
}
