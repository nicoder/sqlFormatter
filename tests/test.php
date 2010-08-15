<?php
require dirname(__FILE__) . '/../sqlFormatter.php';
require_once 'PHPUnit/Framework.php';

class SqlFormatterTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function fromIsOnSeparateLine()
	{
		$select = 'SELECT a';
		$from = 'FROM myTable';
		$expected = $select . "\n" . $from;
		$o = new SqlFormatter();
		$actual = $o->format($select . ' ' . $from);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @test
	 */
	public function whereIsOnSeparateLine()
	{
		$selectFrom = "SELECT a\nFROM t";
		$where = 'WHERE 1 = 2';
		$expected = $selectFrom . "\n" . $where;
		$o = new SqlFormatter();
		$actual = $o->format($selectFrom . ' ' . $where);
		$this->assertEquals($expected, $actual);
	}

	/**
	 * @test
	 */
	public function keywordsAreUppercased()
	{
		$sql = "SeLECT a\nFRoM t WHere b = c";
		$expected = "SELECT a\nFROM t\nWHERE b = c";
		$o = new SqlFormatter();
		$actual = $o->format($sql);
		$this->assertEquals($expected, $actual);
	}
}
