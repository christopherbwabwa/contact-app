<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $searchColumns = ['name', 'address', 'website', 'email'];
    
    public static function booted()
    {
        parent::booted();

        static::addGlobalScope(new SearchScope);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class)->withoutGlobalScope(SearchScope::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function userCompanies()
    {
        return self::withoutGlobalScope(SearchScope::class)->where('user_id', auth()->id())->orderBy('name')->pluck('name', 'id')->prepend('All companies', '');
    }

}
