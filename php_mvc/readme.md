# PHP - PDO com MVC

Contém os códigos fonte dos exemplos construídos nas aulas de PHP com MVC e PDO. 

No banco de dados, foi utilizada uma base de dados chamada "teste". 

Comandos SQL:
~~~sql
create database teste;
use teste;
~~~

Além disso, foi utilizada uma tabela denominada "alunos":
~~~sql
 create table alunos(
     id int not null AUTO_INCREMENT, 
     nome varchar(255),
     PRIMARY KEY(id)
 )
~~~