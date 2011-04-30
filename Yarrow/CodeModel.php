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
 * Base class for code objects.
 */
abstract class CodeModel {
	
	abstract public function getName();
	
	function __get($key) {
		$accessor = 'get' . ucfirst($key);
		if (method_exists($this, $accessor)) {
			return $this->$accessor();
		}
	}
	
}