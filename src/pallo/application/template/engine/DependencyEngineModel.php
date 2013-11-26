<?php

namespace pallo\application\template\engine;

use pallo\library\dependency\exception\DependencyNotFoundException;
use pallo\library\dependency\DependencyInjector;
use pallo\library\template\engine\EngineModel;
use pallo\library\template\exception\EngineNotFoundException;

/**
 * Model of the available themes through dependency injection
 */
class DependencyEngineModel implements EngineModel {

    /**
     * Instance of the dependency injector
     * @var pallo\library\dependency\DependencyInjector
     */
    protected $dependencyInjector;

    /**
     * Constructs a new widget model
     * @param pallo\library\dependency\DependencyInjector $dependencyInjector
     * @return null
     */
    public function __construct(DependencyInjector $dependencyInjector) {
        $this->dependencyInjector = $dependencyInjector;
    }

    /**
     * Gets a template engine
     * @param string $name Machine name of the template engine
     * @return Theme
     * @throws pallo\library\template\exception\TemplateEngineNotFoundException
     */
    public function getEngine($name) {
        try {
            return $this->dependencyInjector->get('pallo\\library\\template\\engine\\Engine', $name);
        } catch (DependencyNotFoundException $exception) {
            throw new EngineNotFoundException($name, $exception);
        }
    }

    /**
     * Gets the available themes
     * @return array Array with the machine name of the template engine as key
     * and an instance of TemplateEngine as value
    */
    public function getEngines() {
        return $this->dependencyInjector->getAll('pallo\\library\\template\\engine\\Engine');
    }

}