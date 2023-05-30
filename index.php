<!doctype html>
<html lang="en">
  <head>
    <title>BaumControl</title>
    <link rel="shortcut icon" href="favicon.png" >
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
    </head>
  <body>
    <div>
        <main>
            <diV class="opacidad">
            <div class=fondo_login>
                <div>  
                    <p class="baum">Baum Control</p>
                </div>
                <div class=size_texto_login>
                    <div class="texto_login">
                        <h1>Bienvenido</h1>
                        <p>Introduce el email y la contraseña para poder entrar.</p>
                    </div>
                </div>
            </div>
            </div>
            
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                                
                        </div>
                        <div class="col-md-6">
                            
                       
                            <div class="card">
                                <div class="card-header">
                                    <img src="./img/logo.webp" name="logo" >
                                </div>
                                <div class="card-body">
                                    <form action="iniciarsesion.php" method="GET">

                                    <div class = "form-group">

                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                                    
                                    </div>

                                    <div class="form-group">

                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                                    </div>
                                    
                                    <div id="boton" class="col-md-8">
                                        <button type="submit" id="boton1" name="iniciar" class="btn btn-primary">Iniciar Sesión</button>
                                    </div>
                                    </form>
                                    
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
    </div>

    </div><br><br><br><br><br><br><br><br><br>
    <div class="copy">
        <p> Copyright © 2023 Baum Control S.L. </p><br><br>
    </div>
 </body>
</html>