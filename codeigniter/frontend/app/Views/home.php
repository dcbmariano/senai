<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>

<div class="container my-5">
<?php 
    $mensagem = session()->getFlashdata('mensagem'); 
    $tipo = session()->getFlashdata('tipo'); 

    if($mensagem != null){ ?>
        <div class="alert alert-<?= $tipo ?> alert-dismissible fade show" role="alert">
            <?= $mensagem ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php } ?>



    <div class="row">
        <div class="col">
            <h1 class="my-4"><a href="<?=base_url('/')?>" style="text-decoration:none" class="link-primary">Sistema de consulta de Livros</a></h1>
        </div>
        <div class="col my-3">

            <input type="text" class="form-control p-4" id="buscar" placeholder="Buscar por título" onkeydown="buscar(this)">

            <p class="text-end">

                <a href="<?= base_url('/inserir') ?>" class="me-3">Inserir</a>

                <a href="" data-bs-content="<b>PARA BUSCAR POR AUTOR, DIGITE:</b><br>autor:nome-do-autor <br><br> <b>POR ISBN</b> => isbn:123 <br><br> <b>POR ANO DE PUBLICAÇÃO</b> => ano:2000-2020" data-bs-toggle="popover" 
            data-bs-custom-class="custom-popover"
            title='<i class="bi bi-question-circle-fill"></i> AJUDA'id="ajuda">Busca avançada</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="<?= base_url("/pagina/1") ?>">Início</a>
        </div>
        <div class="col text-end">
            <a href="<?= base_url("/pagina/$fim") ?>">Fim</a>
        </div>
    </div>
    <table id="tabela" class="table table-hover table-striped ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Páginas</th>
                <th>Ano</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div class="row">
        <div class="col">
            <a href="<?= base_url("/pagina/$anterior") ?>">Anterior</a>
        </div>
        <div class="col text-end">
            <a href="<?= base_url("/pagina/$proxima") ?>">Próxima</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>