<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\RecipeComment;
use App\Repository\RecipeCommentRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<RecipeComment>
 *
 * @method        RecipeComment|Proxy create(array|callable $attributes = [])
 * @method static RecipeComment|Proxy createOne(array $attributes = [])
 * @method static RecipeComment|Proxy find(object|array|mixed $criteria)
 * @method static RecipeComment|Proxy findOrCreate(array $attributes)
 * @method static RecipeComment|Proxy first(string $sortedField = 'id')
 * @method static RecipeComment|Proxy last(string $sortedField = 'id')
 * @method static RecipeComment|Proxy random(array $attributes = [])
 * @method static RecipeComment|Proxy randomOrCreate(array $attributes = [])
 * @method static RecipeCommentRepository|RepositoryProxy repository()
 * @method static RecipeComment[]|Proxy[] all()
 * @method static RecipeComment[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static RecipeComment[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static RecipeComment[]|Proxy[] findBy(array $attributes)
 * @method static RecipeComment[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RecipeComment[]|Proxy[] randomSet(int $number, array $attributes = [])
 *
 * @phpstan-method        Proxy<RecipeComment> create(array|callable $attributes = [])
 * @phpstan-method static Proxy<RecipeComment> createOne(array $attributes = [])
 * @phpstan-method static Proxy<RecipeComment> find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<RecipeComment> findOrCreate(array $attributes)
 * @phpstan-method static Proxy<RecipeComment> first(string $sortedField = 'id')
 * @phpstan-method static Proxy<RecipeComment> last(string $sortedField = 'id')
 * @phpstan-method static Proxy<RecipeComment> random(array $attributes = [])
 * @phpstan-method static Proxy<RecipeComment> randomOrCreate(array $attributes = [])
 * @phpstan-method static RepositoryProxy<RecipeComment> repository()
 * @phpstan-method static list<Proxy<RecipeComment>> all()
 * @phpstan-method static list<Proxy<RecipeComment>> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<RecipeComment>> createSequence(iterable|callable $sequence)
 * @phpstan-method static list<Proxy<RecipeComment>> findBy(array $attributes)
 * @phpstan-method static list<Proxy<RecipeComment>> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<RecipeComment>> randomSet(int $number, array $attributes = [])
 */
final class RecipeCommentFactory extends ModelFactory
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
        return RecipeComment::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'comment' => self::faker()->text(1000),
            'createdAt' => self::faker()->dateTime(),
            'recipe' => RecipeFactory::new(),
            'status' => self::faker()->text(20),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this;
            // ->afterInstantiate(function(RecipeComment $recipeComment): void {})
    }
}
