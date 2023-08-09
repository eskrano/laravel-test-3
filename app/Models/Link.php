<?php declare(strict_types=1);

namespace App\Models;

use App\Services\Link\Contracts\LinkContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Link extends Model implements LinkContract
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'url',
        'code',
        'lifetime',
        'click_limit',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'lifetime' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clicks(): HasMany
    {
        return $this->hasMany(Click::class);
    }

    /**
     * @return int|string
     */
    public function getId(): int | string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->url;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getLifetime(): \DateTimeInterface
    {
        return $this->lifetime;
    }

    /**
     * @return int
     */
    public function getClickLimit(): int
    {
        return $this->click_limit;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->created_at;
    }
}
