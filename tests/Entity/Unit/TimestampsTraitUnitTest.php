<?php

declare(strict_types=1);

namespace App\Tests\Entity\Unit;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class TimestampsTraitUnitTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testGetSetCreatedAt(): void
    {
        $createdAt = new \DateTimeImmutable();
        $this->user->setCreatedAt($createdAt);
        $this->assertSame($createdAt, $this->user->getCreatedAt());
    }

    public function testGetSetUpdatedAt(): void
    {
        $updatedAt = new \DateTimeImmutable();
        $this->user->setUpdatedAt($updatedAt);
        $this->assertSame($updatedAt, $this->user->getUpdatedAt());
    }

    public function testPrePersist(): void
    {
        $this->user->prePersist();
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->user->getCreatedAt());
        $this->assertNull($this->user->getUpdatedAt());
    }

    public function testPreUpdate(): void
    {
        $this->user->preUpdate();
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->user->getUpdatedAt());
    }

    public function testPrePersistPreUpdate(): void
    {
        $this->user->prePersist();
        $createdAt = $this->user->getCreatedAt();
        $this->user->preUpdate();
        $this->assertSame($createdAt, $this->user->getCreatedAt());
    }
}
