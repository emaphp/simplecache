<?php
namespace SimpleCache;

class MemcacheTest extends AbstractCacheTest {
	protected function setUp() {
		try {
			$this->provider = new MemcacheProvider();
		}
		catch (\RuntimeException $re) {
			$this->markTestSkipped(
					'The Memcache extension is not available.'
			);
		}
	}
	
	public function getPrefix() {
		return 'memcache';
	}
}
?>