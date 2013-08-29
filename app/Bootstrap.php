<?php

/**
* 
*/
class Bootstrap 
{
	
	public static function run(Request $peticion)
	{
		$controlador = $peticion->getControlador() . 'Controller';
		$ruta_controlador = ROOT . 'controladores' . DS . $controlador . '.php';
		$metodo = $peticion->getMetodo();
		$argumentos = $peticion->getArgumentos();

		if (is_readable($ruta_controlador)) {		

			require_once $ruta_controlador;
			$controlador = new $controlador;

			if (!is_callable(array($controlador, $metodo))) {
				$metodo = 'index';
			}

			if(isset($argumentos)){
                call_user_func_array(array($controlador, $metodo), $argumentos);
            }
            else{
                call_user_func(array($controlador, $metodo));
            }
		}
		else{

			throw new Exception("Controlador no encontrado");
		}
	}
	

}
?>
