<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            denormalizationContext: [
                'groups' => ['Recipe:write'],
            ],
        ),
        new Patch(
            denormalizationContext: [
                'groups' => ['Recipe:update'],
            ],
        ),
        new Delete(),
    ],
    normalizationContext: [
        'groups' => ['Recipe:read'],
    ],
)]
#[ORM\Entity(repositoryClass: RecipeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Recipe
{
    use TimestampsTrait;

    public const RECIPE_STATUS_ARCHIVED = 'archived';

    public const RECIPE_STATUS_DRAFT = 'draft';

    public const RECIPE_STATUS_ON_HOLD = 'on_hold';

    public const RECIPE_STATUS_PUBLISHED = 'published';

    public const RECIPE_STATUS_REJECTED = 'rejected';

    public const RECIPE_STATUS_SUBMITTED = 'submitted';

    public const RECIPE_STATUS_SUSPENDED = 'suspended';

    public const RECIPE_STATUSES = [
        self::RECIPE_STATUS_ARCHIVED,
        self::RECIPE_STATUS_DRAFT,
        self::RECIPE_STATUS_ON_HOLD,
        self::RECIPE_STATUS_PUBLISHED,
        self::RECIPE_STATUS_REJECTED,
        self::RECIPE_STATUS_SUBMITTED,
        self::RECIPE_STATUS_SUSPENDED,
    ];

    #[ORM\ManyToMany(targetEntity: RecipeCategory::class, inversedBy: 'recipes')]
    #[ORM\JoinTable(
        name: 'recipe_recipe_category',
        joinColumns: [new ORM\JoinColumn(name: 'recipe_id', referencedColumnName: 'id')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'category_code', referencedColumnName: 'category_code')]
    )]
    private Collection $categories;

    #[ORM\Column(length: 4000, nullable: true)]
    #[Assert\Length(min: 3, max: 4000)]
    private ?string $cooking = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Assert\Positive]
    #[Assert\LessThanOrEqual(1440)]
    private ?int $cookingTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $description = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    #[Assert\Length(min: 3, max: 1000)]
    private ?string $ingredients = null;

    #[ORM\Column(length: 4000, nullable: true)]
    #[Assert\Length(min: 3, max: 4000)]
    private ?string $preparation = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Assert\Positive]
    #[Assert\LessThanOrEqual(1440)]
    private ?int $preparationTime = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecipeComment::class)]
    private Collection $recipeComments;

    #[ORM\Column(type: 'uuid', unique: true)]
    #[ApiProperty(identifier: true)]
    private ?Uuid $recipeId = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecipeImage::class)]
    private Collection $recipeImages;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(name: 'region_code', referencedColumnName: 'region_code', nullable: true)]
    private ?GeoRegion $region = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Assert\Positive]
    #[Assert\LessThanOrEqual(100)]
    private ?int $servings = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(choices: self::RECIPE_STATUSES)]
    private ?string $status = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 3, max: 50)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?bool $vegan = null;

    #[ORM\Column(nullable: true)]
    private ?bool $vegetarian = null;

    public function __construct()
    {
        $this->recipeId = Uuid::v4();
        $this->status = self::RECIPE_STATUS_DRAFT;

        $this->recipeImages = new ArrayCollection();
        $this->recipeComments = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function addCategory(RecipeCategory $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function addRecipeComment(RecipeComment $recipeComment): self
    {
        if (!$this->recipeComments->contains($recipeComment)) {
            $this->recipeComments->add($recipeComment);
            $recipeComment->setRecipe($this);
        }

        return $this;
    }

    public function addRecipeImage(RecipeImage $recipeImage): self
    {
        if (!$this->recipeImages->contains($recipeImage)) {
            $this->recipeImages->add($recipeImage);
            $recipeImage->setRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, RecipeCategory>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function getCooking(): ?string
    {
        return $this->cooking;
    }

    public function getCookingTime(): ?int
    {
        return $this->cookingTime;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    /**
     * @return Collection<int, RecipeComment>
     */
    public function getRecipeComments(): Collection
    {
        return $this->recipeComments;
    }

    public function getRecipeId(): ?Uuid
    {
        return $this->recipeId;
    }

    /**
     * @return Collection<int, RecipeImage>
     */
    public function getRecipeImages(): Collection
    {
        return $this->recipeImages;
    }

    public function getRegion(): ?GeoRegion
    {
        return $this->region;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function isVegan(): ?bool
    {
        return $this->vegan;
    }

    public function isVegetarian(): ?bool
    {
        return $this->vegetarian;
    }

    public function removeCategory(RecipeCategory $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function removeRecipeComment(RecipeComment $recipeComment): self
    {
        if ($this->recipeComments->removeElement($recipeComment)) {
            // set the owning side to null (unless already changed)
            if ($recipeComment->getRecipe() === $this) {
                $recipeComment->setRecipe(null);
            }
        }

        return $this;
    }

    public function removeRecipeImage(RecipeImage $recipeImage): self
    {
        if ($this->recipeImages->removeElement($recipeImage)) {
            // set the owning side to null (unless already changed)
            if ($recipeImage->getRecipe() === $this) {
                $recipeImage->setRecipe(null);
            }
        }

        return $this;
    }

    public function setCooking(?string $cooking): self
    {
        $this->cooking = $cooking;

        return $this;
    }

    public function setCookingTime(?int $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function setPreparation(?string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function setPreparationTime(?int $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function setRecipeId(Uuid $recipeId): self
    {
        $this->recipeId = $recipeId;

        return $this;
    }

    public function setRegion(?GeoRegion $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function setServings(?int $servings): self
    {
        $this->servings = $servings;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setVegan(?bool $vegan): self
    {
        $this->vegan = $vegan;

        return $this;
    }

    public function setVegetarian(?bool $vegetarian): self
    {
        $this->vegetarian = $vegetarian;

        return $this;
    }
}
