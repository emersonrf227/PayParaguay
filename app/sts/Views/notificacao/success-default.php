<body>
    <div>
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="index.html">
                    <img src="<?php echo URL ?>assets/img/logo_loti.png" style="width:160px;">
                </a>
            </div>
        </nav>
    </div>

    <div class="container tm-mt-big tm-mb-big">
        <div class="row">
            <div class="col-12 mx-auto tm-login-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <div class="row mt-2">
                        <div class="col-12">
                            <?php

                            if (isset($_SESSION['error'])) {
                                echo "
                                
                                 
                                    <center><img src='" . URL . "assets/img/success.png' alt='...'  style='width:7.0rem; height:7.0rem; align:center;'></center>
                                    <br><br>
                                    <center><text style='color:#333; font-size:20px;'>" . $_SESSION['error']['msg'] . " </text></center>
                                    <br><br>                                          
                                    <center><a href='" . URL . "" . $_SESSION['error']['redirect'] . "' style='background-color:#d308ea; color:#333;' type='submit' class='btn btn-block text-uppercase'>" . $_SESSION['error']['button'] . " </a></center>
                                
                            ";

                                if ($_SESSION['error']['destroy_session'] == 'S') {
                                    session_destroy();
                                }

                                // unset($_SESSION['error']);

                            } else {
                                // header("location: " . URL . "notificacao/erro/404");
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = (event) => {
            load()
            $(".loader").hide('slow').fadeOut();

        }
    </script>