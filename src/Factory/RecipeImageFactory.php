<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\RecipeImage;
use App\Repository\RecipeImageRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<RecipeImage>
 *
 * @method        RecipeImage|Proxy create(array|callable $attributes = [])
 * @method static RecipeImage|Proxy createOne(array $attributes = [])
 * @method static RecipeImage|Proxy find(object|array|mixed $criteria)
 * @method static RecipeImage|Proxy findOrCreate(array $attributes)
 * @method static RecipeImage|Proxy first(string $sortedField = 'id')
 * @method static RecipeImage|Proxy last(string $sortedField = 'id')
 * @method static RecipeImage|Proxy random(array $attributes = [])
 * @method static RecipeImage|Proxy randomOrCreate(array $attributes = [])
 * @method static RecipeImageRepository|RepositoryProxy repository()
 * @method static RecipeImage[]|Proxy[] all()
 * @method static RecipeImage[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static RecipeImage[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static RecipeImage[]|Proxy[] findBy(array $attributes)
 * @method static RecipeImage[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RecipeImage[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<RecipeImage> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<RecipeImage> createOne(array $attributes = [])
 * @phpstan-method static Proxy<RecipeImage> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<RecipeImage> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<RecipeImage> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<RecipeImage> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<RecipeImage> random(array $attributes = [])
 * @phpstan-method static Proxy<RecipeImage> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<RecipeImage> repository()
 * @phpstan-method static list<Proxy<RecipeImage>> all()
 * @phpstan-method static list<Proxy<RecipeImage>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<RecipeImage>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<RecipeImage>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<RecipeImage>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<RecipeImage>> randomSet(int $number, array $attributes = [])
 */
final class RecipeImageFactory extends ModelFactory
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
        return RecipeImage::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'createdAt' => self::faker()->dateTime(),
            'recipe' => RecipeFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this;
            // ->afterInstantiate(function(RecipeImage $recipeImage): void {})
    }
}
