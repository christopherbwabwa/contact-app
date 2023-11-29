<?php

namespace App\Models;

use App\Scopes\ContactFilterScope;
use App\Scopes\ContactSearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $filterColumns = ['company_id'];
    
    public function company()
    {
        return $this->belongsTo(Company::class)->withoutGlobalScopes();
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public static function booted()
    {
        static::addGlobalScope(new ContactFilterScope);
        static::addGlobalScope(new ContactSearchScope);

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
