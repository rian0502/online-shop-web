<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagesProduct extends Model
{
    use HasFactory;
    protected $table = 'images_product';
    public $incrementing = false;
    protected $fillable = [
        'url',
        'product_id',
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
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
