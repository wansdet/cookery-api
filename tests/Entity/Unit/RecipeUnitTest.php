<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\GeoRegion;
use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use App\Entity\RecipeComment;
use App\Entity\RecipeImage;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class RecipeUnitTest extends TestCase
{
    private Recipe $recipe;

    protected function setUp(): void
    {
        $this->recipe = new Recipe();
    }

    public function testGetSetCooking(): void
    {
        $cooking = 'Some cooking instructions';
        $this->recipe->setCooking($cooking);
        $this->assertSame($cooking, $this->recipe->getCooking());
    }

    public function testGetSetCookingTime(): void
    {
        $cookingTime = 60;
        $this->recipe->setCookingTime($cookingTime);
        $this->assertSame($cookingTime, $this->recipe->getCookingTime());
    }

    public function testGetSetDescription(): void
    {
        $description = 'Recipe description';
        $this->recipe->setDescription($description);
        $this->assertSame($description, $this->recipe->getDescription());
    }

    public function testGetSetIngredients(): void
    {
        $ingredients = 'Some ingredients';
        $this->recipe->setIngredients($ingredients);
        $this->assertSame($ingredients, $this->recipe->getIngredients());
    }

    public function testGetSetPreparation(): void
    {
        $preparation = 'Preparation steps';
        $this->recipe->setPreparation($preparation);
        $this->assertSame($preparation, $this->recipe->getPreparation());
    }

    public function testGetSetPreparationTime(): void
    {
        $preparationTime = 30;
        $this->recipe->setPreparationTime($preparationTime);
        $this->assertSame($preparationTime, $this->recipe->getPreparationTime());
    }

    public function testGetSetRecipeId(): void
    {
        $recipeId = Uuid::v4();
        $this->recipe->setRecipeId($recipeId);
        $this->assertSame($recipeId, $this->recipe->getRecipeId());
    }

    public function testGetSetRegion(): void
    {
        $region = new GeoRegion();
        $this->recipe->setRegion($region);
        $this->assertSame($region, $this->recipe->getRegion());
    }

    public function testGetSetServings(): void
    {
        $servings = 4;
        $this->recipe->setServings($servings);
        $this->assertSame($servings, $this->recipe->getServings());
    }

    public function testGetSetStatus(): void
    {
        $status = 'published';
        $this->recipe->setStatus($status);
        $this->assertSame($status, $this->recipe->getStatus());
    }

    public function testGetSetTitle(): void
    {
        $title = 'Recipe title';
        $this->recipe->setTitle($title);
        $this->assertSame($title, $this->recipe->getTitle());
    }

    public function testGetSetUser(): void
    {
        $user = new User();
        $this->recipe->setUser($user);
        $this->assertSame($user, $this->recipe->getUser());
    }

    public function testIsSetVegan(): void
    {
        $vegan = true;
        $this->recipe->setVegan($vegan);
        $this->assertSame($vegan, $this->recipe->isVegan());
    }

    public function testIsSetVegetarian(): void
    {
        $vegetarian = true;
        $this->recipe->setVegetarian($vegetarian);
        $this->assertSame($vegetarian, $this->recipe->isVegetarian());
    }

    public function testGetAddRemoveCategory(): void
    {
        $category1 = new RecipeCategory();
        $category1->setCategoryName('Category 1');
        $category2 = new RecipeCategory();
        $category2->setCategoryName('Category 2');

        $this->recipe->addCategory($category1);
        $this->recipe->addCategory($category2);

        // Convert Doctrine collection to an array
        $categories = $this->recipe->getCategories()->toArray();

        // Get category names from the array
        $categoryNames = $this->getCategoryNames($categories);

        $this->assertSame([$category1, $category2], $this->recipe->getCategories()->toArray());

        $expectedCategories = ['Category 1', 'Category 2'];
        $this->assertSame($expectedCategories, $categoryNames);

        $this->recipe->removeCategory($category1);

        // Update the array after removing a category
        $categories = $this->recipe->getCategories()->toArray();
        $categoryNames = $this->getCategoryNames($categories);

        $expectedCategories = ['Category 2'];
        $this->assertSame($expectedCategories, $categoryNames);
    }

    public function testGetAddRemoveComment(): void
    {
        $comment1 = new RecipeComment();
        $comment1->setComment('Comment 1');
        $comment2 = new RecipeComment();
        $comment2->setComment('Comment 2');

        $this->recipe->addRecipeComment($comment1);
        $this->recipe->addRecipeComment($comment2);

        $this->assertSame([$comment1, $comment2], $this->recipe->getRecipeComments()->toArray());

        $expectedComments = ['Comment 1', 'Comment 2'];
        $this->assertSame($expectedComments, $this->getCommentTexts($this->recipe->getRecipeComments()->toArray()));

        $this->recipe->removeRecipeComment($comment1);

        // Update the array after removing a comment
        $recipeComments = $this->recipe->getRecipeComments()->toArray();
        $commentTexts = $this->getCommentTexts($recipeComments);

        $expectedComments = ['Comment 2'];
        $this->assertSame($expectedComments, $commentTexts);
    }

    public function testGetAddRemoveImage(): void
    {
        $image1 = new RecipeImage();
        $image1->setFilename('image1.jpg');
        $image2 = new RecipeImage();
        $image2->setFilename('image2.jpg');

        $this->recipe->addRecipeImage($image1);
        $this->recipe->addRecipeImage($image2);

        $this->assertSame([$image1, $image2], $this->recipe->getRecipeImages()->toArray());

        $expectedImages = ['image1.jpg', 'image2.jpg'];
        $this->assertSame($expectedImages, $this->getImagePaths($this->recipe->getRecipeImages()->toArray()));

        $this->recipe->removeRecipeImage($image1);

        // Update the array after removing an image
        $recipeImages = $this->recipe->getRecipeImages()->toArray();
        $imagePaths = $this->getImagePaths($recipeImages);

        $expectedImages = ['image2.jpg'];
        $this->assertSame($expectedImages, $imagePaths);
    }

    private function getCategoryNames(array $categories): array
    {
        $categoryNames = [];
        foreach ($categories as $category) {
            $categoryNames[] = $category->getCategoryName();
        }

        return $categoryNames;
    }

    private function getCommentTexts(array $comments): array
    {
        $commentTexts = [];
        foreach ($comments as $comment) {
            $commentTexts[] = $comment->getComment();
        }

        return $commentTexts;
    }

    private function getImagePaths(array $images): array
    {
        $imagePaths = [];
        foreach ($images as $image) {
            $imagePaths[] = $image->getFilename();
        }

        return $imagePaths;
    }
}
