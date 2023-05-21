<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\GeoRegion;
use App\Repository\GeoRegionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<GeoRegion>
 *
 * @method        GeoRegion|Proxy create(array|callable $attributes = [])
 * @method static GeoRegion|Proxy createOne(array $attributes = [])
 * @method static GeoRegion|Proxy find(object|array|mixed $criteria)
 * @method static GeoRegion|Proxy findOrCreate(array $attributes)
 * @method static GeoRegion|Proxy first(string $sortedField = 'id')
 * @method static GeoRegion|Proxy last(string $sortedField = 'id')
 * @method static GeoRegion|Proxy random(array $attributes = [])
 * @method static GeoRegion|Proxy randomOrCreate(array $attributes = [])
 * @method static GeoRegionRepository|RepositoryProxy repository()
 * @method static GeoRegion[]|Proxy[] all()
 * @method static GeoRegion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static GeoRegion[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static GeoRegion[]|Proxy[] findBy(array $attributes)
 * @method static GeoRegion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static GeoRegion[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<GeoRegion> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<GeoRegion> createOne(array $attributes = [])
 * @phpstan-method static Proxy<GeoRegion> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<GeoRegion> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<GeoRegion> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<GeoRegion> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<GeoRegion> random(array $attributes = [])
 * @phpstan-method static Proxy<GeoRegion> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<GeoRegion> repository()
 * @phpstan-method static list<Proxy<GeoRegion>> all()
 * @phpstan-method static list<Proxy<GeoRegion>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<GeoRegion>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<GeoRegion>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<GeoRegion>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<GeoRegion>> randomSet(int $number, array $attributes = [])
 */
final class GeoRegionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected static function getClass(): string
    {
        return GeoRegion::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'regionCode' => self::faker()->text(20),
            'regionName' => self::faker()->text(20),
            'sortOrder' => self::faker()->numberBetween(1, 10),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this;
            // ->afterInstantiate(function(GeoRegion $geoRegion): void {})
    }
}
