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
 * Represents a function argument.
 */
class ArgumentModel extends CodeModel {

	private $name;
	private $default;
	private $hint;
	private $isReference;
	
	function __construct($name, $default = null, $hint = null, $isReference = false) {
		$this->name = $name;
		$this->default = $default;
		$this->hint = $hint;
		$this->isReference = $isReference;
	}

	public function getName() {
		return $this->name;
	}

	public function getDefault() {
		return $this->default;
	}

	public function getHint() {
		return $this->hint;
	}

	public function isReference() {
		return $this->isReference;
	}

	public function hasHint() {
		return !is_null($this->hint);
	}
	
	public function hasDefault() {
		return !is_null($this->default);
	}

	public function getDeclaration() {
		$declaration = $this->hasHint() ? $this->getHint() . ' ' : '';
		$declaration .= $this->isReference() ? '&' : '';
		$declaration .= $this->getName();

		if ($this->hasDefault()) {
			$declaration .= ' = ';
			$default = $this->getDefault();
			if (is_bool($default)) {
				$default = $default ? 'true' : 'false';
			} elseif (is_array($default)) {
				$default = var_export($default, true);
				$default = preg_replace('/,?\v/', '', $default);
				$default = preg_replace('/array\s*\(\s*/', 'array(', $default);
				$default = preg_replace('/\s+array/', ' array', $default);
				$default = preg_replace('/\s+\)/', ')', $default);
			}
			$declaration .= $default;
		}
		
		return $declaration;
	}
	
}

