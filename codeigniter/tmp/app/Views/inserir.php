<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>

<div class="container">
    <h1 class="mt-4">Inserir um novo livro</h1>
    <p  class="mb-4"><a href="<?= base_url('/') ?>">Voltar</a></p>

    <form method="post" action="<?= base_url('/inserir') ?>" >
        
        <input type="text" name="titulo" placeholder="Título" class="form-control">

        <input type="text" name="autor" placeholder="Autor" class="form-control my-2">

        <input type="number" name="isbn" placeholder="ISBN" class="form-control my-2">
        
        <input type="number" name="paginas" placeholder="Número de páginas" class="form-control my-2">

        <input type="number" name="ano" placeholder="ano" class="form-control my-2">
        
        <input type="submit" value="Cadastrar" class="btn btn-success btn-lg w-100 my-2">

    </form>
</div>

<?= $this->endSection() ?>