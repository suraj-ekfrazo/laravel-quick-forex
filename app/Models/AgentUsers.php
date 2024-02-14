<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class AgentUsers extends Authenticatable
{
	use  Notifiable;
    protected $guarded = ['id'];
    public $table = 'agent_users';

    protected $hidden = [
        'password',
    ];

    /*public function getAuthPassword()
    {
        return $this->password;
    }*/

    public $fillable = [  'id', 'first_name', 'last_name', 'email', 'mobile', 'profile_pic', 'password', 'branch_name', 'status', 'created_at', 'updated_at', 'deleted_at'];
}
