<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sales
 * @package App\Models
 */
class Sales extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'amount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale');
    }
}
