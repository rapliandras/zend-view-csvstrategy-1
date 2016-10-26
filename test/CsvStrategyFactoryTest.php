<?php

/*
 * All rights reserved © 2016 Legow Hosting Kft.
 */

declare (strict_types = 1);

namespace LegoW\View\Test;

use PHPUnit\Framework\TestCase;
use Interop\Container\ContainerInterface;
use Zend\View\HelperPluginManager;
use LegoW\View\Strategy\CsvStrategyFactory;
use LegoW\View\Strategy\CsvStrategy;

/**
 * Description of CsvStrategyFactoryTest
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvStrategyFactoryTest extends TestCase
{
    public function testFactory()
    {
        $mockContainer = $this->createMock(ContainerInterface::class);
        
        $mockViewHelperManager = $this->createMock(HelperPluginManager::class);
        
        $mockContainer->method('get')
                      ->will($this->onConsecutiveCalls([],$mockViewHelperManager));
        
        $csvStrategyFactory = new CsvStrategyFactory();
        
        $this->assertInstanceOf(CsvStrategy::class, $csvStrategyFactory($mockContainer, 'CsvStrategy'));
    }
}
