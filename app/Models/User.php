<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'identifier',
        'country',
        'mobile',
        'address',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'full_name',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category',
    ];

    /**
     * Get the identifier attribute.
     */
    public function identifier(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return 'CC ' . $value;
            },
        );
    }

    /**
     * Get the country attribute.
     */
    public function country(): Attribute
    {
        return Attribute::make(
            get: function ($value) {

                $country = Cache::remember($value, 7200, function () use ($value) {
                    return Http::acceptJson()
                        ->get("https://restcountries.com/v3.1/alpha/{$value}?fields=translations")
                        ->collect()
                        ->get('translations')['spa']['official'];
                });
                return $country;
            },
        );
    }

    /**
     * Get the full name attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return collect([$this['name'], $this['surname']])->join(' ');
            },
        );
    }

    /**
     * Get the category associated with the user.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
