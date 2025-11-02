<?php

namespace App\Domain\Network\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Router extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'network_routers';

    protected $fillable = [
        'name',
        'slug',
        'host',
        'api_port',
        'username',
        'password',
        'connection_type',
        'use_ssl',
        'status',
        'last_synced_at',
        'created_by',
        'meta',
    ];

    protected $casts = [
        'use_ssl' => 'boolean',
        'meta' => 'array',
        'last_synced_at' => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decryptString($value) : null,
            set: fn (?string $value) => $value ? Crypt::encryptString($value) : null,
        );
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
