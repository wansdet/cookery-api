<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Recipe>
 *
 * @method        Recipe|Proxy create(array|callable $attributes = [])
 * @method static Recipe|Proxy createOne(array $attributes = [])
 * @method static Recipe|Proxy find(object|array|mixed $criteria)
 * @method static Recipe|Proxy findOrCreate(array $attributes)
 * @method static Recipe|Proxy first(string $sortedField = 'id')
 * @method static Recipe|Proxy last(string $sortedField = 'id')
 * @method static Recipe|Proxy random(array $attributes = [])
 * @method static Recipe|Proxy randomOrCreate(array $attributes = [])
 * @method static RecipeRepository|RepositoryProxy repository()
 * @method static Recipe[]|Proxy[] all()
 * @method static Recipe[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Recipe[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Recipe[]|Proxy[] findBy(array $attributes)
 * @method static Recipe[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Recipe[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<Recipe> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Recipe> createOne(array $attributes = [])
 * @phpstan-method static Proxy<Recipe> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Recipe> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Recipe> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Recipe> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Recipe> random(array $attributes = [])
 * @phpstan-method static Proxy<Recipe> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<Recipe> repository()
 * @phpstan-method static list<Proxy<Recipe>> all()
 * @phpstan-method static list<Proxy<Recipe>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Recipe>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<Recipe>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Recipe>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Recipe>> randomSet(int $number, array $attributes = [])
 */
final class RecipeFactory extends ModelFactory
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
        return Recipe::class;
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
            'ingredients' => self::faker()->text(1000),
            'status' => self::faker()->text(20),
            'title' => self::faker()->text(50),
            'user' => UserFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this;
        // ->afterInstantiate(function(Recipe $recipe): void {})
    }
}
