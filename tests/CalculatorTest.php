<?php

declare(strict_types=1);

namespace tests;
use Calculator\Calculator;
use InvalidArgumentException;

/**
 * @property Calculator $calculator
 */
class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        $this->calculator = new Calculator();
    }
    /**
     * @dataProvider additionProvider
     */
    public function testAdd(float $a, float $b, float $expected) {
        $this->assertEquals($expected, $this->calculator->add($a, $b));
    }

    public static function additionProvider(): array {
        return [
            [2, 2, 4],
            [2.5, 3, 5.5],
            [-1, 1, 0],
            [0, 0, 0]
        ];
    }

    /**
     * @dataProvider subtractionProvider
     */
    public function testSubtract(float $a, float $b, float $expected) {
        $this->assertEquals($expected, $this->calculator->subtract($a, $b));
    }

    public static function subtractionProvider(): array {
        return [
            [2, 2, 0],
            [2.5, 3, -0.5],
            [-1, -1, 0],
            [0, 0, 0]
        ];
    }

    /**
     * @dataProvider multiplicationProvider
     */
    public function testMultiply(float $a, float $b, float $expected) {
        $this->assertEquals($expected, $this->calculator->multiply($a, $b));
    }

    public static function multiplicationProvider(): array {
        return [
            [2, 2, 4],
            [2.5, 3, 7.5],
            [-1, -1, 1],
            [0, 5, 0]
        ];
    }

    /**
     * @dataProvider divisionProvider
     */
    public function testDivide(float $a, float $b, float $expected) {
        $this->assertEquals($expected, $this->calculator->divide($a, $b));
    }

    public static function divisionProvider(): array {
        return [
            [2, 2, 1],
            [5, 2, 2.5],
            [-4, -2, 2],
            [0, 5, 0]
        ];
    }

    public function testDivideByZero() {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->divide(5, 0);
    }
}