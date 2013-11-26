<?php

namespace pallo\application\template\theme;

use pallo\library\dependency\exception\DependencyNotFoundException;
use pallo\library\dependency\DependencyInjector;
use pallo\library\template\exception\ThemeNotFoundException;
use pallo\library\template\theme\ThemeModel;

/**
 * Model of the available themes through dependency injection
 */
class DependencyThemeModel implements ThemeModel {

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
     * Gets a theme
     * @param string $name Machine name of the theme
     * @return Theme
     * @throws pallo\library\template\exception\ThemeNotFoundException
     */
    public function getTheme($name) {
        try {
            return $this->dependencyInjector->get('pallo\\library\\template\\theme\\Theme', $name);
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
        return $this->dependencyInjector->getAll('pallo\\library\\template\\theme\\Theme');
    }

}