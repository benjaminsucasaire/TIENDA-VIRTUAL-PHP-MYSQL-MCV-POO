-- creamos la base de datos
create DATABASE  tienda_master;
-- utilizamos la base de datos creada
use tienda_master;
create table usuarios(
id    int(255)  AUTO_INCREMENT   NOT NULL,  
nombre  VARCHAR(100) not null,
apellidos   varchar(255),
email       varchar(255) not null,
password    varchar(255) not null,
rol         varchar(20),
imagen      varchar(255),
constraint pk_usuarios primary key (id),
constraint uq_email unique (email)
)engine=InnoDB;

INSERT INTO usuarios VALUES(null,'admin','admin','admin@admin.com','12345678','admin',null);


CREATE TABLE categorias(
id    int(255)  AUTO_INCREMENT   NOT NULL,  
nombre  VARCHAR(100) not null,
constraint pk_categorias primary key (id)
)engine=InnoDB;

insert into categorias values(null,'Manga corta');
insert into categorias values(null,'Tirantes');
insert into categorias values(null,'Manga larga');
insert into categorias values(null,'Sudaderas');


create table productos(
id    int(255)  AUTO_INCREMENT   NOT NULL,
categoria_id   int(255) not null,
nombre  VARCHAR(100) not null,
descripcion   text,
precio      float(100,2) not null,
stock       int(255) not null,
oferta      varchar(2),
fecha       date not null,
imagen      varchar(255),  
constraint pk_productos primary key (id),
constraint  fk_producto_categoria foreign key (categoria_id) REFERENCES categorias(id)
)engine=InnoDB;


create table pedidos(
id    int(255)  AUTO_INCREMENT   NOT NULL,
usuario_id   int(255) not null,
provincia  VARCHAR(100) not null,
localidad varchar(100) not null,
direccion VARCHAR(255) not null,
coste     float(200,2) not null,
estado    varchar(20) not null,
fecha     DATE ,
hora      time,
constraint pk_pedidos primary key (id),
constraint  fk_pedidos_usuario foreign key (usuario_id) REFERENCES usuarios(id)
)engine=InnoDB;



create table lineas_pedidos(
  id    int(255)  AUTO_INCREMENT   NOT NULL,  
  pedido_id int(255) not null,
  producto_id int(255) not null,
  unidades int(255) not null,
   constraint pk_lineas_pedidos primary key (id),
   constraint fk_lineas_pedido foreign key (pedido_id) REFERENCES pedidos(id),
    constraint fk_lineas_producto foreign key (producto_id) REFERENCES productos(id)
)engine=InnoDB;


