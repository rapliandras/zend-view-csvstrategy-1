<?php

namespace LegoW\View;

use LegoW\View\Renderer\CsvRenderer;
use LegoW\View\Renderer\CsvRendererFactory;
use LegoW\View\Strategy\CsvStrategy;
use LegoW\View\Strategy\CsvStrategyFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface

{
    public function getConfig()
    {
        return [
            "service_manager" => [
                "factories" => [
                    CsvStrategy::class => CsvStrategyFactory::class,
                    CsvRenderer::class => CsvRendererFactory::class
                ],
            ],
        ];
    }
}