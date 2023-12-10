<header class="bg-gradient-dark">
    <div class="page-header min-vh-70" style="background-image: url('../assets/img/bg2.png');" loading="lazy">
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
            <section class="pt-5 mt-5">
                <div class="card" style="padding:20px">
                    <form method="GET" action="#">
                        <div class="row" style="display:flex; flex-direction:row; justify-content: flex-start;">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='viewDisabled' <?php if (!empty($_GET['viewDisabled'])) echo "checked"; ?> value="true" id="flexCheckCheckedDisabled">
                                    <label class="form-check-label" for="flexCheckCheckedDisabled">
                                        Mostrar itens desabilitados
                                    </label>
                                </div>
                            </div>
                            <div>

                                <div class="form-check">
                                </div>
                            </div>

                        </div>
                        <div style="justify-content: space-between;display: flex">
                            <button type="submit" class="btn btn-primary col-md-2">Filtrar</button>
                            <a href="/cadastros/usuarios/new" type="button" class="btn btn-success col-md-2">Novo</a>
                        </div>

                    </form>

                </div>
            </section>


            <section class="pt-5 mt-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    ID</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Username</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Nome</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Super Admin</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $url = URL;
                                            foreach ($this->Dados as $key => $index) {

                                                extract($index);

                                            ?>
                                                <tr>

                                                    <td>
                                                        <p class='text-xs font-weight-bold mb-0'> <?php echo $id; ?></p>
                                                    </td>

                                                    <td>
                                                        <p class='text-xs font-weight-bold mb-0'><?php echo $username ?></p>
                                                    </td>
                                                    <td>
                                                        <span class='badge badge-dot me-4'>

                                                            <span class='text-dark text-xs'> <?php echo $name ?></span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class='badge badge-dot me-4'>
                                                            <span class='text-dark text-xs'>
                                                                <?php echo $superAdmin ?></span>
                                                        </span>
                                                    </td>

                                                    <?php if ($superAdmin != '*') { ?>
                                                        <td class='align-middle'>
                                                            <a href='usuarios/edit?uuid=<?php echo $hash; ?>' class='btn btn-link text-secondary mb-0'>
                                                                <i class='fa fa-ellipsis-v text-xs'></i>
                                                            </a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
    }
</script>