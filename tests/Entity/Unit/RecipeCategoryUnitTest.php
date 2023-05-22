<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use PHPUnit\Framework\TestCase;

class RecipeCategoryUnitTest extends TestCase
{
    private RecipeCategory $recipeCategory;
    private Recipe $recipe;

    protected function setUp(): void
    {
        $this->recipeCategory = new RecipeCategory();
        $this->recipe = new Recipe();
    }

    public function testGetSetCategoryCode(): void
    {
        $categoryCode = 'soups';
        $this->recipeCategory->setCategoryCode($categoryCode);

        $this->assertSame($categoryCode, $this->recipeCategory->getCategoryCode());
    }

    public function testGetSetCategoryName(): void
    {
        $categoryName = 'Beverages';
        $this->recipeCategory->setCategoryName($categoryName);

        $this->assertSame($categoryName, $this->recipeCategory->getCategoryName());
    }

    public function testAddRecipe(): void
    {
        $this->recipeCategory->addRecipe($this->recipe);

        $this->assertTrue($this->recipeCategory->getRecipes()->contains($this->recipe));
        $this->assertTrue($this->recipe->getCategories()->contains($this->recipeCategory));
    }

    public function testRemoveRecipe(): void
    {
        $this->recipeCategory->addRecipe($this->recipe);
        $this->recipeCategory->removeRecipe($this->recipe);

        $this->assertFalse($this->recipeCategory->getRecipes()->contains($this->recipe));
        $this->assertFalse($this->recipe->getCategories()->contains($this->recipeCategory));
    }
}