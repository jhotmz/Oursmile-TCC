create database db_oursmile;
use db_oursmile;

create table tb_user(
id int not null auto_increment primary key,
nm_email varchar(45),
nm_nome varchar(15),
nm_sobrenome varchar (15),
ds_senha varchar(8),
nm_local varchar(255),
nm_postagem varchar(255),
id_nivel int not null
);
	
create table tb_blog(
id int not null auto_increment primary key,
ds_img varchar(100),
nm_postagem varchar (255),
nm_desc varchar (255),
ds_conteudo text,
nm_autor varchar(255),
dt_data date,
data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


create table tb_clinica(
id int not null auto_increment primary key,
ds_img varchar(100),
nm_clinica varchar (30),
nr_telefone varchar(15),
nm_endereco varchar(30),
nm_rsocial varchar(30),
hr_funcionamento time,
data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tb_user(nm_email, nm_nome, nm_sobrenome, ds_senha, id_nivel) VALUES
('fa', 'fa', 'fa', '123', '2'),
('fe', 'fe', 'fe', '123', '1');







