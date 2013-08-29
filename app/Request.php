<?php

/**
* 
*/
class Request 
{
	private $_controlador;
	private $_metodo;
	private $_argumentos;
	
	function __construct()
	{
		if (isset($_GET['url']) ) {
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL); //filtro la cadena que me llega para limpiarla de caracteres no deseados.
			$url = explode('/', $url); 
			$url = array_filter($url); // limpiar el array de valores no deseados como '/'

			$this->_controlador = strtolower( array_shift($url) );
			$this->_metodo = strtolower( array_shift($url) );
			$this->_argumentos = $url;
		}


		if (!$this->_controlador) {
			$this->_controlador = DEFAULT_CONTROLLER;
		}

		if (!$this->_metodo) {
			$this->_metodo = 'index';
		}

		if (!$this->_argumentos) {
			$this->_argumentos = array();
		}
	}

	public function getControlador(){
		return $this->_controlador;
	}


	public function getMetodo(){
		return $this->_metodo;
	}


	public function getArgumentos(){
		return $this->_argumentos;
	}

}
?>
