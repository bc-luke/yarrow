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
	private $hint;
	private $default;
	private $isReference;
	
	function __construct($name, $hint = null, $default = null, $isReference = false, $a = array(array())) {
		$this->name = $name;
		$this->hint = $hint;
		$this->default = $default;
		$this->isReference = $isReference;
	}

	public function getName() {
		return $this->name;
	}
	
	public function getHint() {
		return $this->hint;
	}

	public function getDefault() {
		return $this->default;
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

	public function toDelcaration() {
		$declaration = $this->hasHint() ? $this->getHint() . ' ' : '';
		$declaration .= $this->isReference() ? '&' : '';
		$declaration .= $this->getName();
		$declaration .= $this->hasDefault() ? ' = ' . $this->getDefault(): '';
		
	}
	
}

