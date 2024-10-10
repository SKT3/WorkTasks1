<?php

namespace tests\Tasks;

use PHPUnit\Framework\TestCase;
use src\Tasks;

class TasksTests extends TestCase
{

    ##TEST TASK 1
    /**
     * @test
     * @dataProvider dataProviderTask1
     */
    public function test_testTransform($input,$expected){
        $testFunc = new Tasks();

        $result = $testFunc->transform($input);
        self::assertEquals($expected, $result);
    }

    ##TEST TASK 2
    /**
     * @test
     * @dataProvider dataProviderTask1
     */
    public function test_task2($input){
        $testFunc = new Tasks();
        $expected = 3;

        $transformed = $testFunc->transform($input);
        $result = $testFunc->findMaxDepth($transformed);
        self::assertEquals($expected, $result);
    }

    ##TEST TASK 3
    /**
     * @test
     * @dataProvider dataProviderTask1
     */
    public function test_task3($input){
        $testFunc = new Tasks();
        $testValue = 10;

        $transformed = $testFunc->transform($input);
        $result = $testFunc->findItemsByValue($transformed,$testValue);
        self::assertEquals([3,7], $result);
    }

    ##TEST TASK 4
    /**
     * @test
     * @dataProvider dataProviderTask1
     */
    public function test_task4($input){
        $testFunc = new Tasks();
        $testValue = 6;

        $transformed = $testFunc->transform($input);
        $result = $testFunc->findValueById($transformed,$testValue);
        self::assertEquals(15, $result);
    }

    ##TEST TASK 5
    /**
     * @test
     * @dataProvider dataProviderTask1
     */
    public function test_task5($input){
        $testFunc = new Tasks();

        $testValue = 1;
        $expected = [
            [ 'id' => 2, 'value' => 50, 'children' => [
                [ 'id' => 7, 'value' => 10, 'children' => [ ] ],
            ]],
        ];

        $transformed = $testFunc->transform($input);
        $result = $testFunc->removeItemById($transformed,$testValue);
        self::assertEquals($expected, $result);
    }

    ##TEST TASK 6
    /**
     * @test
     * @dataProvider dataProviderTask1
     */
    public function test_task6($input){
        $testFunc = new Tasks();

        $expected = [
            [ 'id' => 1, 'value' => 30, 'children' => [
                ['id' => 3, 'value' => 10, 'children' => [
                    ['id' => 5, 'value' => 12, 'children' => [ ] ],
                    ['id' => 6,  'value' => 15, 'children' => [ ] ]
                ]],
                ['id' => 4, 'value => 20', 'children' => [ ] ]
            ]],
            [ 'id' => 2, 'value' => 50, 'children' => [ ] ],
        ];


        $transformed = $testFunc->transform($input);
        $result = $testFunc->removeDuplicates($transformed);
        self::assertEquals($expected, $result);
    }











    /**
     * @test
     * @dataProvider dataProviderTask1
     */
    public static function dataProviderTask1(): array
    {
        return [
            'data' => [
                'input' => [
                    ["id" => 1, "parent_id" => null, "value" => 30],
                    ["id" => 2, "parent_id" => null, "value" => 50],
                    ["id" => 3, "parent_id" => 1, "value" => 10],
                    ["id" => 4, "parent_id" => 1, "value" => 20],
                    ["id" => 5, "parent_id" => 3, "value" => 12],
                    ["id" => 6, "parent_id" => 3, "value" => 15],
                    ["id" => 7, "parent_id" => 2, "value" => 10]
                ],
                'expected' => [
                    [ 'id' => 1, 'value' => 30, 'children' => [
                        ['id' => 3, 'value' => 10, 'children' => [
                            ['id' => 5, 'value' => 12, 'children' => [ ] ],
                            ['id' => 6,  'value' => 15, 'children' => [ ] ]
                        ]],
                        ['id' => 4, 'value' => 20, 'children' => [ ] ]
                    ]],

                    [ 'id' => 2, 'value' => 50, 'children' => [
                        [ 'id' => 7, 'value' => 10, 'children' => [ ] ],
                    ]],
                ]
            ]
        ];
    }
}