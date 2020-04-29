<?php
class ConexionBD
{
    private $servidor;
    private $usuario;
    private $pass;
    private $base_datos;
    private $descriptor;
    private $resultado;

    function __construct($servidor, $usuario, $pass, $base_datos)
    {
        $this->servidor = $servidor;
        $this->usuario = $usuario;
        $this->pass = $pass;
        $this->base_datos = $base_datos;
        $this->conectar_base_datos();
    }

    private function conectar_base_datos()
    {
        $this->descriptor = mysqli_connect($this->servidor, $this->usuario, $this->pass, $this->base_datos);
        mysqli_set_charset($this->descriptor, 'utf8');
    }

    public function query($query)
    {
        $this->resultado = mysqli_query($this->descriptor, $query);
        if (!$this->resultado) {
            die('Consulta no válida: ' . mysqli_error($this->descriptor));
        }
    }

    public function error()
    {
    }

    public function extraer_registro()
    {
        if ($fila = mysqli_fetch_array($this->resultado, MYSQLI_ASSOC)) {
            return $fila;
        } else {
            return false;
        }
    }

    public function cerrarConexion($var)
    {
        mysqli_close($var);
    }
}

$servidor = "localhost";
$usuario = "root";
$pass = "";
$base_datos = "outcinema";
