<?php
//
//use Quiz\BowlingCalculator;
//
//require_once __DIR__. '/../vendor/autoload.php';
//
//class BonelingCalculatorTest extends \PHPUnit\Framework\TestCase
//{
//    public function testGetResults_withSimpleGame_shouldReturn20()
//    {
//        $calculator = new BowlingCalculator();
//
//        for ($i = 0; $i < 20; $i++) {
//            $calculator->throw(1);
//        }
//
//        $this->assertEquals(20, $calculator->getResults());
//    }
//
//    public function testGetResults_withExtraPoints_shouldReturn25()
//    {
//        $calculator = new BowlingCalculator();
//        $calculator->throw(6);
//
//        for ($i = 0; $i < 19; $i++) {
//            $calculator->throw(1);
//        }
//
//        $this->assertEquals(25, $calculator->getResults());
//    }
//
//    public function testGetResults_withSpare_addNextThrowsPoints()
//    {
//        $calculator = new BowlingCalculator();
//        $calculator->throw(5);
//        $calculator->throw(5);
//        $calculator->throw(3);
//
//        for ($i = 0; $i < 17; $i++) {
//            $calculator->throw(1);
//        }
//
//        $this->assertEquals(33, $calculator->getResults());
//    }
//
//    public function testGetResults_withStrike_addNextTwoThrowsPoints()
//    {
//        $calculator = new BowlingCalculator();
//        $calculator->throw(10);
//        $calculator->throw(3);
//        $calculator->throw(3);
//
//        for ($i = 0; $i < 16; $i++) {
//            $calculator->throw(1);
//        }
//
//        $this->assertEquals(38, $calculator->getResults());
//    }
//
//    public function testGetResults_withPerfectGame_gives300Points()
//    {
//        $calculator = new BowlingCalculator();
//        for ($i = 0; $i < 12; $i++) {
//            $calculator->throw(10);
//        }
//
//        $this->assertEquals(300, $calculator->getResults());
//    }
//}