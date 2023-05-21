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
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            denormalizationContext: [
                'groups' => ['Country:write'],
            ],
        ),
        new Patch(
            denormalizationContext: [
                'groups' => ['Country:update'],
            ],
        ),
        new Delete(),
    ],
    normalizationContext: [
        'groups' => ['Country:read'],
    ],
)]
#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 2, nullable: false)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 2)]
    #[ApiProperty(identifier: true)]
    private ?string $countryCode = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    #[Assert\Length(max: 255)]
    private ?string $countryName = null;

    #[ORM\ManyToOne(inversedBy: 'countries')]
    #[ORM\JoinColumn(name: 'region_code', referencedColumnName: 'region_code', nullable: false)]
    private ?GeoRegion $region = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $sortOrder = null;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCountry($this);
        }

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function getRegion(): ?GeoRegion
    {
        return $this->region;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCountry() === $this) {
                $user->setCountry(null);
            }
        }

        return $this;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function setRegion(?GeoRegion $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
