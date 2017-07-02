<?php
// tests/AppBundle/Services/VerifStockTest.php
namespace Tests\AppBundle\Services;

use AppBundle\Services\HeureLimit;
use PHPUnit\Framework\TestCase;

class HeureLimitTest extends TestCase
{


    public function testEstDepasse()
    {

        $dateJour = new \DateTime();
        $time = $dateJour->format('H:i');
        $limit = date('14:00');

        $heureLimit = new HeureLimit();
        $result = $heureLimit->estDepassee($dateJour);


        if($time > $limit) {
            // assert that your calculator added the numbers correctly!
            $this->assertEquals(true, $result);
        } else {
            // assert that your calculator added the numbers correctly!
            $this->assertEquals(false, $result);
        }

    }
}