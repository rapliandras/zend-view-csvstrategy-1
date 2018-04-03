<?php

/*
 * LegoW\Zend-View-CsvStrategy (https://github.com/adamturcsan/zend-view-csvstrategy)
 * 
 * @copyright Copyright (c) 2014-2016 Legow Hosting Kft. (http://www.legow.hu)
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace LegoW\View\Strategy;

use LegoW\View\Renderer\CsvRenderer;
use LegoW\View\Strategy\CsvStrategy;
use Zend\View\Resolver\TemplateMapResolver;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

/**
 * Description of CsvStrategyFactory
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvStrategyFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName,
            array $options = null)
    {
        return new CsvStrategy($container->get(CsvRenderer::class));
    }

}
