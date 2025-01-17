<?php
namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'description', 'birthday', 'exact_birthday', 'link', 'languages', 'avatar_src','email', 'password',
    ];

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

    public function meets()
    {
        return $this->hasMany(Meet::class);
    }

    /**
     * Хобби, принадлежащие пользователю.
    */
    public function hobbies()
    {
        return $this->belongsToMany('App\Hobby_list', 'user_hobby', 'user_id', 'hobby_list_id');
    }

    /**
     * Meet, принадлежащие пользователю.
    */
    public function my_meets()
    {
        return $this->belongsToMany('App\Meet', 'user_meet', 'user_id', 'meet_id');
    }

    /**
     * Clubs, принадлежащие пользователю.
    */
    public function clubs()
    {
        return $this->belongsToMany('App\Club', 'user_club', 'user_id', 'club_id');
    }

    /**
     * Hobby, принадлежащие пользователю.
    */
    public function hobbyes()
    {
        return $this->belongsToMany('App\Hobby_list', 'user_hobby', 'user_id', 'hobby_list_id');
    }
    

}
