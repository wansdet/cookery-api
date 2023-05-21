<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\RecipeCategory;
use App\Repository\RecipeCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<RecipeCategory>
 *
 * @method        RecipeCategory|Proxy create(array|callable $attributes = [])
 * @method static RecipeCategory|Proxy createOne(array $attributes = [])
 * @method static RecipeCategory|Proxy find(object|array|mixed $criteria)
 * @method static RecipeCategory|Proxy findOrCreate(array $attributes)
 * @method static RecipeCategory|Proxy first(string $sortedField = 'id')
 * @method static RecipeCategory|Proxy last(string $sortedField = 'id')
 * @method static RecipeCategory|Proxy random(array $attributes = [])
 * @method static RecipeCategory|Proxy randomOrCreate(array $attributes = [])
 * @method static RecipeCategoryRepository|RepositoryProxy repository()
 * @method static RecipeCategory[]|Proxy[] all()
 * @method static RecipeCategory[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static RecipeCategory[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static RecipeCategory[]|Proxy[] findBy(array $attributes)
 * @method static RecipeCategory[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RecipeCategory[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<RecipeCategory> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<RecipeCategory> createOne(array $attributes = [])
 * @phpstan-method static Proxy<RecipeCategory> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<RecipeCategory> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<RecipeCategory> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<RecipeCategory> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<RecipeCategory> random(array $attributes = [])
 * @phpstan-method static Proxy<RecipeCategory> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<RecipeCategory> repository()
 * @phpstan-method static list<Proxy<RecipeCategory>> all()
 * @phpstan-method static list<Proxy<RecipeCategory>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<RecipeCategory>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<RecipeCategory>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<RecipeCategory>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<RecipeCategory>> randomSet(int $number, array $attributes = [])
 */
final class RecipeCategoryFactory extends ModelFactory
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
        return RecipeCategory::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'categoryName' => self::faker()->text(30),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this;
            // ->afterInstantiate(function(RecipeCategory $recipeCategory): void {})
    }
}
