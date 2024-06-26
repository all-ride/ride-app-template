<?php

namespace ride\service;

use ride\library\template\TemplateFacade;
use ride\library\template\Template;

/**
 * Basic service to render templates, can be extended to add functionallity or
 * default variables in the template
 */
class TemplateService {

    protected $templateFacade;

    /**
     * Constructs a new template service
     * @param \ride\library\template\TemplateFacade $templateFacade
     * @param \ride\library\system\System $system
     * @return null
     */
    public function __construct(TemplateFacade $templateFacade) {
        $this->templateFacade = $templateFacade;
    }

    /**
     * Creates a new template
     * @param string $resource Resource name of the template
     * @param array $variables Variables for the template
     * @param string $theme Machine name of the template theme
     * @param string $engine Machine name of the template engine
     * @return \ride\library\template\Template
     */
    public function createTemplate($resource, array $variables = null, $theme = null, $engine = null) {
        return $this->templateFacade->createTemplate($resource, $variables, $theme, $engine);
    }

    /**
     * Renders a template
     * @param \ride\library\template\Template $template Template to
     * render
     * @return string Rendered template
     * @throws \ride\library\template\exception\ResourceNotSetException when
     * no resource was set to the template
     * @throws \ride\library\template\exception\ResourceNotFoundException when
     * the template could not be found by the engine
     */
    public function render(Template $template) {
        return $this->templateFacade->render($template);
    }

}
