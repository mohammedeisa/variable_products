<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public $fillable = ['name'];

    public function attributes() {
        return $this->hasMany(Attribute::class, 'category_id');
    }

}
