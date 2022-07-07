<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-4">Editar livro</h1>
            <p  class="mb-4"><a href="<?= base_url('/') ?>">Voltar</a></p>
        </div>
        <div class="col">

    <form method="post" action="<?= base_url('/editar') ?>">

            <div class="input-group input-group-lg my-4">
                <span class="input-group-text btn btn-secondary" id="tk">Token</span>
                <input type="text" class="form-control border-secondary bg-light" aria-label="token" aria-describedby="tk" name="token" placeholder="Digite o token de autenticação">
            </div>
        </div>
    </div>

    <!-- form -->
        
        <input type="hidden" name="id" value="<?= $id ?>">

        <input type="text" name="titulo" placeholder="Título" class="form-control" value="<?= $titulo ?>">

        <input type="text" name="autor" placeholder="Autor" class="form-control my-2" value="<?= $autor ?>">

        <input type="number" name="isbn" placeholder="ISBN" class="form-control my-2" value="<?= $isbn ?>">
        
        <input type="number" name="paginas" placeholder="Número de páginas" class="form-control my-2" value="<?= $paginas ?>">

        <input type="number" name="ano" placeholder="ano" class="form-control my-2" value="<?= $ano ?>">
        
        <input type="submit" value="Atualizar" class="btn btn-success btn-lg w-100 my-2">

    </form>
</div>

<?= $this->endSection() ?>