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
use App\Repository\GeoRegionRepository;
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
                'groups' => ['GeoRegion:write'],
            ],
        ),
        new Patch(
            denormalizationContext: [
                'groups' => ['GeoRegion:update'],
            ],
        ),
        new Delete(),
    ],
    normalizationContext: [
        'groups' => ['GeoRegion:read'],
    ],
)]
#[ORM\Entity(repositoryClass: GeoRegionRepository::class)]
class GeoRegion
{
    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Country::class)]
    private Collection $countries;

    #[ORM\OneToMany(mappedBy: 'region', targetEntity: Recipe::class)]
    private Collection $recipes;

    #[ORM\Id]
    #[ORM\Column(name: 'region_code', type: 'string', length: 20, nullable: false)]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[Assert\NotNull]
    #[Assert\Length(min: 2, max: 20)]
    #[ApiProperty(identifier: true)]
    private ?string $regionCode = null;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotNull]
    #[Assert\Length(max: 20)]
    private ?string $regionName = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $sortOrder = null;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->countries = new ArrayCollection();
    }

    public function addCountry(Country $country): self
    {
        if (!$this->countries->contains($country)) {
            $this->countries->add($country);
            $country->setRegion($this);
        }

        return $this;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes->add($recipe);
            $recipe->setRegion($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Country>
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    /**
     * @return Collection<int, Recipe>
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function getRegionCode(): ?string
    {
        return $this->regionCode;
    }

    public function getRegionName(): ?string
    {
        return $this->regionName;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function removeCountry(Country $country): self
    {
        if ($this->countries->removeElement($country)) {
            // set the owning side to null (unless already changed)
            if ($country->getRegion() === $this) {
                $country->setRegion(null);
            }
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getRegion() === $this) {
                $recipe->setRegion(null);
            }
        }

        return $this;
    }

    public function setRegionCode(string $regionCode): self
    {
        $this->regionCode = $regionCode;

        return $this;
    }

    public function setRegionName(string $regionName): self
    {
        $this->regionName = $regionName;

        return $this;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }
}
