<?php

/*
 * All rights reserved © 2016 Legow Hosting Kft.
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
        $renderer = new CsvRenderer();

        $config = $container->get('config');
        $templateMap = (isset($config['view_manager']) && isset($config['view_manager']['template_map'])) ? $config['view_manager']['template_map'] : [];

        $resolver = new TemplateMapResolver($templateMap);
        $renderer->setResolver($resolver);

        $helperManager = $container->get('ViewHelperManager');
        $renderer->setHelperPluginManager($helperManager);

        return new CsvStrategy($renderer);
    }

}
