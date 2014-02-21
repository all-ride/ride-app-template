<?php

namespace ride\application\template\engine;

use ride\library\dependency\exception\DependencyNotFoundException;
use ride\library\dependency\DependencyInjector;
use ride\library\template\engine\EngineModel;
use ride\library\template\exception\EngineNotFoundException;

/**
 * Model of the available themes through dependency injection
 */
class DependencyEngineModel implements EngineModel {

    /**
     * Instance of the dependency injector
     * @var ride\library\dependency\DependencyInjector
     */
    protected $dependencyInjector;

    /**
     * Constructs a new widget model
     * @param ride\library\dependency\DependencyInjector $dependencyInjector
     * @return null
     */
    public function __construct(DependencyInjector $dependencyInjector) {
        $this->dependencyInjector = $dependencyInjector;
    }

    /**
     * Gets a template engine
     * @param string $name Machine name of the template engine
     * @return Theme
     * @throws ride\library\template\exception\TemplateEngineNotFoundException
     */
    public function getEngine($name) {
        try {
            return $this->dependencyInjector->get('ride\\library\\template\\engine\\Engine', $name);
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
        return $this->dependencyInjector->getAll('ride\\library\\template\\engine\\Engine');
    }

}