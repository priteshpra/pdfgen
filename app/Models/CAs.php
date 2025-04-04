<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class CAs extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "company";
    protected $primaryKey = 'CompanyID';
    protected $fillable = [
        'Address',
        'ClientCode',
        'CountryID',
        'StateID',
        'CityID',
        'PinCode',
        'AadharNumber',
        'GSTNumber',
        'PANNumber',
        'FirmType',
        'FirmName',
        'BusinnessCatID',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    // static function boot()
    // {
    //     parent::boot();

    //     static::created(function (Model $model) {
    //         if ($model->role_id == "") {
    //             $model->update([
    //                 'role_id' => Role::where('title', 'user')->first()->id,
    //             ]);
    //         }
    //     });
    // }
}
