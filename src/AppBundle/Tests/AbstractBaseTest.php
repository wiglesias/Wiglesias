<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AbstractBaseTest
 *
 * @category Test
 * @package AppBundle\Tests
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
class AbstractBaseTest extends WebTestCase
{
    public function setUp()
    {
        /**
         * set up test
         */
        $this->runCommand('hautelook_alice:doctrine:fixtures:load');
    }
}
