<?php
namespace SimpleCache;

use SimpleCache\Fixtures\User;

abstract class AbstractCacheTest extends \PHPUnit_Framework_TestCase {
	protected $provider;
	
	public abstract function getPrefix();
	
	public function testInteger() {
		$key = $this->getPrefix() . '_integer';
		
		if ($this->provider->exists($key)) {
			$this->provider->delete($key);
		}
		
		$success = $this->provider->store($key, 100, 60);
		$this->assertTrue($success);
		$exists = $this->provider->exists($key);
		$this->assertTrue($exists);
		$value = $this->provider->fetch($key);
		$this->assertEquals(100, $value);
	}
	
	public function testFloat() {
		$this->provider->delete($this->getPrefix() . '_float');
		$this->provider->store($this->getPrefix() . '_float', 4.75, 60);
		$value = $this->provider->fetch($this->getPrefix() . '_float');
		$this->assertEquals(4.75, $value);
	}
	
	public function testString() {
		$this->provider->delete($this->getPrefix() . '_string');
		$this->provider->store($this->getPrefix() . '_string', "string value", 60);
		$value = $this->provider->fetch($this->getPrefix() . '_string');
		$this->assertEquals("string value", $value);
	}
	
	public function testArray() {
		$this->provider->delete($this->getPrefix() . '_array');
	
		$arr = ['int' => 100, 'float' => 4.75, 'string' => 'string value', 4 => 'four'];
		$this->provider->store($this->getPrefix() . '_array', $arr, 60);
		$value = $this->provider->fetch($this->getPrefix() . '_array');
	
		$this->assertInternalType('array', $value);
		$this->assertCount(4, $arr);
	
		$this->assertArrayHasKey('int', $value);
		$this->assertInternalType('integer', $value['int']);
		$this->assertEquals(100, $value['int']);
	
		$this->assertArrayHasKey('float', $value);
		$this->assertInternalType('float', $value['float']);
		$this->assertEquals(4.75, $value['float']);
	
		$this->assertArrayHasKey('string', $value);
		$this->assertInternalType('string', $value['string']);
		$this->assertEquals('string value', $value['string']);
	
		$this->assertArrayHasKey(4, $value);
		$this->assertInternalType('string', $value[4]);
		$this->assertEquals('four', $value[4]);
	}
	
	public function testStdClass() {
		$this->provider->delete($this->getPrefix() . '_stdclass');
	
		$obj = new \stdClass();
		$obj->int = 100;
		$obj->float = 4.75;
		$obj->string = 'string value';
		$obj->arr = ['abc', 123, 2.5];
	
		$this->provider->store($this->getPrefix() . '_stdclass', $obj);
		$value = $this->provider->fetch($this->getPrefix() . '_stdclass');
	
		$this->assertInstanceOf('stdClass', $value);
	
		$this->assertObjectHasAttribute('int', $value);
		$this->assertInternalType('integer', $value->int);
		$this->assertEquals(100, $value->int);
	
		$this->assertObjectHasAttribute('float', $value);
		$this->assertInternalType('float', $value->float);
		$this->assertEquals(4.75, $value->float);
	
		$this->assertObjectHasAttribute('string', $value);
		$this->assertInternalType('string', $value->string);
		$this->assertEquals('string value', $value->string);
	
		$this->assertObjectHasAttribute('arr', $value);
		$this->assertInternalType('array', $value->arr);
	
		$this->assertArrayHasKey(0, $value->arr);
		$this->assertInternalType('string', $value->arr[0]);
		$this->assertEquals('abc', $value->arr[0]);
	
		$this->assertArrayHasKey(1, $value->arr);
		$this->assertInternalType('integer', $value->arr[1]);
		$this->assertEquals(123, $value->arr[1]);
	
		$this->assertArrayHasKey(2, $value->arr);
		$this->assertInternalType('float', $value->arr[2]);
		$this->assertEquals(2.5, $value->arr[2]);
	}
	
	public function testClassMetadata() {
		$key = $this->getPrefix() . '_metaobj';
		$this->provider->delete($key);
		
		$meta = new \stdClass();
		$meta->int = 1001;
		$meta->str = 'test';
		
		$user = new User();
		$user->setId(100);
		$user->setEmail('emaphp@github.com');
		$user->setName('emaphp');
		$user->__META = $meta;
		
		$this->provider->store($key, $user);
		
		//validate stored data
		$user = $this->provider->fetch($key);
		$this->assertInstanceOf('SimpleCache\Fixtures\User', $user);
		
		$this->assertEquals(100, $user->getId());
		$this->assertEquals('emaphp', $user->getName());
		$this->assertEquals('emaphp@github.com', $user->getEmail());
		$this->assertObjectHasAttribute('__META', $user);
		$meta = $user->__META;
		$this->assertInstanceOf('stdClass', $meta);
		$this->assertObjectHasAttribute('int', $meta);
		$this->assertObjectHasAttribute('str', $meta);
		$this->assertEquals(1001, $meta->int);
		$this->assertEquals('test', $meta->str);
	}
}
?>