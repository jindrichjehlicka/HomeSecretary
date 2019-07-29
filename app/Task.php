<?php

namespace HomeSecretary;

use Illuminate\Database\Eloquent\Model;
use HomeSecretary\TaskList;

class Task extends Model
{
    public function taskList()
    {
        return $this->hasMany(TaskList::class);
    }
}
