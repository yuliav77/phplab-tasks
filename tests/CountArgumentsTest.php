<?php

use PHPUnit\Framework\TestCase;

class СountArgumentsTest extends TestCase
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
            [[],['argument_count'=> 0, 'argument_values'=>[]]],
            [["something"], ['argument_count'=> 1, 'argument_values'=>["something"]]],
            [["first", "second"], ['argument_count'=> 2, 'argument_values'=>["first", "second"]]],
        ];
    }
}