<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    /**
     * @dataProvider negativeDataProvider
     */
    public function testNegative($input)
    {
        $this->expectException(InvalidArgumentException::class);
		
		sayHelloArgumentWrapper($input);
    }
    public function negativeDataProvider()
    {
        return [
            [[1, 2, 3]],
            [NULL],
            [(object)'hello'],
            [function ($name) {
                return strtoupper($name[1]);
            }],
        ];
    }
}