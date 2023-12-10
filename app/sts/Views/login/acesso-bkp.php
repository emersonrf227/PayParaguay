<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Admin - Thetryum</title>
  <link rel="icon" type="image/png" href="<?php echo URL ?>assets/images/logo_thetryum.png" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700" />
  <!-- https://fonts.google.com/specimen/Open+Sans -->
  <link rel="stylesheet" href="<?php echo URL ?>assets/theme/css/fontawesome.min.css" />
  <!-- https://fontawesome.com/ -->
  <link rel="stylesheet" href="<?php echo URL ?>assets/theme/css/bootstrap.min.css" />
  <!-- https://getbootstrap.com/ -->
  <link rel="stylesheet" href="<?php echo URL ?>assets/theme/css/templatemo-style.css">
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-xl">
      <div class="container h-100">
        <a class="navbar-brand" href="index.html">
          <img src="<?php echo URL ?>assets/images/logo.png" style="width:100%;">
        </a>
        <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars tm-nav-icon"></i>
        </button>
      </div>
    </nav>
  </div>

  <div class="container tm-mt-big tm-mb-big">
    <div class="row">
      <div class="col-12 mx-auto tm-login-col">
        <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
          <div class="row">
            <div class="col-12 text-center">
              <h2 class="tm-block-title mb-4">Bem vindo!</h2>
            </div>
          </div>
          <div class="row mt-2">
            <div class="col-12">
              <form method="post" class="tm-login-form">
                <div class="form-group">
                  <label for="username">Usuário</label>
                  <input name="login" type="text" class="form-control validate" id="login" value="" required />
                </div>
                <div class="form-group mt-3">
                  <label for="password">Senha</label>
                  <input name="senha" type="password" class="form-control validate" id="senha" value="" required />
                </div>
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary btn-block text-uppercase">
                    Login
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="tm-footer row tm-mt-small" style="color: white; width:100vw; clear: both; position: fixed; bottom:0; margin-left: 0px;">
    <div class="col-12 font-weight-light">
      <p class="text-center text-white mb-0 px-4 small">
        Thetryum <b>2023</b>.
      </p>
    </div>
  </footer>
  <script src="<?php echo URL ?>assets/theme/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo URL ?>assets/theme/js/bootstrap.min.js"></script>
</body>

</html>