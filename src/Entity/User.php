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
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            denormalizationContext: [
                'groups' => ['User:write'],
            ],
        ),
        new Patch(
            denormalizationContext: [
                'groups' => ['User:update'],
            ],
        ),
        new Delete(),
    ],
    normalizationContext: [
        'groups' => ['User:read'],
    ],
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampsTrait;

    public const AGE_RANGE_FIFTIES = 'fifties';

    public const AGE_RANGE_FORTIES = 'forties';

    public const AGE_RANGE_NOT_SPECIFIED = 'not_specified';

    public const AGE_RANGE_SEVENTY_PLUS = 'seventy_plus';

    public const AGE_RANGE_SIXTIES = 'sixties';

    public const AGE_RANGE_THIRTIES = 'thirties';

    public const AGE_RANGE_TWENTIES = 'twenties';

    public const AGE_RANGE_UNDER_20 = 'under_20';

    public const AGE_RANGES = [
        self::AGE_RANGE_NOT_SPECIFIED,
        self::AGE_RANGE_UNDER_20,
        self::AGE_RANGE_TWENTIES,
        self::AGE_RANGE_THIRTIES,
        self::AGE_RANGE_FORTIES,
        self::AGE_RANGE_FIFTIES,
        self::AGE_RANGE_SIXTIES,
        self::AGE_RANGE_SEVENTY_PLUS,
    ];

    public const ROLE_ADMIN = 'ROLE_ADMIN';

    public const ROLE_EDITOR = 'ROLE_EDITOR';

    public const ROLE_MODERATOR = 'ROLE_MODERATOR';

    public const ROLE_USER = 'ROLE_USER';

    public const SEX_FEMALE = 'female';

    public const SEX_MALE = 'male';

    public const SEXES = [
        self::SEX_FEMALE,
        self::SEX_MALE,
    ];

    public const USER_ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_EDITOR,
        self::ROLE_MODERATOR,
        self::ROLE_USER,
    ];

    public const USER_STATUS_ACTIVE = 'active';

    public const USER_STATUS_ON_HOLD = 'on_hold';

    public const USER_STATUS_PENDING = 'pending';

    public const USER_STATUS_SUSPENDED = 'suspended';

    public const USER_STATUSES = [
        self::USER_STATUS_ACTIVE,
        self::USER_STATUS_ON_HOLD,
        self::USER_STATUS_PENDING,
        self::USER_STATUS_SUSPENDED,
    ];

    #[ORM\Column(length: 20)]
    #[Assert\Choice(choices: self::AGE_RANGES)]
    private ?string $ageRange = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(name: 'country_code', referencedColumnName: 'country_code', nullable: false)]
    private ?Country $country = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(min: 2, max: 20)]
    private ?string $displayName = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email]
    #[Assert\Length(max: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $firstName = null;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ApiProperty(identifier: false)]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $lastName = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $middleName = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: RecipeComment::class)]
    private Collection $recipeComments;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Recipe::class)]
    private Collection $recipes;

    #[ORM\Column]
    #[Assert\Choice(choices: self::USER_ROLES, multiple: true)]
    private array $roles = [];

    #[ORM\Column(length: 10, nullable: true)]
    #[Assert\Choice(choices: self::SEXES)]
    private ?string $sex = null;

    #[ORM\Column(length: 10)]
    #[Assert\Choice(choices: self::USER_STATUSES)]
    private ?string $status = null;

    #[ORM\Column(type: 'uuid', unique: true)]
    #[ApiProperty(identifier: true)]
    private ?Uuid $userId = null;

    public function __construct()
    {
        $this->userId = Uuid::v4();
        $this->status = self::USER_STATUS_PENDING;

        // On creation guarantee every user at least has ROLE_USER
        $this->roles[] = 'ROLE_USER';

        $this->recipes = new ArrayCollection();
        $this->recipeComments = new ArrayCollection();
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->setUser($this);
        }

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getAgeRange(): ?string
    {
        return $this->ageRange;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRecipeComments(): Collection
    {
        return $this->recipeComments;
    }

    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getUserId(): ?Uuid
    {
        return $this->userId;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getUser() === $this) {
                $recipe->setUser(null);
            }
        }

        return $this;
    }

    public function setAgeRange(string $ageRange): self
    {
        $this->ageRange = $ageRange;

        return $this;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function setDisplayName(?string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function setUserId(Uuid $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
