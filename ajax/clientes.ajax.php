<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}

  /*=============================================
    VALIDAR NO REPETIR CLIENTE
    =============================================*/ 

    public  $validarCliente;

    public  function ajaxValidarCliente(){

        $item = "nombre";
        $valor = $this->validarCliente;
        $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

        echo json_encode($respuesta);


    }
}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

 
 /*=============================================
    VALIDAR NO REPETIR USUARIO 
=============================================*/ 

if(isset($_POST["validarCliente"])){

    $ValCliente = new AjaxClientes();
    $ValCliente -> validarCliente = $_POST["validarCliente"];
    $ValCliente -> ajaxValidarCliente();

}