<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $fillable = ['name', 'email', 'mobile', 'body', 'answer'];

    public function getRouteKeyName()
    {
        return 'id';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
