<?php

namespace Core;



class ConfigController
{

    private $Url;
    private $UrlConjunto;
    private $UrlController;
    private $UrlParametro;
    private $UrlMetodo;
    private $Classe;
    private $Paginas;
    private static $Format;

    public function __construct()
    {

        if (!empty(filter_input(INPUT_SERVER, 'REQUEST_URI'))) {
            //Verifica se a URL esta setada e trata a URL.
            $url = explode("?", filter_input(INPUT_SERVER, 'REQUEST_URI'));
            $this->Url = $url[0];
            $this->limparUrl();

            $this->UrlConjunto = explode("/", $this->Url);
            //Verifica UrlConjunto e define a Controller como a possição 0 do array.
            if (isset($this->UrlConjunto[1])) {
                $this->UrlController = $this->slugController($this->UrlConjunto[1]);
            } else {
                $this->UrlController = $this->slugController(CONTROLLER);
            }

            //Verifica UrlConjunto e define o Metodo como a possição 1 do array.
            if (isset($this->UrlConjunto[2])) {
                $this->UrlMetodo = $this->slugMetodo($this->UrlConjunto[2]);
            } else {
                $this->UrlMetodo = $this->slugMetodo(METODO);
            }

            //Verifica UrlConjunto e define o Paramentro como a possição 2 do array
            if (isset($this->UrlConjunto[3])) {
                $this->UrlParametro = $this->UrlConjunto[3];
            } else {
                $this->UrlParametro = null;
            }
        } else {
            $this->UrlController = $this->slugController(CONTROLLER);
            $this->UrlMetodo = $this->slugMetodo(METODO);
            $this->UrlParametro = null;
        }
    }

    private function limparUrl()
    {
        //Eliminar as tags
        $this->Url = strip_tags($this->Url);
        //Eliminar espaços em branco
        $this->Url = trim($this->Url);
        //Eliminar a barra no final da URL
        $this->Url = rtrim($this->Url, "/");

        self::$Format = array();
        self::$Format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        self::$Format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
        $this->Url = strtr(utf8_decode($this->Url), utf8_decode(self::$Format['a']), self::$Format['b']);
    }

    public function slugController($SlugController)
    {
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($SlugController)))));
        return $UrlController;
    }

    public function slugMetodo($SlugMetodo)
    {
        $UrlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($SlugMetodo)))));
        return lcfirst($UrlController);
    }

    public function carregar()
    {
        $this->Classe = "\\App\\sts\\Controllers\\" . $this->UrlController;
        if (class_exists($this->Classe)) {

            $this->carregarMetodo();
        } else {
            $this->UrlController = $this->slugController(CONTROLLER);
            $this->UrlMetodo = $this->slugMetodo(METODO);
            $this->carregar();
        }
    }

    private function carregarMetodo()
    {
        $classeCarregar = new $this->Classe;
        if (method_exists($classeCarregar, $this->UrlMetodo)) {
            if ($this->UrlParametro !== null) {
                $classeCarregar->{$this->UrlMetodo}($this->UrlParametro);
            } else {

                $classeCarregar->{$this->UrlMetodo}();
            }
        } else {
            $this->UrlController = $this->slugController(CONTROLLER);
            $this->UrlMetodo = $this->slugMetodo(METODO);
            $this->carregar();
        }
    }
}
