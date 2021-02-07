<?php
use PHPUnit\Framework\TestCase;
use src\oop\Commands\DivCommand;

class DivCommandTest extends TestCase
{
    /**
     * @var DivCommand
     */
    private $command;

    /**
     * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
     *
     * @inheritdoc
     */
    public function setUp(): void
    {
        $this->command = new DivCommand();
    }

    /**
     * @return array
     */
    public function commandPositiveDataProvider()
    {
        return [
            [6, 2, 3],
            [0.9, 3, 0.3],
            [-8, 2, -4],
            ['15', 3, 5],
        ];
    }

    /**
     * @dataProvider commandPositiveDataProvider
     */
    public function testCommandPositive($a, $b, $expected)
    {
        $result = $this->command->execute($a, $b);

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function commandNegativeDataProvider()
    {
        return [
            [2, 0],
            [1],
            [],
        ];
    }

    /**
     * @dataProvider commandNegativeDataProvider
     */
    public function testCommandNegative(...$args)
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->command->execute(...$args);
    }

    /**
     * @see https://phpunit.readthedocs.io/en/9.3/fixtures.html#more-setup-than-teardown
     *
     * @inheritdoc
     */
    public function tearDown(): void
    {
        unset($this->command);
    }
}