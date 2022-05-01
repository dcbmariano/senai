<!doctype html>
<html>
    <head>
        <meta chaset="utf-8">
        <title>MVC com PHP</title>
    </head>
    <body>
        <!-- VIEW ALUNOS.PHP -->
        <form method="post" action="?metodo=inserir">
            <input type="text" name="nome" placeholder="Digite o nome do aluno">
            <input type="submit" name="enviar" value="Inserir">
        </form>

        <?php if(isset($_GET['metodo']) &&($_GET['metodo'] == 'editar')){ ?>
            <form method="post" action="?metodo=editar&id=<?=$id?>">
                <label>Editando id: <?=$id?></label>
                <input type="hidden" value="<?=$id?>" name="id">
                <input type="text" name="nome" placeholder="Digite 
                o nome do aluno" value="<?=$nome?>">
                <input type="submit" name="editar" value="Editar">
            </form>

        <?php } ?>

        <h1>Lista de alunos</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                foreach ($alunos as $aluno){ ?>
                    <tr>
                        <td><?= $aluno['id']; ?></td>
                        <td><?= $aluno['nome']; ?></td>
                        <td><a href="?metodo=deletar&id=<?= $aluno['id']; ?>">Deletar</a></td>
                        <td><a href="?metodo=editar&id=<?= $aluno['id']; ?>">Editar</a></td>
                    </tr>
                <?php } /*fim do foreach*/ ?>
            </tbody>
        </table>
    </body>
</html>
