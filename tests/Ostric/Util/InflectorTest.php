<?php
namespace Ostric\Util;

require_once 'PHPUnit/Framework.php';

require_once '/home/ata/Project/ostric/lib/Ostric/Util/Inflector.php';

/**
 * Test class for Inflector.
 * Generated by PHPUnit on 2010-01-27 at 00:22:37.
 */
class InflectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Inflector
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testDotted().
     */
    public function testDotted()
    {
        $this->assertEquals(Inflector::dotted('ClassName'),'class_name');
        $this->assertEquals(Inflector::dotted('Path\To\ClassName'),'path.to.class_name');
        
    }

    /**
     * @todo Implement testClassify().
     */
    public function testClassify()
    {
        $this->assertEquals(Inflector::classify('path.to.class_name'),'Path\To\ClassName');
        $this->assertEquals(Inflector::classify('/path/to/class-name'),'\Path\To\ClassName');
        $this->assertEquals(Inflector::classify('Path/To/ClassName'),'Path\To\ClassName');
        $this->assertEquals(Inflector::classify('class_name'),'ClassName');
    }
}
?>
