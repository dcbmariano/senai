<?= $this->extend('template') ?>
<?= $this->section('conteudo') ?>

<div class="container">

    <p  class="my-4"><a href="<?= base_url('/') ?>">Voltar</a></p>
    <h1 class="mb-3">Deseja realmente deletar o item <?= $id ?>?</h1>

    <form action="<?= base_url('/deletar') ?>" method="post">
        <input type="hidden" value="<?= $id ?>" name="id" id="id">
        <input type="submit" value="Sim" class="btn btn-danger btn-lg">
        <a href="<?= base_url('/') ?>" class="btn btn-secondary btn-lg">Não</a>
    </form>
</div>
<?= $this->endSection() ?>