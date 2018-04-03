<?php


namespace LegoW\View\Renderer;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Renderer\PhpRenderer;

use LegoW\View\Renderer\CsvRenderer;
use LegoW\View\Strategy\CsvStrategy;
use Zend\View\Resolver\TemplateMapResolver;

class CsvRendererFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $renderer = $container->get(PhpRenderer::class);

        $config = $container->get('config');
        $templateMap = (isset($config['view_manager']) && isset($config['view_manager']['template_map'])) ? $config['view_manager']['template_map'] : [];

        $resolver = new TemplateMapResolver($templateMap);
        $renderer->setResolver($resolver);

        $helperManager = $container->get('ViewHelperManager');
        $renderer->setHelperPluginManager($helperManager);

        return new CsvRenderer($renderer);
    }
}
