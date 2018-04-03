<?php


namespace LegoW\View\Renderer;


use Psr\Container\ContainerInterface;
use Zend\View\Renderer\PhpRenderer;

class CsvRendererFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CsvRenderer($container->get(PhpRenderer::class));
    }
}