<?php
namespace SimpleCache;

class ArrayCacheTest extends AbstractCacheTest {
	protected function setUp() {
		$this->provider = new TestProvider();
	}
	
	public function getPrefix() {
		return 'test';
	}
}
