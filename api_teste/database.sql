create database teste;

use database teste;


create table produtos(

    id int(5) primary key not null auto_increment,
    nome varchar(50),
    estoque int(10),
    nota_fiscal tinyint(1)

);


insert into produtos (nome, estoque, nota_fiscal) values

    ('Produto 1', 3, 0),
    ('Produto 2', 15, 1),
    ('Produto 3', 8, 1),
    ('Produto 4', 100, 0),
    ('Produto 5', 60, 0)
    
;