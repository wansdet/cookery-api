<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\Recipe;
use App\Entity\RecipeComment;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class RecipeCommentUnitTest extends TestCase
{
    private RecipeComment $recipeComment;

    protected function setUp(): void
    {
        $this->recipeComment = new RecipeComment();
    }

    public function testGetSetComment(): void
    {
        $comment = 'This is a comment';
        $this->recipeComment->setComment($comment);
        $this->assertSame($comment, $this->recipeComment->getComment());
    }

    public function testGetSetRating(): void
    {
        $rating = '4.5';
        $this->recipeComment->setRating($rating);
        $this->assertSame($rating, $this->recipeComment->getRating());
    }

    public function testGetSetRecipe(): void
    {
        $recipe = new Recipe();
        $this->recipeComment->setRecipe($recipe);
        $this->assertSame($recipe, $this->recipeComment->getRecipe());
    }

    public function testGetSetStatus(): void
    {
        $status = 'published';
        $this->recipeComment->setStatus($status);
        $this->assertSame($status, $this->recipeComment->getStatus());
    }

    public function testGetSetUser(): void
    {
        $user = new User();
        $this->recipeComment->setUser($user);
        $this->assertSame($user, $this->recipeComment->getUser());
    }
}
