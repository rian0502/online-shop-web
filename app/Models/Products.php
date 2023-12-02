<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'discount',
        'category_id',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(ImagesProduct::class, 'product_id', 'id');
    }
}
