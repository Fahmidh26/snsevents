<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavbarItem extends Model
{
    protected $fillable = ['label', 'type', 'route_name', 'url', 'order', 'parent_id', 'is_active'];

    public function parent()
    {
        return $this->belongsTo(NavbarItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavbarItem::class, 'parent_id')->orderBy('order');
    }
}
