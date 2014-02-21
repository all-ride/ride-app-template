<?php

namespace ride\application\template\theme;

use ride\library\dependency\exception\DependencyNotFoundException;
use ride\library\dependency\DependencyInjector;
use ride\library\template\exception\ThemeNotFoundException;
use ride\library\template\theme\ThemeModel;

/**
 * Model of the available themes through dependency injection
 */
class DependencyThemeModel implements ThemeModel {

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
     * Gets a theme
     * @param string $name Machine name of the theme
     * @return Theme
     * @throws ride\library\template\exception\ThemeNotFoundException
     */
    public function getTheme($name) {
        try {
            return $this->dependencyInjector->get('ride\\library\\template\\theme\\Theme', $name);
        } catch (DependencyNotFoundException $exception) {
            throw new ThemeNotFoundException($name, $exception);
        }
    }

    /**
     * Gets the available themes
     * @return array Array with the machine name of the theme as key and an
     * instance of Theme as value
    */
    public function getThemes() {
        return $this->dependencyInjector->getAll('ride\\library\\template\\theme\\Theme');
    }

}