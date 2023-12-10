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
                    <li class="breadcrumb-item"><a href="">Cadastros</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                </ol>
            </nav>
            <section>
                <div class="container py-4">
                    <div class="row">
                        <div class="col-lg-7 mx-auto d-flex justify-content-center flex-column">
                            <h3 class="text-center">Cadastrar Usuarios</h3>
                            <form role="form" id="contact-form" method="post" autocomplete="off">
                                <div class="card-body">
                                    <h5>Dados do usuário </h5>

                                    <div class="row">
                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static  mb-4">
                                                <label class="form-label">Username <span style="color:red">*</span> </label>
                                                <input class="form-control" id='username' aria-label="username" type="text">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Nome Completo <span style="color:red">*</span></label>
                                                <input type="text" class="form-control" id='name' placeholder="" aria-label="Name Completo">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Password <span style="color:red">*</span></label>
                                                <input type="password" class="form-control" id='password' placeholder="" aria-label="Password">
                                            </div>
                                        </div>

                                        <div class="col-md-6 ps-2">
                                            <div class="input-group input-group-static mb-4">
                                                <label class="form-label">Confirm Password <span style="color:red">*</span></label>
                                                <input type="password" class="form-control" id='cpassword' placeholder="" aria-label="Confima Password">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button type="button" class="btn bg-gradient-dark w-100 send">Cadastrar</button>
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



        $(".send").click(async function() {

            const header = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            debugger
            const username = $("#username").val();
            const name = $("#name").val();
            const password = $("#password").val();
            const cpassword = $("#cpassword").val();




            if (username == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (name == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }
            if (password == '') {
                showToast('Preencher todos os campos obrigatórios.', 'alert-danger', 6000)
                return
            }

            if (password != cpassword) {
                showToast('A confirmação de senha deve ser idêntica a senha.', 'alert-danger', 6000)
                return
            }




            const data = new FormData;
            data.append('name', name)
            data.append('username', username)
            data.append('password', password)


            try {
                const response = await loti.post('/cadastros/put-users', data);

                if (response.data.error === 0) {
                    showToast(response.data.msg, 'alert-success', 3000)

                    setTimeout(function() {
                        window.location.assign('/Cadastros/imoveis')
                    }, 1000)
                } else {
                    showToast(response.data.msg, 'alert-danger', 3000)
                }

            } catch (error) {
                showToast(error, 'alert-danger', 3000)

            }


        })


    }
</script>