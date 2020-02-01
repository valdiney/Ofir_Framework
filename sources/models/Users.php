<?php
use \Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    public function test() 
    {
        return "It's work!";
    }
}
