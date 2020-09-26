<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'description',
        'price',
        'code',
        'sale_price',
        'image',
        'available'
    ];

    /**
     * Get price with money format.
     *
     * @return string
     */
    public function getPriceFormattedAttribute()
    {
        return 'R$ ' . number_format($this->price, 2, ',', '.');
    }

    /**
     * Get sale price with money format.
     * @return string
     */
    public function getSalePriceFormattedAttribute()
    {
        return 'R$ ' . number_format($this->sale_price, 2, ',', '.');
    }

    /**
     * Get available formatted.
     * @return string
     */
    public function getAvailableFormattedAttribute()
    {
        return $this->available ? 'Yes' : 'No';
    }
}
