<?php
namespace Salutation\Test;

use Salutation\Salutation;

class SalutationTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
    	$this->setExpectedException('Salutation\Exception');
    	new Salutation('nl');
    }

    public function testToString()
    {
		$salutation = new Salutation('nl_BE', array(
			array(
				'first' => 'Jan',
				'last' => 'Jansens'
			),
			array(
				'title' => 'Dr.',
				'first' => 'Peter',
				'last' => 'Peters'
			)
		));

		$this->assertEquals('Beste Jan, Dr. Peters,', (string)$salutation);

        $salutation = new Salutation('nl_BE', array(
            array(
                'first' => '',
                'last' => ''
            )
        ));

        $this->assertEquals('Beste,', (string)$salutation);

        $salutation = new Salutation('nl_BE', array(
            array(
                'title' => '',
                'first' => '',
                'last' => ''
            ),
            array(
                'title' => 'Dr.',
                'first' => 'Peter',
                'last' => 'Peters'
            )
        ));

        $this->assertEquals('Beste Dr. Peters,', (string)$salutation);
    }
}
