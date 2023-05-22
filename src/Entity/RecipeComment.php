<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\RecipeCommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            denormalizationContext: [
                'groups' => ['RecipeComment:write'],
            ],
            security: 'is_granted("ROLE_USER")',
        ),
        new Patch(
            denormalizationContext: [
                'groups' => ['RecipeComment:update'],
            ],
            security: 'is_granted("ROLE_MODERATOR")',
        ),
        new Delete(
            security: 'is_granted("ROLE_MODERATOR")',
        ),
    ],
    denormalizationContext: [
        'groups' => ['RecipeComment:write'],
    ],
)]
#[ORM\Entity(repositoryClass: RecipeCommentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class RecipeComment
{
    use TimestampsTrait;

    public const RECIPE_COMMENT_STATUS_ON_HOLD = 'on_hold';

    public const RECIPE_COMMENT_STATUS_PENDING = 'pending';

    public const RECIPE_COMMENT_STATUS_PUBLISHED = 'published';

    public const RECIPE_COMMENT_STATUS_SUSPENDED = 'suspended';

    public const RECIPE_COMMENT_STATUSES = [
        self::RECIPE_COMMENT_STATUS_PENDING,
        self::RECIPE_COMMENT_STATUS_PUBLISHED,
        self::RECIPE_COMMENT_STATUS_ON_HOLD,
        self::RECIPE_COMMENT_STATUS_SUSPENDED,
    ];

    #[ORM\Column(length: 1000)]
    #[Assert\Length(min: 3, max: 1000)]
    private ?string $comment = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2, nullable: true)]
    #[Assert\Range(min: 0, max: 10)]
    private ?string $rating = null;

    #[ORM\ManyToOne(inversedBy: 'recipeComments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recipe $recipe = null;

    #[ORM\Column(length: 20)]
    #[Assert\Choice(choices: self::RECIPE_COMMENT_STATUSES)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'recipeComments')]
    private User $user;

    public function __construct()
    {
        $this->status = self::RECIPE_COMMENT_STATUS_PENDING;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function setRating(?string $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
