<?php

namespace Agenda;

use Illuminate\Database\Eloquent\Model;

class EstatusModel extends Model {

    protected $table = 'prueba_agenda';
    protected $primaryKey = "stsId";

    public $timestamps = false;

    protected $fillable = [
        'stsNombre'
    ];

    protected $guarded = [];

}
