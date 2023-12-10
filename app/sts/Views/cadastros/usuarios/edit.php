<?php
// echo "<pre>";
// var_dump($this->Dados);
// "</pre>";
?>


<header class="bg-gradient-dark">
    <div class="page-header min-vh-70" style="background-image: url('/assets/img/bg2.png');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">

        </div>
    </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <div class="container-fluid">
        <div class="row">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Editar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                </ol>
            </nav>
            <section>
                <div class="container py-4">
                    <div class="row">
                        <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                            <h3 class="text-center">Editar Usuários</h3>
                            <form role="form" id="contact-form" method="post" autocomplete="off">
                                <div class="card-body">
                                    <h3>Dados do Usuário</h3>
                                    <Hr style="height: 2px; color: black; width: 100%; background-color: gray">
                                    <div class="row">
                                        <div class="col-md-6 ps-1">
                                            <div class="input-group input-group-static  mb-4">
                                                <label class="form-label">Username <span style="color:red">*</span> </label>
                                                <input class="form-control" id='username' aria-label="username" value="<?php echo $this->Dados['username']; ?>" type="text">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-1">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Nome Completo <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id='name' placeholder="" value="<?php echo $this->Dados['name']; ?>" aria-label="Name Completo">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-1">
                                            <div class="input-group input-group-static mb-4">

                                                <select name="active" id="active" class="form-control">
                                                    <option <?php if ($this->Dados['active'] == 1) echo "selected"; ?> value="1">Ativo</option>
                                                    <option <?php if ($this->Dados['active'] == 0)  echo "selected"; ?> value="0">Desativado</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6 ps-1">
                                            <div class="input-group input-group-static mb-4">
                                                <input type="checkbox" class="" id='force' placeholder="" value="*" aria-label="Force Update">
                                                <label class=""> &nbsp; Force Changer Password </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <button type="button" class="btn bg-gradient-dark w-100 send">Atualizar</button>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>






        </div>
    </div>
</div>

<script>
    window.onload = (event) => {
        load()
        debugger;
        $("#name").focus();
        $("#username").focus();








        $(".send").click(async function() {
            debugger;
            let force = null;
            let checkbox = $('#force');
            if (checkbox.is(":checked")) {
                force = '*';
            }
            const name = $("#name").val();
            const username = $("#username").val();
            const active = $("#active").val();
            if (name == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (username == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            const data = new FormData;
            data.append('name', name)
            data.append('username', username)
            data.append('active', active)
            data.append('forceReset', force)
            data.append('hash', "<?php echo $this->Dados["hash"]; ?>");

            const response = await loti.post('/cadastros/update-users', data);
            if (response.data.error === 0) {
                showToast(response.data.msg, 'alert-success', 3000)
                setTimeout(function() {
                    window.location.assign('/Cadastros/usuarios')
                }, 1000)
            }

        })


    }
</script>