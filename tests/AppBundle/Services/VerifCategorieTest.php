<?php
// tests/AppBundle/Services/VerifCategorieTest.php
namespace Tests\AppBundle\Services;

use AppBundle\Services\VerifCategorie;
use PHPUnit\Framework\TestCase;

class VerifCategorieTest extends TestCase
{
    public function testDetermineCat()
    {
        $verifCategorie = new VerifCategorie();

        $date1 = new \DateTime('10-05-1977');
        $date2 = new \DateTime('17-11-1952');
        $date3 = new \DateTime('21-06-2010');

        $result1 = $verifCategorie->determineCat($date1);
        $result2 = $verifCategorie->determineCat($date2);
        $result3 = $verifCategorie->determineCat($date3);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals('normal', $result1);
        $this->assertEquals('senior', $result2);
        $this->assertEquals('enfant', $result3);
    }
}