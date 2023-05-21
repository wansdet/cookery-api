<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\RecipeImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            denormalizationContext: [
                'groups' => ['RecipeImage:write'],
            ],
        ),
        new Patch(
            denormalizationContext: [
                'groups' => ['RecipeImage:update'],
            ],
        ),
        new Delete(),
    ],
    denormalizationContext: [
        'groups' => ['RecipeImage:write'],
    ],
)]
#[ORM\Entity(repositoryClass: RecipeImageRepository::class)]
#[ORM\HasLifecycleCallbacks]
class RecipeImage
{
    use TimestampsTrait;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 3, max: 255)]
    private ?string $filename = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recipeImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(min: 3, max: 50)]
    private ?string $title = null;

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
