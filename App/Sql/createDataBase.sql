CREATE SCHEMA appLista;

CREATE  TABLE appLista.categorias ( 
	cat_id               BIGINT UNSIGNED NOT NULL    PRIMARY KEY,
	cat_nome             VARCHAR(255)  NOT NULL    ,
	cat_descricao        VARCHAR(255)      ,
	cat_padrao           TINYINT   DEFAULT (false)   
 ) ENGINE=InnoDB;

CREATE  TABLE appLista.itens_pedido ( 
	itep_id              BIGINT UNSIGNED NOT NULL    PRIMARY KEY,
	ped_id               BIGINT UNSIGNED     ,
	prod_id              BIGINT UNSIGNED     ,
	itep_quantidade      FLOAT   DEFAULT (1)   ,
	itep_valor_total     FLOAT      
 ) engine=InnoDB;

CREATE  TABLE appLista.loja ( 
	loj_id               BIGINT UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	nome                 VARCHAR(200)  NOT NULL    
 ) engine=InnoDB;

CREATE  TABLE appLista.marca ( 
	mar_id               BIGINT UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	mar_nome             VARCHAR(200)  NOT NULL    ,
	mar_padrao           TINYINT   DEFAULT (false)   
 ) engine=InnoDB;

CREATE  TABLE appLista.status ( 
	sta_id               BIGINT UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	sta_sigla            CHAR(10)      ,
	sta_name             VARCHAR(100)  NOT NULL    
 ) engine=InnoDB;

CREATE  TABLE appLista.unidade_medida ( 
	uni_id               BIGINT UNSIGNED NOT NULL    PRIMARY KEY,
	uni_sigla            VARCHAR(10)  NOT NULL    ,
	uni_nome             VARCHAR(100)  NOT NULL    ,
	uni_padrao           TINYINT   DEFAULT (false)   
 ) ENGINE=InnoDB;

CREATE  TABLE appLista.usuario_tipo ( 
	usut_id              BIGINT UNSIGNED NOT NULL    PRIMARY KEY,
	usut_nome            VARCHAR(100)      ,
	usut_siglar          VARCHAR(10)      
 ) ENGINE=InnoDB ;

CREATE  TABLE appLista.usuarios ( 
	usu_id               BIGINT UNSIGNED NOT NULL    PRIMARY KEY,
	usu_name             VARCHAR(20)      ,
	usu_email            VARCHAR(200)  NOT NULL    ,
	usu_password         VARCHAR(50)  NOT NULL    ,
	usu_token_recuperar_senha VARCHAR(20)      ,
	
 ) ENGINE=InnoDB;

CREATE INDEX fk_usuario_status ON appLista.usuarios ( sta_id );

CREATE INDEX fk_usuarios_usuario_tipo ON appLista.usuarios ( usut_id );

CREATE  TABLE appLista.pedido ( 
	ped_id               BIGINT UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	ped_nome             VARCHAR(200)  NOT NULL    ,
	ped_public           TINYINT   DEFAULT (false)   ,
	ped_slug             TEXT      ,
	ped_data_finalizacao DATETIME      ,
	ped_data_abetura     TIMESTAMP      ,
	sta_id               BIGINT UNSIGNED     ,
	loj_id               BIGINT UNSIGNED     ,
	usu_id               BIGINT UNSIGNED     ,
	itep_id              BIGINT UNSIGNED     ,
	CONSTRAINT fk_pedido_status FOREIGN KEY ( sta_id ) REFERENCES appLista.status( sta_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_pedido_loja FOREIGN KEY ( loj_id ) REFERENCES appLista.loja( loj_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_pedido_itens_pedido FOREIGN KEY ( itep_id ) REFERENCES appLista.itens_pedido( itep_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_pedido_usuario FOREIGN KEY ( usu_id ) REFERENCES appLista.usuarios( usu_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE INDEX fk_pedido_status ON appLista.pedido ( sta_id );

CREATE INDEX fk_pedido_loja ON appLista.pedido ( loj_id );

CREATE INDEX fk_pedido_usuario ON appLista.pedido ( usu_id );

CREATE INDEX fk_pedido_itens_pedido ON appLista.pedido ( itep_id );

CREATE  TABLE appLista.produto ( 
	prod_id              BIGINT UNSIGNED NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	prod_nome            TEXT  NOT NULL    ,
	prod_preco           VARCHAR(50)      ,
	cat_id               BIGINT UNSIGNED     ,
	uni_id               BIGINT UNSIGNED     ,
	mar_id               BIGINT UNSIGNED     ,
	itep_id              BIGINT UNSIGNED     ,
	CONSTRAINT fk_produto_categorias FOREIGN KEY ( cat_id ) REFERENCES appLista.categorias( cat_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_produto_unidade_medida FOREIGN KEY ( uni_id ) REFERENCES appLista.unidade_medida( uni_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_produto_marca FOREIGN KEY ( mar_id ) REFERENCES appLista.marca( mar_id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT fk_produto_itens_pedido FOREIGN KEY ( itep_id ) REFERENCES appLista.itens_pedido( itep_id ) ON DELETE NO ACTION ON UPDATE NO ACTION
 ) engine=InnoDB;

CREATE INDEX fk_produto_categorias ON appLista.produto ( cat_id );

CREATE INDEX fk_produto_unidade_medida ON appLista.produto ( uni_id );

CREATE INDEX fk_produto_marca ON appLista.produto ( mar_id );

CREATE INDEX fk_produto_itens_pedido ON appLista.produto ( itep_id );
