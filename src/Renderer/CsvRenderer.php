<?php

/*
 * LegoW\Zend-View-CsvStrategy (https://github.com/adamturcsan/zend-view-csvstrategy)
 *
 * @copyright Copyright (c) 2014-2016 Legow Hosting Kft. (http://www.legow.hu)
 * @license https://opensource.org/licenses/MIT MIT License
 */

namespace LegoW\View\Renderer;

use \Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Resolver\ResolverInterface;

/**
 * Description of CsvRenderer
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvRenderer implements RendererInterface, TreeRendererInterface
{
    protected $genericPhpRenderer;

    public function __construct(PhpRenderer $phpRenderer)
    {
        $this->genericPhpRenderer = $phpRenderer;
    }

    public function render($nameOrModel, $values = null)
    {
        $output = $this->genericPhpRenderer->render($nameOrModel, $values);
        $utf16Output = chr(255) . chr(254) .  mb_convert_encoding(
            $output,
                        'UTF-16LE',
            'UTF-8'
        );
        return $utf16Output;
    }

    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this->genericPhpRenderer->getEngine();
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @param  ResolverInterface $resolver
     * @return RendererInterface
     */
    public function setResolver(ResolverInterface $resolver)
    {
        return $this->genericPhpRenderer->setResolver($resolver);
    }

    /**
     * Indicate whether the renderer is capable of rendering trees of view models
     *
     * @return bool
     */
    public function canRenderTrees()
    {
        return $this->genericPhpRenderer->canRenderTrees();
    }

    public function setHelperPluginManager($helperManager)
    {
        return $this->genericPhpRenderer->setHelperPluginManager($helperManager);
    }

    public function resolver($name = null)
    {
        return $this->genericPhpRenderer->resolver($name);
    }
}
