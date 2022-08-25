<?php /* copyright© Jhon S. Vique */


class IndexModel{


    protected $_conexion;

    function __construct(){
        try{
            $this->_conexion = new DataBase();

        }catch(Exception $e){
            die();
        }
    }
	
	public function showInvoices(){
        try {
            $this->_conexion->consult("SELECT * FROM facturas where activa = 1");
            $this->_conexion->execute();
            
            return $this->_conexion->showAll();
        } catch (Exception $e) {
            die($e);
        }
    }
}


?> 