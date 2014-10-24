<?php

namespace League\Url\Test\Components;

use ArrayIterator;
use League\Url\Components\Path;
use StdClass;
use PHPUnit_Framework_TestCase;

/**
 * @group components
 */
class PathTest extends PHPUnit_Framework_TestCase
{

    public function testPath()
    {
        $path = new Path('/test/query.php');
        $path->prepend('master');
        $this->assertSame('master/test/query.php', $path->get());

        $path->remove('test');
        $this->assertSame('master/query.php', $path->get());

        $path->remove('toto');
        $this->assertSame('master/query.php', $path->get());
        $path->remove('');
        $path->append('sullivent', 'master');
        $this->assertSame('master/sullivent/query.php', $path->get());

        $path->set(null);
        $path->append('/shop/checkout/');
        $this->assertSame('shop/checkout/', $path->get());

        $path->set(array('shop', 'rev iew', ''));
        $this->assertSame('shop/rev%20iew/', $path->get());

        $path->append(new ArrayIterator(array('sullivent', 'wacowski', '')));
        $this->assertSame('shop/rev%20iew//sullivent/wacowski/', $path->get());

        $this->assertNull($path->getSegment(32));
        $this->assertSame('default', $path->getSegment(32, 'default'));
        $this->assertSame('shop', $path->getSegment(0));

        $path->prepend('master');
        $path->prepend('master');
        $this->assertSame('master/master/shop/rev%20iew//sullivent/wacowski/', (string) $path);

        $path->append('slave', 'sullivent');
        $path->append('slave', 'sullivent');

        $path->remove('');

        $this->assertSame('master/master/shop/rev%20iew/sullivent/slave/slave/wacowski/', (string) $path);
    }

    public function testSetSegment()
    {
        $path = new Path('/test/query.php');
        $path->replaceSegment(0, 'shop');
        $this->assertSame('shop/query.php', $path->__toString());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSegmentFailed()
    {
        $path = new Path('/test/query.php');
        $path->replaceSegment(23, 'shop');
    }

    public function testRemove()
    {
        $path = new Path('/toto/le/heros/masson');
        $path->remove('toto');
        $this->assertSame('le/heros/masson', (string) $path);
        $path->remove('ros/masson');
        $this->assertSame('le/heros/masson', (string) $path);
        $path->remove('asson');
        $this->assertSame('le/heros/masson', (string) $path);
        $path->remove('/heros/masson');
        $this->assertSame('le', (string) $path);
        $path = new Path('/toto/le/heros/masson');
        $path->remove('le/heros');
        $this->assertSame('toto/masson', (string) $path);
    }

    public function testKeys()
    {
        $path = new Path(array('bar', 3, 'troll', 3));
        $this->assertCount(4, $path->keys());
        $this->assertCount(0, $path->keys('foo'));
        $this->assertSame(array(0), $path->keys('bar'));
        $this->assertCount(2, $path->keys('3'));
        $this->assertSame(array(1, 3), $path->keys('3'));
    }

    /**
     * @expectedException RuntimeException
     */
    public function testBadPath()
    {
        new Path(new StdClass);
    }

    public function testGetRelativePath()
    {
        $path = new Path('/toto/le/heros/masson');
        $other = new Path('/toto/le/heros/masson');
        $this->assertSame('', $path->relativeTo($other)->__toString());
        $this->assertSame($other->__toString(), $path->relativeTo()->__toString());
    }

    public function testGetRelativePathDiff()
    {
        $path = new Path('/toto/');
        $other = new Path('/toto/le/heros/masson');
        $this->assertSame('../../../', $path->relativeTo($other)->__toString());
    }

    public function testPrepend()
    {
        $path = new Path('/toto/toto/shoky/master');
        $path->prepend('foo', 'toto', 1);
        $this->assertSame('/toto/foo/toto/shoky/master', $path->getUriComponent());
    }
}
