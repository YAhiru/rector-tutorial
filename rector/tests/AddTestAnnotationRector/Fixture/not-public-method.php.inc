<?php
namespace Yahiru\RectorTutorialRector\AddTestAnnotationRector\Fixture;

class NotPublicMethodTest extends \PHPUnit\Framework\TestCase
{
    protected function testProtected() : void
    {
    }

    private function testPrivate() : void
    {
    }
}
