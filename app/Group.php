<?php

namespace HomeSecretary;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->using(GroupUser::class);
    }
}
