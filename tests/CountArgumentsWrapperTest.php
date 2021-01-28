<?php

use PHPUnit\Framework\TestCase;

class СountArgumentsWrapperTest extends TestCase
{
    /**
     * @dataProvider negativeDataProvider
     */
    public function testNegative($input)
    {
        $this->expectException(InvalidArgumentException::class);

        countArgumentsWrapper(...$input);
    }
    public function negativeDataProvider()
    {
        return [
            [['str1', 'str2', 3]],
            [['1', true ]],
            [[false, 67]],
        ];
    }
}
