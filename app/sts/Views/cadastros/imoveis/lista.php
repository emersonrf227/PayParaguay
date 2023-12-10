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
                    <li class="breadcrumb-item active" aria-current="page">Imóveis</li>
                </ol>
            </nav>

            <section class="pt-5 mt-5">
                <div class="card" style="padding:20px">
                    <form method="GET" action="#">
                        <div class="row" style="display:flex; flex-direction:row; justify-content: flex-start;">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name='viewDisabled'
                                        <?php if (!empty($_GET['viewDisabled'])) echo "checked"; ?> value="true"
                                        id="flexCheckCheckedDisabled">
                                    <label class="form-check-label" for="flexCheckCheckedDisabled">
                                        Mostrar itens desabilitados
                                    </label>
                                    <input class="form-check-input" type="checkbox" name='orderbyaZ'
                                        <?php if (!empty($_GET['orderbyaZ'])) echo "checked"; ?> value="true"
                                        id="flexCheckCheckedDisabled">
                                    <label class="form-check-label" for="flexCheckCheckedDisabled">
                                        Ordenar a-Z
                                    </label>
                                    <input class="form-check-input" type="checkbox" name='orderbyZa'
                                        <?php if (!empty($_GET['orderbyZa'])) echo "checked"; ?> value="true"
                                        id="flexCheckCheckedDisabled">
                                    <label class="form-check-label" for="flexCheckCheckedDisabled">
                                        Ordenar Z-a
                                    </label>

                                    <input class="form-check-input" type="checkbox" name='orderby09'
                                        <?php if (!empty($_GET['orderby09'])) echo "checked"; ?> value="true"
                                        id="flexCheckCheckedDisabled">
                                    <label class="form-check-label" for="flexCheckCheckedDisabled">
                                        Ordenar 0-9
                                    </label>

                                    <input class="form-check-input" type="checkbox" name='orderby90'
                                        <?php if (!empty($_GET['orderby90'])) echo "checked"; ?> value="true"
                                        id="flexCheckCheckedDisabled">
                                    <label class="form-check-label" for="flexCheckCheckedDisabled">
                                        Ordenar 9-0
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
                            <a href="/cadastros/imoveis/new" type="button" class="btn btn-success col-md-2">Novo</a>
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
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Projeto</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Quantidade</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Disponivel</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Square</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    R$ Cota</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Editar</th>


                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $url = URL;
                                            foreach ($this->Dados as $key => $index) {

                                                extract($index);

                                                echo "
                                            <tr>
                                                <td>
                                                    <div class='d-flex px-2'>
                                                        <div>
                                                            <img src='{$url}{$path}' class='avatar avatar-sm rounded-circle me-2'>
                                                        </div>
                                                        <div class='my-auto'>
                                                            <h6 class='mb-0 text-xs'>{$title}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class='text-xs font-weight-bold mb-0'>{$amount}</p>
                                                </td>

                                                <td>
                                                    <p class='text-xs font-weight-bold mb-0'>{$available}</p>
                                                </td>
                                                <td>
                                                    <span class='badge badge-dot me-4'>
                                                        <i class='bg-info'></i>
                                                        <span class='text-dark text-xs'>{$squareMeter}M2</span>
                                                    </span>
                                                </td>
                                            <td>
                                                <span class='badge badge-dot me-4'>
                                                    <i class='bg-info'></i>
                                                    <span class='text-dark text-xs'>{$value}M2</span>
                                                </span>
                                            </td>
                                                <td class='align-middle'>
                                                    <a href='imoveis/edit?uuid={$uuid}' class='btn btn-link text-secondary mb-0'>
                                                        <i class='fa fa-ellipsis-v text-xs'></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            ";
                                            } ?>


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