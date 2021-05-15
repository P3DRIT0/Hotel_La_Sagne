<?php
require_once './BD_habitaciones.php';
$resultados=lista_habitaciones();



?>
<html>
    <body>
        <form action='./Modificar_habitaciones.php' method='post'  
            <?php if(!empty($resultados)){
       for ($index = 0; $index < count($resultados); $index++) {
         $id=$resultados[$index]['id'];
         $m2=$resultados[$index]['m2'];
         $ventana=$resultados[$index]['ventana'];
         $tipo_de_habitacion=$resultados[$index]['tipo_de_habitacion'];
         $servicio_limpieza=$resultados[$index]['servicio_limpieza'];
         $internet=$resultados[$index]['internet'];
         $precio=$resultados[$index]['precio'];
         echo "<label><input type='radio' name='habitaciones' value='$index' </label>Habitacion$index »»Id:$id, m2:$m2 ,Tipo de habitacion:$tipo_de_habitacion, Precio:$precio €<br>";
       } 
            }else{
                echo "No existen habitaciones que borrar";
            }
?>
        <input type='submit' name='Listar' value='Listar datos'/>
          </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['habitaciones'])){
   $habitacion_seleccionada=$_POST['habitaciones']; 
   $m2=$resultados[$habitacion_seleccionada]['m2'];
   $tipo_de_habitacion=$resultados[$habitacion_seleccionada]['tipo_de_habitacion'];
   $precio=$resultados[$habitacion_seleccionada]['precio'];
   echo "<form action='./Procesar_modificaciones.php' method='post'<br>";
   echo "<input type='hidden' name='id' value='$id'>";
   echo "m2 <input type='text' name='metros' value=$m2><br>";
   echo "Precio <input type='text' name='precios' value=$precio><br>";
   if($resultados[$habitacion_seleccionada]['ventana']==1){
       echo "Ventana:<input type='radio' name='ventana' value='true' checked >Verdadero";
       echo " <input type='radio' name='ventana' value='false'>Verdadero<br>";
   }else{
       echo "Ventana:<input type='radio' name='ventana' value='true'>Verdadero";
       echo " <input type='radio' name='ventana' value='false' checked >Verdadero<br>";
   }
    echo "Tipo <input type='text' name='tipo_de_habitacion' value='$tipo_de_habitacion'><br>";
    if($resultados[$habitacion_seleccionada]['servicio_limpieza']==1){
       echo "Limpieza:<input type='radio' name='limpieza' value='true' checked >Verdadero";
       echo " <input type='radio' name='limpieza' value='false'>Falso<br>";
   }else{
       echo "Limpieza:<input type='radio' name='limpieza' value='true'>Verdadero";
       echo " <input type='radio' name='limpieza' value='false' checked >Falso<br>";
   }
   if($resultados[$habitacion_seleccionada]['internet']==1){
       echo "Internet:<input type='radio' name='internet' value='true' checked >Verdadero";
       echo " <input type='radio' name='internet' value='false'>Falso<br>";
   }else{
       echo "Internet:<input type='radio' name='internet' value='true'>Verdadero";
       echo " <input type='radio' name='internet' value='false' checked >Falso<br>";
   }
   echo "<input type='submit' value='Modificar'>";
   echo "</form>";
}

}
?>
        
    </body>
</html>