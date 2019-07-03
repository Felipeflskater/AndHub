/* 
*  DB Script Tool
*  MySQL - 2019-06-13 08:54:32
*  2018-11-03 18:08:34
*/ 
CREATE DATABASE IF NOT EXISTS `AndHub`
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE `AndHub`;



/* 
*  Marca
*  2018-11-03 18:08:44
*/ 
DROP TABLE IF EXISTS `Marca`;
CREATE TABLE IF NOT EXISTS `Marca` (
    `marca_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `site_marca` VARCHAR(50) COLLATE utf8_general_ci,
    `Nome` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `logo` VARCHAR(50) COLLATE utf8_general_ci,
 PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

CREATE UNIQUE INDEX `idx_Marca_marca_id` ON `Marca` (`marca_id`);
CREATE UNIQUE INDEX `idx_Marca_Nome` ON `Marca` (`Nome`);



/* 
*  ListaRoms
*  2018-11-03 18:09:20
*/ 
DROP TABLE IF EXISTS `ListaRoms`;
CREATE TABLE IF NOT EXISTS `ListaRoms` (
    `listaroms_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_Smartphone` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `link` VARCHAR(50) COLLATE utf8_general_ci,
    `id_rom` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `data` DATE,
    `versao` VARCHAR(10) COLLATE utf8_general_ci,
    `status` INTEGER(10),
    `tipo` INTEGER(10),
    `atualizacao` INTEGER(10),
 PRIMARY KEY (`listaroms_id`,`id_Smartphone`,`id_rom`),
/*CONSTRAINT fk_listaromsmatphone FOREIGN KEY (`id_Smartphone`) REFERENCES Smartphone(`smartphone_id`),*/ 
CONSTRAINT fk_listaromrelrom FOREIGN KEY (`id_rom`) REFERENCES Rom(`rom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Rom
*  2018-11-03 18:09:29
*/ 
DROP TABLE IF EXISTS `Rom`;
CREATE TABLE IF NOT EXISTS `Rom` (
    `rom_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `versao` VARCHAR(10) COLLATE utf8_general_ci,
    `romsite` VARCHAR(50) COLLATE utf8_general_ci,
    `Id_Sistema` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Codnome` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `RomGit` VARCHAR(50) COLLATE utf8_general_ci,
    `id_desenvolvedor` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `logo` INTEGER(30),
 PRIMARY KEY (`rom_id`,`Id_Sistema`,`id_desenvolvedor`),
/*CONSTRAINT fk_sistemarom FOREIGN KEY (`Id_Sistema`) REFERENCES Sistema(`sistema_id`),*/ 
/*CONSTRAINT fk_romdev FOREIGN KEY (`id_desenvolvedor`) REFERENCES Desenvolvedor(`desenvolvedor_id`),*/
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Sistema
*  2018-11-03 18:09:35
*/ 
DROP TABLE IF EXISTS `Sistema`;
CREATE TABLE IF NOT EXISTS `Sistema` (
    `sistema_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `versao` VARCHAR(20) COLLATE utf8_general_ci,
    `Codnome` VARCHAR(50) COLLATE utf8_general_ci,
    `nome` VARCHAR(50) COLLATE utf8_general_ci,
    `logo` INTEGER(50),
 PRIMARY KEY (`sistema_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Desenvolvedor
*  2018-11-03 18:09:41
*/ 
DROP TABLE IF EXISTS `Desenvolvedor`;
CREATE TABLE IF NOT EXISTS `Desenvolvedor` (
    `desenvolvedor_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `site` VARCHAR(50) COLLATE utf8_general_ci,
    `Descricao` TEXT(10),
    `Git` VARCHAR(10) COLLATE utf8_general_ci,
    `Nome` VARCHAR(10) COLLATE utf8_general_ci,
 PRIMARY KEY (`desenvolvedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Smartphone
*  2018-11-03 18:15:59
*/ 
DROP TABLE IF EXISTS `Smartphone`;
CREATE TABLE IF NOT EXISTS `Smartphone` (
    `smartphone_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_marca` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `modelo` VARCHAR(10) COLLATE utf8_general_ci NOT NULL,
    `codnome` VARCHAR(20) COLLATE utf8_general_ci,
    `CPU` VARCHAR(50) COLLATE utf8_general_ci,
    `GPU` VARCHAR(50) COLLATE utf8_general_ci,
    `Ram` VARCHAR(10) COLLATE utf8_general_ci,
    `Armazenamento` VARCHAR(10) COLLATE utf8_general_ci,
    `Chipset` VARCHAR(50) COLLATE utf8_general_ci,
    `Display` VARCHAR(50) COLLATE utf8_general_ci,
    `Rede` VARCHAR(10) COLLATE utf8_general_ci,
    `imagem` INTEGER(50),
    `nome` VARCHAR(50) COLLATE utf8_general_ci,
 PRIMARY KEY (`smartphone_id`,`id_marca`),
/*CONSTRAINT fk_marcasmartphone FOREIGN KEY (`id_marca`) REFERENCES Marca(`marca_id`),*/
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

CREATE UNIQUE INDEX `idx_Smartphone_smartphone_id` ON `Smartphone` (`smartphone_id`);
CREATE UNIQUE INDEX `idx_Smartphone_modelo` ON `Smartphone` (`modelo`);



/* 
*  Usuario
*  2018-11-03 20:24:37
*/ 
DROP TABLE IF EXISTS `Usuario`;
CREATE TABLE IF NOT EXISTS `Usuario` (
    `usuario_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Nome` VARCHAR(50) COLLATE utf8_general_ci,
    `Sobrenome` VARCHAR(50) COLLATE utf8_general_ci,
    `login` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `senha` VARCHAR(15) COLLATE utf8_general_ci NOT NULL,
    `email` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
    `ID_tipousuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ativo` TINYINT(1) DEFAULT 'TRUE' NOT NULL,
    `foto` INTEGER(30),
 PRIMARY KEY (`usuario_id`,`ID_tipousuario`),
/*CONSTRAINT fk_usuariotipo FOREIGN KEY (`ID_tipousuario`) REFERENCES TipoUsuario(`tipousuario_id`),*/
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

CREATE UNIQUE INDEX `idx_Usuario_login` ON `Usuario` (`login`);



/* 
*  TipoUsuario
*  2018-11-03 20:28:00
*/ 
DROP TABLE IF EXISTS `TipoUsuario`;
CREATE TABLE IF NOT EXISTS `TipoUsuario` (
    `tipousuario_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `funcao` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
 PRIMARY KEY (`tipousuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

CREATE UNIQUE INDEX `idx_TipoUsuario_funcao` ON `TipoUsuario` (`funcao`);



/* 
*  Permissao
*  2018-11-03 20:32:29
*/ 
DROP TABLE IF EXISTS `Permissao`;
CREATE TABLE IF NOT EXISTS `Permissao` (
    `permissao_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `permitido` CHAR(1) COLLATE utf8_general_ci DEFAULT '0' NOT NULL,
    `descricao` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
 PRIMARY KEY (`permissao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Mensagem
*  2018-12-01 22:38:22
*/ 
DROP TABLE IF EXISTS `Mensagem`;
CREATE TABLE IF NOT EXISTS `Mensagem` (
    `mensagem_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_corpo` INTEGER(10),
    `id_titulo` INTEGER(10),
    `tipo_conteudo` INTEGER(10),
    `vinculo` INTEGER(10),
    `id_usuario` INTEGER(10) NOT NULL,
    `data` DATE NOT NULL,
 PRIMARY KEY (`mensagem_id`,`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Corpo
*  2018-12-01 22:43:05
*/ 
DROP TABLE IF EXISTS `Corpo`;
CREATE TABLE IF NOT EXISTS `Corpo` (
    `corpo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_mensagem` INTEGER(10) NOT NULL,
    `mensagem` TEXT(10),
 PRIMARY KEY (`corpo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Titulo
*  2018-12-01 22:45:57
*/ 
DROP TABLE IF EXISTS `Titulo`;
CREATE TABLE IF NOT EXISTS `Titulo` (
    `titulo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(60) COLLATE utf8_general_ci,
    `id_mensagem` INTEGER(10) NOT NULL,
 PRIMARY KEY (`titulo_id`,`id_mensagem`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;

CREATE UNIQUE INDEX `idx_Titulo_id_mensagem` ON `Titulo` (`id_mensagem`);



/* 
*  TipoConteudo
*  2018-12-02 00:08:10
*/ 
DROP TABLE IF EXISTS `TipoConteudo`;
CREATE TABLE IF NOT EXISTS `TipoConteudo` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(30) COLLATE utf8_general_ci,
    `descricao` VARCHAR(30) COLLATE utf8_general_ci,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;



/* 
*  Arquivos
*  2018-12-02 00:10:56
*/ 
DROP TABLE IF EXISTS `Arquivos`;
CREATE TABLE IF NOT EXISTS `Arquivos` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `id_tipo` INTEGER(10) NOT NULL,
    `caminho` VARCHAR(30) COLLATE utf8_general_ci,
    `modulo` INTEGER(10) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1 ;