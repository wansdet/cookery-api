<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Country;
use App\Entity\Recipe;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testGetSetAgeRange(): void
    {
        $ageRange = 'twenties';
        $this->user->setAgeRange($ageRange);
        $this->assertEquals($ageRange, $this->user->getAgeRange());
    }

    public function testGetSetCountry(): void
    {
        $country = new Country();
        $this->user->setCountry($country);
        $this->assertEquals($country, $this->user->getCountry());
    }

    public function testGetSetDisplayName(): void
    {
        $displayName = 'John Doe';
        $this->user->setDisplayName($displayName);
        $this->assertEquals($displayName, $this->user->getDisplayName());
    }

    public function testGetSetEmail(): void
    {
        $email = 'test@example.com';
        $this->user->setEmail($email);
        $this->assertEquals($email, $this->user->getEmail());
    }

    public function testGetSetFirstName(): void
    {
        $firstName = 'John';
        $this->user->setFirstName($firstName);
        $this->assertEquals($firstName, $this->user->getFirstName());
    }

    public function testGetSetLastName(): void
    {
        $lastName = 'Doe';
        $this->user->setLastName($lastName);
        $this->assertEquals($lastName, $this->user->getLastName());
    }

    public function testGetSetMiddleName(): void
    {
        $middleName = 'M.';
        $this->user->setMiddleName($middleName);
        $this->assertEquals($middleName, $this->user->getMiddleName());
    }

    public function testGetSetPassword(): void
    {
        $password = 'password123';
        $this->user->setPassword($password);
        $this->assertEquals($password, $this->user->getPassword());
    }

    public function testGetSetRoles(): void
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        $this->user->setRoles($roles);
        $this->assertEquals($roles, $this->user->getRoles());
    }

    public function testGetSetSex(): void
    {
        $sex = 'male';
        $this->user->setSex($sex);
        $this->assertEquals($sex, $this->user->getSex());
    }

    public function testGetSetStatus(): void
    {
        $status = 'active';
        $this->user->setStatus($status);
        $this->assertEquals($status, $this->user->getStatus());
    }

    public function testAddRemoveRecipe(): void
    {
        $recipe = new Recipe();
        $this->user->addRecipe($recipe);

        $this->assertInstanceOf(ArrayCollection::class, $this->user->getRecipes());
        $this->assertTrue($this->user->getRecipes()->contains($recipe));

        $this->user->removeRecipe($recipe);
        $this->assertFalse($this->user->getRecipes()->contains($recipe));
    }

    public function testGetRecipeComments(): void
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->user->getRecipeComments());
    }
}