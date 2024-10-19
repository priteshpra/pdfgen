<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Cms extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "cms";
    protected $fillable = [
        'Content',
        'PageID'
    ];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
