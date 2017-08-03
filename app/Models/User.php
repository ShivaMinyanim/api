<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * A user can attend many minyanim.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function minyanim()
    {
        return $this->belongsToMany(Minyan::class, 'minyan_user');
    }

    /**
     * Set the user as attending a minyan.
     *
     * @param  Minyan|int    $minyan
     * @return void
     */
    public function attend($minyan)
    {
        $this->minyanim()->attach($minyan);
    }

    /**
     * Cancel a user's attendance at a minyan.
     *
     * @param  Minyan $minyan
     * @return void
     */
    public function cancelAttendanceAt(Minyan $minyan)
    {
        $this->minyanim()->detach($minyan);
    }
}
