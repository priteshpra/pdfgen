<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Scandocument extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "scanned_documents";
    protected $primaryKey = 'ScanneddocumentID';
    protected $fillable = [
        'Title',
        'BatchNo',
        'CompanyID',
        'UserID',
        'PageCount',
        'DocumentURL',
    ];
}
