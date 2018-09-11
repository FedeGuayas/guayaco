<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    protected $table='results';
    public $timestamps=false;

    protected $fillable=[
         'first_name','second_name','last_name','sex','category','circuit','chip','place','time'
    ];
}
