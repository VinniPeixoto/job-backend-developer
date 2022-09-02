<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function PHPUnit\Framework\isNull;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'image_url',
    ];

    public function scopeFilterNameOrCategory(Builder $builder, $name)
    {
        return $builder->when($name, function (Builder $builder, $name) {
            return $builder->where('name', 'like', "%{$name}%")
                ->orWhere('category', 'like', "%{$name}%");
        });
    }
    public function scopeFilterOnlyCategory(Builder $builder, $name)
    {
        return $builder->when($name, function (Builder $builder, $name) {
            return $builder->where('category', $name);
        });
    }
    public function scopeFilterImage(Builder $builder, $name)
    {
        if (!is_null($name)) {
            return $builder->when($name, function (Builder $builder) {
                return $builder->whereNotNull('image_url');
            }, function (Builder $builder) {
                return $builder->whereNull('image_url');
            });
        }
    }
}
