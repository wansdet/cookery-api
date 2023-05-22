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
use App\Repository\RecipeCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            denormalizationContext: [
                'groups' => ['RecipeCategory:write'],
            ],
            security: 'is_granted("ROLE_ADMIN")',
        ),
        new Patch(
            denormalizationContext: [
                'groups' => ['RecipeCategory:update'],
            ],
            security: 'is_granted("ROLE_ADMIN")',
        ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN")',
        ),
    ],
    denormalizationContext: [
        'groups' => ['RecipeCategory:write'],
    ],
)]
#[ORM\Entity(repositoryClass: RecipeCategoryRepository::class)]
class RecipeCategory
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 30, nullable: false)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[Assert\Length(min: 3, max: 30)]
    #[ApiProperty(identifier: true)]
    private ?string $categoryCode = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min: 3, max: 30)]
    private ?string $categoryName = null;

    #[ORM\ManyToMany(targetEntity: Recipe::class, mappedBy: 'categories')]
    private Collection $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->addCategory($this);
        }

        return $this;
    }

    public function getCategoryCode(): ?string
    {
        return $this->categoryCode;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            $recipe->removeCategory($this);
        }

        return $this;
    }

    public function setCategoryCode(string $categoryCode): self
    {
        $this->categoryCode = $categoryCode;

        return $this;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }
}
