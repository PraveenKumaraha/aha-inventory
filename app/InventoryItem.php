<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_name', 'product_category_id', ''
    ];  

    public function categories()
    {
        return $this->belongsTo('App\Category', 'product_category_id')->withTrashed();
    }


}
