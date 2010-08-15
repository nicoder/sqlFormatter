<?php

class SqlFormatter
{
	public function format($sql)
	{
		$this->_separateSelectAndFrom($sql);
		$this->_separateFromAndWhere();
		return $this->_assemble();
	}

	private function _assemble()
	{
		$result = $this->_select . "\n" . $this->_from;
		if ($this->_where) {
			$result .= "\n" . $this->_where;
		}
		return $result;
	}

	private function _separateSelectAndFrom($sql)
	{
		$a = $this->_separate($sql, 'FROM');
		$this->_select = str_ireplace('select', 'SELECT', $a[0]);
		$this->_from = $a[1];
	}

	private function _separateFromAndWhere()
	{
		$a = $this->_separate($this->_from, 'WHERE');
		$this->_from = $a[0];
		$this->_where = $a[1];
	}

	private function _separate($sql, $keyWord)
	{
		$a = preg_split('/' . $keyWord . '/i', $sql);
		if (!isset($a[1])) {
			return array($sql, '');	
		}
		return array(trim($a[0]), strtoupper($keyWord) . ' ' . trim($a[1]));
	}
}
