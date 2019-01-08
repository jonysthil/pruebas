<?php

namespace autos;

use Illuminate\Database\Eloquent\Model;

class TrainerModel extends Model {
    
    public function getRouteKeyName() {
        return 'slug';
    }

}
