<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Country;
use App\Entity\GeoRegion;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class CountryUnitTest extends TestCase
{
    private Country $country;

    protected function setUp(): void
    {
        $this->country = new Country();
    }

    public function testGetSetCountryCode(): void
    {
        $countryCode = 'GB';
        $this->country->setCountryCode($countryCode);
        $this->assertEquals($countryCode, $this->country->getCountryCode());
    }

    public function testGetSetCountryName(): void
    {
        $countryName = 'United Kingdom';
        $this->country->setCountryName($countryName);
        $this->assertEquals($countryName, $this->country->getCountryName());
    }

    public function testGetSetRegion(): void
    {
        $region = new GeoRegion();
        $this->country->setRegion($region);
        $this->assertEquals($region, $this->country->getRegion());
    }

    public function testGetSetSortOrder(): void
    {
        $sortOrder = 1;
        $this->country->setSortOrder($sortOrder);
        $this->assertEquals($sortOrder, $this->country->getSortOrder());
    }

    public function testAddRemoveUser(): void
    {
        $user = new User();
        $this->country->addUser($user);

        $this->assertInstanceOf(ArrayCollection::class, $this->country->getUsers());
        $this->assertTrue($this->country->getUsers()->contains($user));

        $this->country->removeUser($user);
        $this->assertFalse($this->country->getUsers()->contains($user));
    }

    public function testGetUsers(): void
    {
        $this->assertInstanceOf(Collection::class, $this->country->getUsers());
    }
}