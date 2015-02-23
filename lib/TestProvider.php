<?php
namespace SimpleCache;

/**
 * The TestProvider class is a provider that stores values internally for test purposes.
 * @author emaphp
 */
class TestProvider implements CacheProvider {
	/**
	 * Value list
	 * @var array
	 */
	protected $values = [];
	
	public function fetch($id) {
		return array_key_exists($id, $this->values) ? $this->values[$id] : null;
	}
	
	public function exists($id) {
		return array_key_exists($id, $this->values);
	}
	
	public function store($id, $value, $ttl = 0) {
		$this->values[$id] = $value;
		return true;
	}
	
	public function delete($id) {
		if (array_key_exists($id, $this->values))
			unset($this->values[$id]);
	}
}