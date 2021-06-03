<?php
include_once './BD_añadir_propiedades.php';
session_start();
function añadir_datos_trabajadores($fecha_nac,$dni,$nacionalidad,$sexo){
 $lista_prp_usuarios=cargar_propiedades_usuario($_SESSION['id']);
$Trabajador= new Trabajador($lista_prp_usuarios[0][0],$lista_prp_usuarios[0][1],$lista_prp_usuarios[0][2],$lista_prp_usuarios[0][3],$lista_prp_usuarios[0][4],$lista_prp_usuarios[0][5],$lista_prp_usuarios[0][6],"../Perfil/Multimedia/foto_perfil_trabajadores.png",$fecha_nac,$dni,$nacionalidad,$sexo);
$Trabajador->Anadir_Trabajador(); 
}
function  añadir_datos_administradores(){
    $lista_prp_usuarios=cargar_propiedades_usuario($_SESSION['id']);
   $Administrador= new Administrador($lista_prp_usuarios[0][0],$lista_prp_usuarios[0][1],$lista_prp_usuarios[0][2],$lista_prp_usuarios[0][3],$lista_prp_usuarios[0][4],$lista_prp_usuarios[0][5],$lista_prp_usuarios[0][6],"../Perfil/Multimedia/foto_perfil_administradores.png");
   $Administrador ->Anadir_Administrador();
   header('Location:../Reservas/Reservas_habitaciones.php');
}

class Usuarios{
   
    
    protected $id;
    protected $nombre;
    protected $email;
    protected $telf;
    protected $direccion;
    protected $password;
    protected $rol;
    protected $imagen_usuario;
    
      function __construct($id, $nombre,$email,$telf,$direccion,$password,$rol,$imagen_usuario){
      $this->id= $id;
      $this->nombre=$nombre;
      $this->email=$email;
      $this->telf=$telf;
      $this->direccion=$direccion;
      $this->password=$password;
      $this->rol=$rol;
      $this->imagen_usuario=$imagen_usuario;
      
    }
}

class Trabajador extends Usuarios{
    protected $fecha_nac;
    protected $dni;
    protected $nacionalidad;
    protected $sexo;
    function __construct($id, $nombre, $email, $telf, $direccion, $password, $rol, $imagen_usuario,$fecha_nac,$dni,$nacionalidad,$sexo){
       parent::__construct($id, $nombre, $email, $telf, $direccion, $password, $rol, $imagen_usuario);
       $this->fecha_nac=$fecha_nac;
       $this->dni=$dni;
       $this->nacionalidad=$nacionalidad;
       $this->sexo=$sexo;
       
   }
   function Anadir_Trabajador(){
       añadir_trabajadores($this->imagen_usuario, $this->fecha_nac, $this->dni, $this->nacionalidad, $this->sexo);
   }
}
class Administrador extends Usuarios{
     function __construct($id, $nombre, $email, $telf, $direccion, $password, $rol, $imagen_usuario){
       parent::__construct($id, $nombre, $email, $telf, $direccion, $password, $rol, $imagen_usuario);
    
    
}
 function Anadir_Administrador(){
     añadir_administradores($this->imagen_usuario);
   }

     }


