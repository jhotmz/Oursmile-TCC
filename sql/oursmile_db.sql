create database db_oursmile
default character set utf8mb4
default collate utf8mb4_general_ci;
use db_oursmile;
	
create table tb_usuario(
id int not null auto_increment primary key,
ds_foto varchar(255),
nm_email varchar(45) unique key,
nm_nome varchar(255),
nm_sobrenome varchar (255),
nr_cpf int,
nr_cro int,
ds_senha varchar(8) not null, 
id_nivel int
);

create table tb_blog(
id_post int not null auto_increment primary key,
ds_img blob,
nm_postagem varchar (255),
nm_desc varchar (255),
ds_conteudo text,
nm_autor varchar(255),
dt_data date,
id_categoria int,
data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table tb_acesso(
id int auto_increment primary key not null,
dt_acesso datetime,
ds_navegador longtext,
ip varchar(15),
id_usuario int, 
id_post int not null 
);

create table tb_clinica(
id int not null auto_increment primary key,
ds_img varchar(100),
nm_clinica varchar (30),
nr_telefone varchar(15),
nm_endereco varchar(30),
nm_rsocial varchar(30),
hr_funcionamento time,
id_dentista int,
data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

<<<<<<< HEAD
create table tb_tratamentos(
id_tratamento int auto_increment not null primary key,
nm_tratamento varchar(255),
id_clinica int,
CONSTRAINT fk_tratamento_clinica FOREIGN KEY (id_clinica) REFERENCES tb_clinica (id) ON DELETE CASCADE ON UPDATE NO ACTION
);

=======
>>>>>>> 062bf8f3c6ddaa441a903d8b3298485d3acad101
create table tb_categoria(
id int auto_increment primary key,
nm_categoria varchar(255)
);

create table tb_favorito(
id int auto_increment primary key,
user_id int,
pub_id int,
clinica_id int,
CONSTRAINT fk_favorite_usuario FOREIGN KEY (user_id) REFERENCES tb_usuario (id) ON DELETE CASCADE ON UPDATE NO ACTION,
CONSTRAINT fk_favorite_post FOREIGN KEY (pub_id) REFERENCES tb_blog (id_post) ON DELETE CASCADE ON UPDATE NO ACTION,
CONSTRAINT fk_favorite_clinica FOREIGN KEY (clinica_id) REFERENCES tb_clinica (id) ON DELETE CASCADE ON UPDATE NO ACTION	
);

create table tb_avaliacao(
id int primary key auto_increment,
vl_nota int not null,
ds_mensagem varchar(255),
dt_criacao datetime,
<<<<<<< HEAD
nm_autor varchar(255),
=======
>>>>>>> 062bf8f3c6ddaa441a903d8b3298485d3acad101
id_clinica int,
CONSTRAINT fk_avaliacao_usuario FOREIGN KEY (id_clinica) REFERENCES tb_clinica (id) ON DELETE CASCADE ON UPDATE NO ACTION
);


alter table tb_clinica add
foreign key fk_id_dentista (id_dentista)
references tb_dentista (id_dentista);

alter table tb_acesso add
foreign key fk_id_user (id_usuario)
references tb_usuario (id);

alter table tb_blog add
foreign key fk_id_categoria (id_categoria)
references tb_categoria (id);

INSERT INTO tb_usuario (nm_nome, nm_sobrenome, nm_email, ds_senha, id_nivel)
<<<<<<< HEAD
VALUES ('jonas', 'tomatao', 'chefe@gmail.com', '123', '2');	
=======
VALUES ('jonas', 'tomatao', 'chefe@gmail.com', '123', '2');
>>>>>>> 062bf8f3c6ddaa441a903d8b3298485d3acad101

