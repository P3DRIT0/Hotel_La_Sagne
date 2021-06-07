<?php
include_once './BD_habitaciones.php';
$reservas_lista = listar_reservas();
$lista_filtrada;
$submit=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$submit=true;
    if (isset($_POST['dato_filtrar']) && isset($_POST['tipo_dato'])) {
    $datos_filtrar=$_POST['dato_filtrar'];
    $tipo_dato=$_POST['tipo_dato'];
    $index2;
    if($tipo_dato==="Num_Reserva"){
        $index2=0;
    }
    if($tipo_dato==="Email"){
        
       $index2=11; 
    }
    if($tipo_dato==="Telefono"){
       $index2=12; 
    }
    if($tipo_dato==="Tipo Habitacion"){
       $index2=4;  
    }
    for ($index1 = 0; $index1 < count($reservas_lista); $index1++) {
      
        if($reservas_lista[$index1][$index2]===$datos_filtrar){
       $lista_filtrada[]=$reservas_lista[$index1];
        }
    }
    
    
    }

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="57x57" href="../config/ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../config/ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../config/ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../config/ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../config/ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../config/ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../config/ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../config/ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../config/ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../config/ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../config/ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../config/ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../config/ico/favicon-16x16.png">
        <link rel="manifest" href="../config/ico//manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../config/ico/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
            crossorigin="anonymous"
            />
        <link rel="stylesheet" href="formularios.css" />
        <title>Listar Habitaciones</title>
    </head>
    <body> 
        <form action='./Listar_reservas.php' method='post'> 
          <div id="caja" class="col-10 " >
            <h3>Listar Reservas</h3>
            <div class="row ">
            <div class="col-6 " id="formulario">
        
       
             
            
            <select  class="col-2 " name="tipo_dato">
            <option>Num_Reserva </option>
            <option>Email</option>
            <option>Telefono</option>
            <option>Tipo Habitacion</option>
            </select>
            <input type="text" name="dato_filtrar">
             <input id="boton" type="submit" class="btnRegister"  value="Filtrar"/> 
              <input id="boton" type="button" class="btnRegister"  value="Listar todas" onclick="location = './Listar_reservas.php'"/> 
            <input id="boton" type="button" class="btnRegister"  value="Atras" onclick="location = './Reservas_habitaciones.php'"/> 
           
            </div>
            </div>
          </div>
         </form>
   
        <br>
               
        <table class='table table-striped'>
            <thead class="thead-light">
                <tr>

                    <th scope="col">Numero de reserva</th>
                    <th scope="col">Fecha de entrada </th>
                    <th scope="col">Fecha de salida </th>
                    <th scope="col">Id Usuario </th>
                    <th scope="col">Nombre </th>
                    <th scope="col">Correo </th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Direccion</th>
                    <th scope="col">Id Habitacion  </th>
                    <th scope="col">Tipo de habitacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                
                
              if((!empty($reservas_lista)&&!$submit)){
                    echo "   <tr>";
                    for ($index = 0; $index < count($reservas_lista); $index++) {
                        echo "
                   
                    <td scope='row'>" . $reservas_lista[$index][0] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][2] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][3] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][1] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][10] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][11] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][12] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][13] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][7] . "</td>
                    <td scope='row'>" . $reservas_lista[$index][4] . "</td>
                    </tr>
                
              ";
                    }
                } if($submit && (!empty($lista_filtrada))){
                 
                    for ($index = 0; $index < count($lista_filtrada); $index++) {
                       echo "
                   
                    <td scope='row'>" . $lista_filtrada[$index][0] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][2] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][3] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][1] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][10] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][11] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][12] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][13] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][7] . "</td>
                    <td scope='row'>" . $lista_filtrada[$index][4] . "</td>
                    </tr>
                
              ";
                    
                        
                    }
                  
                } 
                
                
                
                ?>
            </tbody>
        </table>
        <?php if($submit && empty($lista_filtrada)){
                    echo "";
                 echo "<p style='color:gray;text-align: center'>No hay resultados</p>";
                
}?>
                </form>
           </div>
          </div>
 </body>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
            crossorigin="anonymous"
        ></script>
</html>
