<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\RecipeImage;
use App\Entity\Recipe;
use PHPUnit\Framework\TestCase;

class RecipeImageUnitTest extends TestCase
{
    private RecipeImage $recipeImage;

    protected function setUp(): void
    {
        $this->recipeImage = new RecipeImage();
    }

    public function testGetSetFilename(): void
    {
        $filename = 'image.jpg';
        $this->recipeImage->setFilename($filename);
        $this->assertSame($filename, $this->recipeImage->getFilename());
    }

    public function testGetSetRecipe(): void
    {
        $recipe = new Recipe();
        $this->recipeImage->setRecipe($recipe);
        $this->assertSame($recipe, $this->recipeImage->getRecipe());
    }

    public function testGetSetTitle(): void
    {
        $title = 'Image Title';
        $this->recipeImage->setTitle($title);
        $this->assertSame($title, $this->recipeImage->getTitle());
    }
}
