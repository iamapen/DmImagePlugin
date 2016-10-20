<?php
namespace Iamapen\DmImagePlugin\Unittest\DmImage\Filter;
use Iamapen\DmImagePlugin\DmImage\Filter\FactoryExif;

class FactoryExifTest extends \PHPUnit_Framework_TestCase
{
    function testcreateFilters() {
        // なし
        $this->assertSame([], FactoryExif::createFilters(null));
        $this->assertSame([], FactoryExif::createFilters(1));
        $this->assertSame([], FactoryExif::createFilters(9));

        // 2 = 左右反転
        $filters = FactoryExif::createFilters(2);
        $this->assertSame(1, count($filters));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\HFlip', get_class($filters[0]));

        // 3 = 180度回転
        $filters = FactoryExif::createFilters(3);
        $this->assertSame(1, count($filters));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\Rotate', get_class($filters[0]));
        $angle = new \ReflectionProperty($filters[0], 'leftAngle');
        $angle->setAccessible(true);
        $this->assertSame(180, $angle->getValue($filters[0]));

        // 4 = 上下反転
        $filters = FactoryExif::createFilters(4);
        $this->assertSame(1, count($filters));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\VFlip', get_class($filters[0]));

        // 5 = 右90度(左270度)回転、左右反転
        $filters = FactoryExif::createFilters(5);
        $this->assertSame(2, count($filters));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\Rotate', get_class($filters[0]));
        $angle = new \ReflectionProperty($filters[0], 'leftAngle');
        $angle->setAccessible(true);
        $this->assertSame(270, $angle->getValue($filters[0]));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\HFlip', get_class($filters[1]));

        // 6 = 右90度(左270度)回転
        $filters = FactoryExif::createFilters(6);
        $this->assertSame(1, count($filters));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\Rotate', get_class($filters[0]));
        $angle = new \ReflectionProperty($filters[0], 'leftAngle');
        $angle->setAccessible(true);
        $this->assertSame(270, $angle->getValue($filters[0]));

        // 7 = 左90度(右270度)回転、左右反転
        $filters = FactoryExif::createFilters(7);
        $this->assertSame(2, count($filters));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\Rotate', get_class($filters[0]));
        $angle = new \ReflectionProperty($filters[0], 'leftAngle');
        $angle->setAccessible(true);
        $this->assertSame(90, $angle->getValue($filters[0]));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\HFlip', get_class($filters[1]));

        // 8 = 左90度(右270度)回転
        $filters = FactoryExif::createFilters(8);
        $this->assertSame(1, count($filters));
        $this->assertSame('Iamapen\\DmImagePlugin\\DmImage\Filter\Rotate', get_class($filters[0]));
        $angle = new \ReflectionProperty($filters[0], 'leftAngle');
        $angle->setAccessible(true);
        $this->assertSame(90, $angle->getValue($filters[0]));
    }
}
