<?php
namespace SimpleCache;

class MemcachedTest extends AbstractCacheTest {
	protected function setUp() {
		try {
			$this->provider = new MemcachedProvider($this->getPrefix() . '_test');
			$this->provider->addServer('localhost', 11211);
		}
		catch (\RuntimeException $re) {
			$this->markTestSkipped(
					'The Memcached extension is not available.'
			);
		}
	}
	
	public function getPrefix() {
		return 'memcached';
	}
}
?>