<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mensajes extends Model
{
    protected $table = "mensajes";
    protected $fillable = ['id', 'mensaje', 'emisor', 'receptor'];

    public function emisor()
    {
        return $this->belongsTo('App\User', 'emisor', 'id');
    }

    public function receptor()
    {
        return $this->belongsTo('App\User', 'receptor', 'id');
    }
}
