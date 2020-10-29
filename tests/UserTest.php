<?php
declare(strict_types=1);
namespace Yahiru\RectorTutorial;

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    private User $user;

    protected function setUp() : void
    {
        parent::setUp();
        $this->user = new User('test user', 20);
    }

    public function testGetScreenName() : void
    {
        $this->assertSame('test user', $this->user->getScreenName());
    }

    public function testGetAge() : void
    {
        $this->assertSame(20, $this->user->getAge());
    }
}
