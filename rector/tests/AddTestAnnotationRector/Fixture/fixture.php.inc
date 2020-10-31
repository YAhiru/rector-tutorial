<?php
namespace Yahiru\RectorTutorialRector\AddTestAnnotationRector\Fixture;

class SomeTest extends \PHPUnit\Framework\TestCase
{
    public function testSome() : void
    {
        // do test
    }
}

?>
-----
<?php
namespace Yahiru\RectorTutorialRector\AddTestAnnotationRector\Fixture;

class SomeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function some() : void
    {
        // do test
    }
}

?>
