<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property  string name
 * @property  string email
 * @property string password
 */
class Users extends Authenticatable
{
    use SoftDeletes;
    protected $table = 'users';
    public $timestamps = false;
    public $fillable = ['name','email','password'];
}
