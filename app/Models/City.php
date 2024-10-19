<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class City extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "cities";
    protected $fillable = [
        'City',
        'CountryID',
        'StateID',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    static function boot()
    {
        parent::boot();

        static::created(function (Model $model) {
            if ($model->role_id == "") {
                $model->update([
                    'role_id' => Role::where('title', 'user')->first()->id,
                ]);
            }
        });
    }
}
