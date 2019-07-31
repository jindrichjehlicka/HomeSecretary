<?php

namespace HomeSecretary;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function taskList()
    {
        return $this->hasMany(TaskList::class);
    }

    public function getProgressAttribute()
    {
        $tasks = $this->taskList()->get();

        $completed = $tasks->where('completed', 1)->count();

        return round($tasks->count() > 0 ? $completed / $tasks->count() * 100 : 0,2);
    }

}
