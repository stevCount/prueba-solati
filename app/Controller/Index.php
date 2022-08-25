<?php /* copyright© Jhon S. Vique */
class Index extends Controller{

    function __construct(){
        parent::extendModel('IndexModel');
    }
    
    public function init(){
        parent::view('Index');
    }

    public function listarFacturas(){
        $facturas = $this->model->showInvoices();
        return $this->json_response($facturas);
    }

    function json_response($data = null, $httpStatus = 200)
    {
        header_remove();
        header("Content-Type: application/json");
        http_response_code($httpStatus);
        echo json_encode($data);
        exit();
    }
}
?>