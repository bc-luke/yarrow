<?php
/**
 * Yarrow {{version}}
 * Simple Documentation Generator
 * <http://yarrowdoc.org>
 *
 * Copyright (c) 2010-2011, Mark Rickerby <http://maetl.net>
 * All rights reserved.
 * 
 * This library is free software; refer to the terms in the LICENSE file found
 * with this source code for details about modification and redistribution.
 */

/**
 * Map of configuration settings.
 */
class Configuration {

	/**
	 * Active configuration settings.
	 */
	private $settings;
	
	/**
	 * Cache of default settings.
	 */
	private $defaults;
	
	/**
	 * List of input paths to search for code files.
	 */
	public $inputTargets = array();
	
	/**
	 * Output path where documentation is generated.
	 */
	public $outputTarget = false;
	
	/**
	 * Holder for singleton instance of Configuration.
	 */
	private static $instance = false;
	
	/**
	 * Accessor for singleton instance of settings.
	 * @return Configuration
	 */
	public static function instance() {
		if (!self::$instance) {
			self::$instance = new Configuration();
		}
		return self::$instance;
	}
	
	/**
	 * Loads default configuration from settings file.
	 */
	private function __construct() {
		$this->defaults = PropertiesFile::load(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Yarrowdoc');
		$this->settings = $this->defaults;
	}
	
	/**
	 * Merge given properties with existing settings.
	 *
	 * @param array $properties new properties to merge
	 */
	public function merge($properties) {
		$this->settings = $this->mergeReplace($this->settings, $properties);
	}
	
	/**
	 * Append given properties to existing settings. If the new key already exists
	 * it is ignored.
	 *
	 * @param array $properties new properties to merge
	 */
	public function append($properties) {
		$this->settings = $this->mergeReplace($properties, $this->settings);
	}
	
	/**
	 * Recursive callback to actually do the merge, replacing existing keys
	 * with new values, and appending any new values that don't exist.
	 *
	 * @param array $array1 values to merge against
	 * @param array $array2 new values to apply
	 * @return array merged result
	 */
	private function mergeReplace($array1, $array2) {
		foreach($array2 as $key => $value) {
			if (array_key_exists($key, $array1) && is_array($value)) {
				$array1[$key] = $this->mergeReplace($array1[$key], $value);
			} else {
				$array1[$key] = $value;
			}
		}
		return $array1;
	}
	
	/**
	 * Accessor for configuration settings. If the setting is not found
	 * under a section key the options section is checked.
	 */
	public function __get($key) {
		if (isset($this->settings[$key])) {
			return $this->settings[$key];
		}
	}
	
	/**
	 * Clear all existing configuration.
	 * Generally, this is only used for testing.
	 */
	public function clear() {
		$this->settings = $this->defaults;
	}
}