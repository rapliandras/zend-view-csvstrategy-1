<?php

/*
 * All rights reserved © 2016 Legow Hosting Kft.
 */

namespace LegoW\View\Strategy;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Model;
use Zend\View\ViewEvent;
use LegoW\View\Renderer\CsvRenderer;
use LegoW\View\Model\CsvModel;

/**
 * Description of CsvStrategy
 *
 * @author Turcsán Ádám <turcsan.adam@legow.hu>
 */
class CsvStrategy extends AbstractListenerAggregate
{

    protected $charset = 'UTF-16LE';

    /**
     *
     * @var \Zend\View\Renderer\RendererInterface
     */
    protected $renderer = null;

    /**
     * Constructor
     *
     * @param  JsonRenderer $renderer
     */
    public function __construct(CsvRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER,
                [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE,
                [$this, 'injectResponse'], $priority);
    }

    /**
     * Detect if we should use the JsonRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     * @return null|JsonRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();
        if (!$model instanceof CsvModel) {
            // no CsvModel; do nothing
            return;
        }

        // CsvModel found
        return $this->renderer;
    }

    /**
     * Inject the response with the JSON payload and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            // Discovered renderer is not ours; do nothing
            return;
        }

        $result = $e->getResult();
        if (!is_string($result)) {
            // We don't have a string, and thus, no CSV
            return;
        }


        // Populate response
        $response = $e->getResponse();
        $response->setContent($result);
        $headers = $response->getHeaders();

        $contentType = 'text/csv; charset=' . $this->charset;
        $headers->addHeaderLine('content-type', $contentType);

        /* @var $model CsvModel */
        $model = $e->getModel();
        if ($model->getFileName()) {
            $headers->addHeaderLine('Content-Disposition: inline; filename="' . $model->getFileName() . '"');
        }
    }

}
