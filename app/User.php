<?php

namespace App;

use App\ModelTrait\ModelHelperTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $display_name
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User autoWithAll()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoTimeScope()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoLimitScope()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoOrderScope()
 * @method static \Illuminate\Database\Query\Builder|\App\User autoEqualFields($fields)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatar($value)
 * @property string $api_token
 * @method static \Illuminate\Database\Query\Builder|\App\User whereApiToken($value)
 * @property integer $avatar_id
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatarId($value)
 * @property-read \App\File $avatar
 */
class User extends Authenticatable
{
    use ModelHelperTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar(){
        return $this->belongsTo('App\File');
    }
    public function displayName(){
        return $this -> name;
    }

    public function getAvatar(){
        return \Image::make($this -> avatar -> downToLocal())->fit(100, 100)->response('jpg');
    }
    public function getAvatarUrl(){
        return route('avatar.get',$this);
    }

}
