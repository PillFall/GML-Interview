<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Events\UserCreated;
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
        'category_id',
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
        'country_display',
        'identifier_display',
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
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    /**
     * Get the identifier attribute.
     */
    public function identifierDisplay(): Attribute
    {
        return Attribute::make(
            get: function () {
                return 'CC ' . $this['identifier'];
            },
        );
    }

    /**
     * Get the country attribute.
     */
    public function countryDisplay(): Attribute
    {
        return Attribute::make(
            get: function () {
                $code = $this['country'];

                $country = Cache::remember($code, 7200, function () use ($code) {
                    return Http::acceptJson()
                        ->get("https://restcountries.com/v3.1/alpha/{$code}?fields=translations")
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
