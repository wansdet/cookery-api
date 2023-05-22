<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Country;
use App\Entity\GeoRegion;
use App\Entity\Recipe;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class GeoRegionUnitTest extends TestCase
{
    private GeoRegion $geoRegion;

    protected function setUp(): void
    {
        $this->geoRegion = new GeoRegion();
    }

    public function testAddRemoveCountry(): void
    {
        $country = new Country();
        $this->geoRegion->addCountry($country);

        $this->assertInstanceOf(ArrayCollection::class, $this->geoRegion->getCountries());
        $this->assertTrue($this->geoRegion->getCountries()->contains($country));

        $this->geoRegion->removeCountry($country);
        $this->assertFalse($this->geoRegion->getCountries()->contains($country));
    }

    public function testAddRemoveRecipe(): void
    {
        $recipe = new Recipe();
        $this->geoRegion->addRecipe($recipe);

        $this->assertInstanceOf(ArrayCollection::class, $this->geoRegion->getRecipes());
        $this->assertTrue($this->geoRegion->getRecipes()->contains($recipe));

        $this->geoRegion->removeRecipe($recipe);
        $this->assertFalse($this->geoRegion->getRecipes()->contains($recipe));
    }

    public function testGetRegionCode(): void
    {
        $regionCode = 'AFRICA';
        $this->geoRegion->setRegionCode($regionCode);
        $this->assertEquals($regionCode, $this->geoRegion->getRegionCode());
    }

    public function testGetRegionName(): void
    {
        $regionName = 'Europe';
        $this->geoRegion->setRegionName($regionName);
        $this->assertEquals($regionName, $this->geoRegion->getRegionName());
    }

    public function testGetSortOrder(): void
    {
        $sortOrder = 10;
        $this->geoRegion->setSortOrder($sortOrder);
        $this->assertEquals($sortOrder, $this->geoRegion->getSortOrder());
    }
}
