<?php

namespace Agenda;

use Illuminate\Database\Eloquent\Model;

class ContactoModel extends Model {

    protected $table = 'contacto';
    protected $primaryKey = "cntId";

    public $timestamps = false;

    protected $fillable = [
        'stsId',
        'cntNombre',
        'cntApellidoPaterno',
        'cntApellidoMaterno',
        'cntFotografia'
    ];

    protected $guarded = [];

}
