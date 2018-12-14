<?php

namespace Laravie\Webhook\Signature;

use PHPUnit\Framework\TestCase;
use Laravie\Webhook\Signature\TimeLimit;

class TimeLimitTest extends TestCase
{
    /**
     * @test
     * @dataProvider dataset
     */
    public function it_can_generate_signature($given, $expected)
    {
        $stub = new TimeLimit('secret', 1546300800);

        $this->assertSame("t=1546300800,v1={$expected}", $stub->create($given));
    }

    /**
     * Dataset for it_can_generate_signature.
     *
     * @return array
     */
    public function dataset(): array
    {
        return [
            ['Hello world', '3dfd87de38b82fad20940b4f85d911f54dc3f812c9f1b199924031a45a71484b'],
            ['{"foo":"bar"}', '0b06fc696818b4e3720c01b255411fe74178cfa92961eff7c2ef77b83e5d2cb6'],
        ];
    }
}
