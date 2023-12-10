<div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image"></div>
    <div class="content">
        <div class="container">
            <div class="col-md-4 ml-auto mr-auto">
                <div class="card card-login card-plain">
                    <form class="form" method="post">
                        <div class="card-header text-center">
                            <div class="logo-container">
                                <img src="../assets/img/LinhasAtivo1.png" alt="">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="login" id="login" value=""
                                    placeholder="Login">
                            </div>
                            <div class="input-group no-border input-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="now-ui-icons text_caps-small"></i>
                                    </span>
                                </div>
                                <input type="password" name="senha" id="password" value="" placeholder="Password"
                                    required class="form-control">
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button"
                                class="btn btn-primary btn-round btn-lg btn-block btn-sender">Entrar</a>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class=" container ">


    </div>
</footer>
</div>
<script>
window.onload = (event) => {
    $(".loader").hide('slow').fadeOut();
    $('.btn-sender').click(async function() {
        $(".loader").show('slow').fadeIn();
        const username = $('#login').val();
        const password = $('#password').val();
        const data = new FormData();
        data.append('login', username);
        data.append('senha', password);
        try {
            const response = await smartGateway.post(`login/auth`, data);

            if (response.data.error === 0) {
                localStorage.setItem("access_token", response.data.access_token);
                localStorage.setItem("limit", response.data.data.exp);
                localStorage.setItem("username", response.data.data.username);

                window.location.assign(
                    "/home/dashboard",
                );
                window.location.getItem("access_token");
                return

            } else {
                showToast('Login incorrect!', 'alert-danger', 6000);
                return;
            }
        } catch (error) {
            showToast(`${error.response.data}`, 'alert-danger', 6000);
            $('.form-cad').hide();

        } finally {
            $(".loader").hide('slow').fadeOut();
        }
    })

}
</script>