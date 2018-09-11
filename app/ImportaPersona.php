<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ImportaPersona extends Model
{

    /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'guayaco';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'corredor';
    



}
