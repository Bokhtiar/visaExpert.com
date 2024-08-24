<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get modules with permissions
     */
    public static function getWithPermissions(): Collection|array
    {
        return self::with('permissions')->get();
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
