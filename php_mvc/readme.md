# PHP - PDO com MVC

Contém os códigos fonte dos exemplos construídos nas aulas de PHP com MVC e PDO. 

No banco de dados, foi utilizada uma base de dados chamada "teste". 

Comandos SQL:
ˋˋˋ
create database teste;
use teste;
ˋˋˋ

Além disso, foi utilizada uma tabela denominada "alunos":
ˋˋˋ
 create table alunos(
     id int not null AUTO_INCREMENT, 
     nome varchar(255),
     PRIMARY KEY(id)
 )
ˋˋˋ