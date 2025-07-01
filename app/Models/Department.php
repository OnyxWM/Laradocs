<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Department extends Model
{
    protected $fillable = ['name', 'slug'];

    public static function booted(): void
    {
        static::creating(function (Department $department) {
            $department->slug = Str::slug($department->name);
        });
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }
}
