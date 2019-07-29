<?php

namespace HomeSecretary;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function taskList()
    {
        return $this->hasMany(TaskList::class);
    }
}
