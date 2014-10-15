<?php
namespace SimpleCache;

class APCTest extends AbstractCacheTest {
	protected function setUp() {
		try {
			$this->provider = new APCProvider();
		}
		catch (\RuntimeException $re) {
			$this->markTestSkipped(
					'The APC extension is not available.'
			);
		}
	}
	
	public function getPrefix() {
		return 'apc';
	}
}
?>