<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariationAttributes extends Model {

    public $fillable = ['variation_id', 'attribute_id', 'value'];

    public function variation() {
        return $this->belongsTo(Variation::class);
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

}
