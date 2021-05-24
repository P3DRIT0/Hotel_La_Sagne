<?php session_start()
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <!--Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Montserrat&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header>
      <nav class="navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarColor01"
            aria-controls="navbarColor01"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarColor01 ">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="../Pagina_principal/Pagina_principal.php">Habitaciones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Pagina_principal/Pagina_principal.php">Explora</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../Pagina_principal/Pagina_principal.php">Sobre Nosotros</a>
              </li>
            </ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <div>
                <a class="titulo" href="../Pagina_principal/Pagina_principal.php">Hotel La Sagne </a>
              </div>
            </ul>
            <form class="d-flex">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (!empty($_SESSION["usuario"])) { ?>

                <li class="nav-item dropdown">
                  <a
                    class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"
                    href="#"
                    role="button"
                    aria-expanded="false"
                    ><?php echo $_SESSION['usuario'] ?></a
                  >
                  <ul class="dropdown-menu">
                    <li>
                      <a
                        class="dropdown-item"
                        href="../Reservas/Reservas_habitaciones.php"
                        >Reservas</a
                      >
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                      <a class="dropdown-item" href="../Registro/Registro.php"
                        >Logout</a
                      >
                    </li>
                  </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    aria-current="page"
                    href="../Registro/Registro.php"
                    >Registro
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../Inicio_Sesion/Inicio_sesion.php"
                    >Login</a
                  >
                </li>
                <?php } ?>
              </ul>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <section>
      <div class="container">
        <div class="row">
          <div
            class="col-12 mx-auto"
            style="height: 400px; margin-top: 100px"
          >
            <div class="row">
              <div class="col-9">
                <div class="row"><h2 style="text-align: center;margin-top: 20px;text-decoration: underline;">Perfil</h2></div>
                <div class="row"><div class="col-5 m-auto my-5">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nombre:     <?php echo $_SESSION["usuario"] ?></li>
                        <li class="list-group-item">Correo electrónico:     <?php echo $_SESSION["email"] ?></li>
                        <li class="list-group-item">Número de teléfono:     <?php echo $_SESSION["telf"] ?></li>
                        <li class="list-group-item">Dirección:      <?php echo $_SESSION["direccion"] ?></li>
                      </ul>
                </div></div>
              </div>
              <div class="col-3 bg-info">IMG<img src="" alt="" height="350px" /></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
  <!-- Separate Popper and Bootstrap JS -->
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
    crossorigin="anonymous"
  ></script>
  <!--Jquery-->
  <script
    src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"
    type="text/javascript"
  ></script>
</html>
