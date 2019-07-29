<?php


namespace HomeSecretary;

use Illuminate\Database\Eloquent\Relations\Pivot;
class GroupUser extends Pivot
{
    protected $table = 'group_user';
}