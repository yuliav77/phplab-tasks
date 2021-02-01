<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, countArguments(...$input));
    }
    public function positiveDataProvider()
    {
        return [
            [
                [],
                ['argument_count'=> 0, 'argument_values'=>[]]
            ],
            [
                ["one_argument"],
                ['argument_count'=> 1, 'argument_values'=>["one_argument"]]
            ],
            [
                ["first_argument", "second_argument"],
                ['argument_count'=> 2, 'argument_values'=>["first_argument", "second_argument"]]
            ],
            [
                ["first_argument", "second_argument", "third_argument"],
                ['argument_count'=> 3, 'argument_values'=>["first_argument", "second_argument", "third_argument"]]
            ],
        ];
    }
}