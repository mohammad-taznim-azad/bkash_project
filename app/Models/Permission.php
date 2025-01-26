<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permission extends Model
{
    use HasFactory;
    protected $table = "permissions";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function role_permission(): HasMany
    {
        return $this->hasMany(RolePermission::class, 'permission_id', 'id');
    }


}
