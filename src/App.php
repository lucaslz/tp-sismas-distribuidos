<?php

namespace app;

use Pimple\Container;

/**
 * Classe responsabel por gerenciar as configuracoes basicas da aplicacao,
 * como o gerenciado de dependencia as blibiotecas baixadas pelo composer
 *
 * @author Lucas Lima <lucasdevelopmaster@gmail.com>
 */
class App
{
    /**
     * Configuracoes basicas
     *
     * @var array
     */
    private $settings;

    /**
     * Injecao de dependencia
     *
     * @var Pimple\Container;
     */
    private $container;

    /**
     * Construtor padrao da classe
     *
     * @param array $settings
     */
    public function __construct($settings = [])
    {
        if (!empty($settings)) {
            $this->setSettings($settings);
        }

        if (is_array($this->getSettings())) {
            $this->container = new Container($this->getSettings());
        }
    }

    /**
     * Busca o array de configuracoes
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Seta o array de configuracoes
     *
     * @return  self
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Retorna o gerenciador de dependencias
     *
     * @return  Pimple\Container;
     */
    public function getContainer()
    {
        return $this->container;
    }
}
