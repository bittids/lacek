<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // start table relationships methods
                
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

       
    public function more_user_info()
    {
        return $this->hasOne('App\Models\More_user_info')->withDefault();
    }

             
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

// end table relaitons methods

// start unclassified methods


    public function coll_get_user_wmui()
    {
//dd("user model, coll_get_user_wtih_mui reached, line 132");
        $auth_user_id = Auth::user()->id;

        // get  the poulated object if it exists
        return User::find($auth_user_id);
       // date-230626 this->find was producing all rows in the user table,
       // so I used User::find
        //$this
                 //  ->with ('more_user_info.content_provider')
                 //  ->find($auth_user_id)
                 //  ->first();
   
  
    }
}
