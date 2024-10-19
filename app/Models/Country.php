<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Country extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "countries";
    protected $fillable = [
        'Country'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
