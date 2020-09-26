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
        'amount',
        'profit'
    ];

    /**
     * Get price with money format.
     *
     * @return string
     */
    public function getAmountFormattedAttribute()
    {
        return 'R$ ' . number_format($this->amount, 2, ',', '.');
    }

    /**
     * Get sale price with money format.
     * @return string
     */
    public function getProfitFormattedAttribute()
    {
        return 'R$ ' . number_format($this->profit, 2, ',', '.');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale');
    }
}
