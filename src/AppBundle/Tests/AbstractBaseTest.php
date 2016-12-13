<?php

namespace AppBundle\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class AbstractBaseTest
 *
 * @category Test
 * @package AppBundle\Tests
 * @author Wils Iglesias <wiglesias83@gmail.com>
 */
abstract class AbstractBaseTest extends WebTestCase
{
    /**
     * set up test
     */
    public function setUp()
    {
        $this->runCommand('hautelook_alice:doctrine:fixtures:load');
    }
}
