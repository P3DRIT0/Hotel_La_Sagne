<?php
require_once './BD_habitaciones.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$resultados=lista_habitaciones();
$habitaciones_borrar;
for ($index1 = 0; $index1 < count($resultados); $index1++) {
  $habitaciones="habitacion$index1";
  if (isset($_POST[$habitaciones])) {
        $habitaciones_borrar[]=$resultados[$index1]['id'];
    }  
    
    }
   if(!empty($habitaciones_borrar)){
       borrar_habitaciones($habitaciones_borrar);
       header('Location:./Reservas_habitaciones.php');
       }
?>

<html>
    <body>
      <form action='./Borrar_habitacion.php' method='post'  
            <?php if(!empty($resultados)){
       for ($index = 0; $index < count($resultados); $index++) {
         $id=$resultados[$index]['id'];
         $m2=$resultados[$index]['m2'];
         $ventana=$resultados[$index]['ventana'];
         $tipo_de_habitacion=$resultados[$index]['tipo_de_habitacion'];
         $servicio_limpieza=$resultados[$index]['servicio_limpieza'];
         $internet=$resultados[$index]['internet'];
         $precio=$resultados[$index]['precio'];
         echo "<label><input type='checkbox' name='habitacion$index'</label>Habitacion$index »»Id:$id, m2:$m2 ,Tipo de habitacion:$tipo_de_habitacion, Precio:$precio €<br>";
       } 
            }else{
                echo "No existen habitaciones que borrar";
            }
?>
        <input type='submit' name='borrar' value='Borrar'/>
          </form>
    </body>
</html>
