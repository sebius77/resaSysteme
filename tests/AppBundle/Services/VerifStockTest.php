<?php
// tests/AppBundle/Services/VerifStockTest.php
namespace Tests\AppBundle\Services;

use AppBundle\Services\VerifStock;
use PHPUnit\Framework\TestCase;

class VerifStockTest extends TestCase
{
    public function testInsuffisant()
    {
        $stock = new VerifStock();
        $result = $stock->insuffisant(995, 10);


        // assert that your calculator added the numbers correctly!
        $this->assertEquals(true, $result);
    }
}