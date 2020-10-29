<?php
declare(strict_types=1);
namespace Yahiru\RectorTutorial;

final class User
{
    /** @var string */
    private $screenName;
    /** @var int */
    private $age;

    public function __construct(string $screenName, int $age)
    {
        $this->screenName = $screenName;
        $this->age = $age;
    }

    public function getScreenName() : string
    {
        return $this->screenName;
    }

    public function getAge() : int
    {
        return $this->age;
    }
}
