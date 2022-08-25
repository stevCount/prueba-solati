<?php /* copyright© Jhon S. Vique */
/**
 * Abstraer la url que se ingresa
 * En primer lugar se trae:
 * 1-Controlador.
 * 2-Metodo.
 * 3-Parametros
 * Ejemplo/Articulo/actualizar/4
 */
Class Core{
	/**
	 * [$controladorActual description]
	 * @var string
	 */
	protected $controladorActual ='Index';
	/**
	 * [$metodoActual description]
	 * @var string
	 */
	protected $metodoActual      ='init';
	/**
	 * [$parametroActual description]
	 * @var array
	 */
	protected $parametroActual   =[];
	/**
	 * [__contruct description]
	 * @return [type] [description]
	 * este constructor no ayuda a inicializar los elementos
	 * con un valor inicial, en este caso la url es igual a la que se ingresa
	 * desde el navegador
	 * 
	 * Array 0= metodo, 1 = Metodo, 2= Parametro
	 */
	public function __Construct(){

		/* Variable que inicia la url con la que esta en el navegador.*/
		$url = $this ->getUrl();

		//-------------------------------------------------------------------------
	  /*Funcion de control para controlar si existe el archivo del controlador*/
	  if (file_exists('../app/Controller/' .ucwords($url[0]).'.php')) {
	  	/*Si existe se configura como controlador por defecto*/
	  	$this->controladorActual= ucwords($url[0]);
	  	/*hacemos un unset del indice 0 para desmontar el controlador actual, por ejemplo paginas*/
	  	unset($url[0]);
	  	}//fin if.


		/*funcion para imprimir como formatea la url
		print_r($this->getUrl());*/

		/*Luego requerimos el controlador*/
		require_once('../app/Controller/'.$this->controladorActual.'.php');
		$this->controladorActual=new $this->controladorActual;
		//--------------------------------------------------------------------------
		
		/**Funcion de control para controlar si existe el metodo
		*Verifica si existe el metodo, la cual seria la url que viene en el arreglo 1,
		*la funcion method_exists nos sirve para verificar si existe, es nativa en 
		*php.
		**
		*/
		//--------------------------------------------------------------------------
		if (isset($url[1])){
				if (method_exists($this->controladorActual, $url[1])) {
				/*Si se cargo se chequea el metodo.*/
				$this->metodoActual=$url[1];
				unset($url[1]);
			}//fin if2.
		}//fin if1.
		//----------------------------------------------------------------------------
		/*Prueba que trae metodo
		 echo $this->metodoActual;*/

		 /**Funcion de control para traer parametros.
		*/
		//--------------------------------------------------------------------------
		/*Operador ternario en php*/
		$this->parametros=$url ? array_values($url) : [];
		/*Llamamos funcion callback con para para traer arreglos de la url
		*/
		call_user_func_array([$this->controladorActual, $this->metodoActual],$this->parametros);
		//----------------------------------------------------------------------------

	}//Fin constructor.
	/**
	 * [getUrl description]
	 * @return [type] [description]
	 * este metodo nos imprime la url que se esta digitando, eliminando 
	 * los caracteres y separando con los '/'.
	 */
	public function getUrl(){
		
		/*Imprime la url que esta en el navegador.
		print $_GET['url'];*/
		/*Funcion de control que verifica si exista una url*/
		if (isset($_GET['url'])) {
			/*rtrim acorta los espacios hacia la derecha con '/' */
			$url = rtrim($_GET['url'], '/');
			/**Caracter que se evalua '/' para cortar espacios,
			*Se valida la url, FILTER_SANITIZE_URL ayuda a interpretarlo
			*como url
			*/
			$url = filter_var($url, FILTER_SANITIZE_URL);
			/*Delimita cual es el controlador, metodo y parametro*/
			$url= explode('/', $url);
			return $url;
		}//fin if.
	}//fin metodo getUrl.
}//Fin clase core.
?>