-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema yii2saramago
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema yii2saramago
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `yii2saramago` DEFAULT CHARACTER SET utf8 ;
USE `yii2saramago` ;

-- -----------------------------------------------------
-- Table `yii2saramago`.`Analitico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Analitico` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primaria',
  `titulo` TEXT NOT NULL COMMENT 'Título do analítico ',
  `paginas` INT NOT NULL COMMENT 'Número de páginas',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Autor` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `primeiroNome` VARCHAR(255) NOT NULL COMMENT 'Primeiro Nome',
  `segundoNome` VARCHAR(255) NULL COMMENT 'Segundo Nome',
  `apelido` VARCHAR(255) NULL COMMENT 'Apelido',
  `tipo` ENUM('individual', 'coletivo') NOT NULL COMMENT 'Tipo de autor',
  `bibliografia` MEDIUMTEXT NULL DEFAULT NULL COMMENT 'Bibliografia do autor',
  `dataNasc` DATE NULL DEFAULT NULL COMMENT 'Data de Nascimento',
  `nacionalidade` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Nacionalidade',
  `orcid` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Open Researcher and Contributor ID',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `orcid_UNIQUE` (`orcid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Biblioteca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Biblioteca` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `codBiblioteca` VARCHAR(5) NOT NULL COMMENT 'Código/Sigla da biblioteca',
  `nome` VARCHAR(255) NOT NULL COMMENT 'Nome da biblioteca',
  `notasOpac` MEDIUMTEXT NULL DEFAULT NULL COMMENT 'Nota para o OPAC',
  `morada` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Morada da biblioteca',
  `localidade` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Localidade da biblioteca',
  `codPostal` INT(7) NULL DEFAULT NULL COMMENT 'Código Postal',
  `levantamento` TINYINT NOT NULL DEFAULT 1 COMMENT 'Permissão para levantamento na biblioteca',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `codBiblioteca_UNIQUE` (`codBiblioteca` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Cdu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Cdu` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `codCdu` VARCHAR(255) NOT NULL COMMENT 'Código do Classificação Decimal Universal',
  `designacao` MEDIUMTEXT NULL COMMENT 'Designação',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`EstatutoExemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`EstatutoExemplar` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `estatuto` VARCHAR(255) NOT NULL COMMENT 'Designação do estatuto do exemplar',
  `prazo` INT NOT NULL COMMENT 'Dias do prazo de empréstimo',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`TipoExemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`TipoExemplar` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `designacao` VARCHAR(255) NOT NULL COMMENT 'Designação do tipo de exemplar',
  `tipo` ENUM('materialAv', 'monografia', 'pubPeriodica') NOT NULL COMMENT 'Grupo característico do tipo de exemplar',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Colecao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Colecao` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `tituloColecao` VARCHAR(255) NOT NULL COMMENT 'Titulo da coleção',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Obra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Obra` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `imgCapa` VARCHAR(255) NULL COMMENT 'Imagem da Capa',
  `titulo` VARCHAR(45) NOT NULL COMMENT 'Titulo da obra',
  `resumo` MEDIUMTEXT NULL COMMENT 'Resumo da obra',
  `editor` VARCHAR(255) NOT NULL COMMENT 'Editor',
  `ano` YEAR(4) NOT NULL COMMENT 'Ano',
  `tipoObra` ENUM('materialAv', 'monografia', 'pubPeriodica') NOT NULL COMMENT 'Tipo de obra',
  `descricao` VARCHAR(255) NOT NULL COMMENT 'Descrição da Obra',
  `local` VARCHAR(45) NULL COMMENT 'Local',
  `edicao` VARCHAR(45) NULL COMMENT 'Edição',
  `assuntos` VARCHAR(255) NULL COMMENT 'Assuntos',
  `preco` FLOAT(7,2) NULL COMMENT 'Preço (€)',
  `dataRegisto` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data registado',
  `dataAtualizado` DATETIME NULL COMMENT 'Data atualizado',
  `Cdu_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `Colecao_id` INT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_Obra_Cdu1_idx` (`Cdu_id` ASC),
  INDEX `fk_Obra_Colecao1_idx` (`Colecao_id` ASC),
  CONSTRAINT `fk_Obra_Cdu1`
    FOREIGN KEY (`Cdu_id`)
    REFERENCES `yii2saramago`.`Cdu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Obra_Colecao1`
    FOREIGN KEY (`Colecao_id`)
    REFERENCES `yii2saramago`.`Colecao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Exemplar` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `cota` VARCHAR(45) NOT NULL COMMENT 'Cota',
  `codBarras` VARCHAR(45) NOT NULL COMMENT 'Código de Barras',
  `suplemento` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Exemplar suplemento da obra',
  `estado` ENUM('arrumacao', 'estante', 'quarentena', 'perdido', 'reservado', 'nd') NOT NULL COMMENT 'Estado do exemplar',
  `notaInterna` VARCHAR(45) NULL COMMENT 'Nota interna referente ao exemplar',
  `Biblioteca_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `EstatutoExemplar_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `TipoExemplar_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `Obra_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Exemplar_Biblioteca1_idx` (`Biblioteca_id` ASC),
  INDEX `fk_Exemplar_EstatutoExemplar1_idx` (`EstatutoExemplar_id` ASC),
  INDEX `fk_Exemplar_TipoExemplar1_idx` (`TipoExemplar_id` ASC),
  INDEX `fk_Exemplar_Obra1_idx` (`Obra_id` ASC),
  UNIQUE INDEX `codBarras_UNIQUE` (`codBarras` ASC),
  CONSTRAINT `fk_Exemplar_Biblioteca1`
    FOREIGN KEY (`Biblioteca_id`)
    REFERENCES `yii2saramago`.`Biblioteca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Exemplar_EstatutoExemplar1`
    FOREIGN KEY (`EstatutoExemplar_id`)
    REFERENCES `yii2saramago`.`EstatutoExemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Exemplar_TipoExemplar1`
    FOREIGN KEY (`TipoExemplar_id`)
    REFERENCES `yii2saramago`.`TipoExemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Exemplar_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`TipoLeitor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`TipoLeitor` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `estatuto` VARCHAR(255) NOT NULL COMMENT 'Estatuto do leitor',
  `tipo` ENUM('aluno', 'docente', 'funcionario', 'externo') NOT NULL COMMENT 'Tipo de leitor',
  `nItens` INT NOT NULL DEFAULT 5 COMMENT 'Quantidade de exemplares requisitáveis em sua posse',
  `prazoDias` INT NOT NULL DEFAULT 10 COMMENT 'Duração do empréstimo (em dias)',
  `registoOpac` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Permissão para registo via Opac',
  `notas` VARCHAR(255) NULL COMMENT 'Notas',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Leitor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Leitor` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `codBarras` VARCHAR(255) NOT NULL COMMENT 'Código de barras do leitor',
  `nome` VARCHAR(255) NOT NULL COMMENT 'Nome do Leitor',
  `nif` INT(9) NOT NULL COMMENT 'NIF/NIPC',
  `docId` VARCHAR(45) NULL COMMENT 'Nº do Documento de Identificação',
  `dataNasc` DATE NOT NULL COMMENT 'Data de Nascimento',
  `morada` VARCHAR(255) NOT NULL COMMENT 'Morada',
  `localidade` VARCHAR(255) NOT NULL COMMENT 'Localidade',
  `codPostal` INT(7) NOT NULL COMMENT 'Código Postal',
  `telemovel` INT(15) NOT NULL COMMENT 'Telemóvel',
  `telefone` INT(15) NULL COMMENT 'Telefone',
  `mail2` VARCHAR(45) NULL COMMENT 'E-mail (2)',
  `notaInterna` VARCHAR(45) NULL COMMENT 'Nota interna referente ao leitor',
  `dataRegisto` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data registado',
  `dataAtualizado` DATETIME NULL COMMENT 'Data atualizado',
  `Biblioteca_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `TipoLeitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `codBarras_UNIQUE` (`codBarras` ASC),
  UNIQUE INDEX `nif_UNIQUE` (`nif` ASC),
  UNIQUE INDEX `docId_UNIQUE` (`docId` ASC),
  INDEX `fk_Leitor_Biblioteca_idx` (`Biblioteca_id` ASC),
  INDEX `fk_Leitor_TipoLeitor1_idx` (`TipoLeitor_id` ASC),
  CONSTRAINT `fk_Leitor_Biblioteca`
    FOREIGN KEY (`Biblioteca_id`)
    REFERENCES `yii2saramago`.`Biblioteca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Leitor_TipoLeitor1`
    FOREIGN KEY (`TipoLeitor_id`)
    REFERENCES `yii2saramago`.`TipoLeitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Funcionario` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `departamento` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Departamento do funcionário',
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_Funcionario_Leitor1_idx` (`Leitor_id` ASC),
  CONSTRAINT `fk_Funcionario_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`LeituraRecomendada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`LeituraRecomendada` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `dataInicial` DATE NOT NULL COMMENT 'Data de inicio',
  `dataFinal` DATE NULL DEFAULT NULL COMMENT 'Data de termino',
  `Funcionario_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `Obra_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_LeituraRecomendada_Funcionario1_idx` (`Funcionario_id` ASC),
  INDEX `fk_LeituraRecomendada_Obra1_idx` (`Obra_id` ASC),
  CONSTRAINT `fk_LeituraRecomendada_Funcionario1`
    FOREIGN KEY (`Funcionario_id`)
    REFERENCES `yii2saramago`.`Funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LeituraRecomendada_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`MaterialAv`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`MaterialAv` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `duracao` VARCHAR(45) NOT NULL COMMENT 'Duração (min)',
  `ean` INT(13) NOT NULL COMMENT 'Código de Barras EAN-13',
  `Obra_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_MaterialAv_Obra1_idx` (`Obra_id` ASC),
  CONSTRAINT `fk_MaterialAv_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Monografia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Monografia` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `volume` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Número do Volume',
  `paginas` INT NOT NULL COMMENT 'Numero de páginas',
  `isbn` INT NOT NULL COMMENT 'International Standard Book Number (ISBN-10/ISBN-13)',
  `Obra_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_Monografia_Obra1_idx` (`Obra_id` ASC),
  CONSTRAINT `fk_Monografia_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Noticias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Noticias` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `interface` ENUM('opac', 'Interna', 'todas') NOT NULL COMMENT 'Interface onde será apresentada',
  `dataVisivel` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data visível',
  `dataExpiracao` DATETIME NULL COMMENT 'Data da expiração',
  `autor` VARCHAR(255) NOT NULL COMMENT 'Autor',
  `conteudo` LONGTEXT NOT NULL COMMENT 'Conteúdo',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`PostoTrabalho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`PostoTrabalho` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `designacao` VARCHAR(255) NOT NULL COMMENT 'Designação do Posto de Trabalho',
  `totalLugares` INT NOT NULL COMMENT 'Total de lugares',
  `notaOpac` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Informação para o OPAC',
  `notaInterna` VARCHAR(2555) NULL DEFAULT NULL COMMENT 'Informação interna',
  `Biblioteca_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_PostoTrabalho_Biblioteca1_idx` (`Biblioteca_id` ASC),
  CONSTRAINT `fk_PostoTrabalho_Biblioteca1`
    FOREIGN KEY (`Biblioteca_id`)
    REFERENCES `yii2saramago`.`Biblioteca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Reprografia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Reprografia` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `dataPedido` DATETIME NOT NULL COMMENT 'Data do pedido',
  `dataConcluido` DATETIME NULL DEFAULT NULL COMMENT 'Data da conclusão',
  `paginas` VARCHAR(255) NOT NULL COMMENT 'Numero das Páginas',
  `cor` ENUM('Cores', 'Preto e Branco') NOT NULL COMMENT 'Cor da impressão',
  `copias` INT NULL DEFAULT 1 COMMENT 'Número de Cópias',
  `frenteVerso` TINYINT NULL DEFAULT 1 COMMENT 'Escolha do frente e verso',
  `estado` ENUM('aguarda', 'processamento', 'levatamento', 'concluido', 'cancelado') NULL DEFAULT NULL COMMENT 'Estado do pedido',
  `notaOpac` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Nota para OPAC',
  `notaInterna` VARCHAR(255) NULL COMMENT 'Nota Interna',
  `operador` VARCHAR(255) NOT NULL COMMENT 'Operador',
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `Obra_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_Reprografia_Leitor1_idx` (`Leitor_id` ASC),
  INDEX `fk_Reprografia_Obra1_idx` (`Obra_id` ASC),
  CONSTRAINT `fk_Reprografia_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reprografia_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Requisicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Requisicao` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `dataEmprestimo` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de empréstimo',
  `entregaPrevista` DATE NOT NULL COMMENT 'Data prevista para entrega',
  `dataDevolucao` DATETIME NULL DEFAULT NULL COMMENT 'Data de devolução',
  `Renovacoes` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Renovações realizadas',
  `Leitor_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Requisicao_Leitor1_idx` (`Leitor_id` ASC),
  CONSTRAINT `fk_Requisicao_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Reserva` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `dataReserva` DATETIME NULL DEFAULT NULL COMMENT 'Data da reserva',
  `estadoReserva` ENUM('reservado', 'cancelado', 'concluido') NULL DEFAULT 'reservado' COMMENT 'Estado da reserva',
  `dataFecho` DATETIME NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de fecho',
  `notaReserva` MEDIUMTEXT NULL DEFAULT NULL COMMENT 'Nota da reserva',
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeiro',
  `Exemplar_id` INT NOT NULL COMMENT 'Chave estrangeiro',
  PRIMARY KEY (`id`),
  INDEX `fk_Reserva_Leitor1_idx` (`Leitor_id` ASC),
  INDEX `fk_Reserva_Exemplar1_idx` (`Exemplar_id` ASC),
  CONSTRAINT `fk_Reserva_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reserva_Exemplar1`
    FOREIGN KEY (`Exemplar_id`)
    REFERENCES `yii2saramago`.`Exemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`ReservasPosto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`ReservasPosto` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `dataPedido` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data do pedido',
  `dataReserva` DATETIME NOT NULL COMMENT 'Data para reserva',
  `lugar` INT NOT NULL COMMENT 'Lugar referente',
  `notaOpac` MEDIUMTEXT NULL COMMENT 'Nota do Opac',
  `notaInterna` MEDIUMTEXT NULL COMMENT 'Nota interna',
  `estadoReserva` ENUM('reservado', 'concluido', 'cancelado') NULL DEFAULT 'reservado' COMMENT 'Estado referente a reserva',
  `operador` VARCHAR(255) NOT NULL,
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `PostoTrabalho_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_ReservasPosto_Leitor1_idx` (`Leitor_id` ASC),
  INDEX `fk_ReservasPosto_PostoTrabalho1_idx` (`PostoTrabalho_id` ASC),
  CONSTRAINT `fk_ReservasPosto_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ReservasPosto_PostoTrabalho1`
    FOREIGN KEY (`PostoTrabalho_id`)
    REFERENCES `yii2saramago`.`PostoTrabalho` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`SugestaoAquisicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`SugestaoAquisicao` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `Obra_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_SugestaoAquisicao_Leitor1_idx` (`Leitor_id` ASC),
  INDEX `fk_SugestaoAquisicao_Obra1_idx` (`Obra_id` ASC),
  CONSTRAINT `fk_SugestaoAquisicao_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SugestaoAquisicao_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`TipoIrregularidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`TipoIrregularidade` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `irregularidade` VARCHAR(255) NOT NULL COMMENT 'Tipo de obra entregue',
  `diasBloqueio` INT NOT NULL DEFAULT 30 COMMENT 'Duração do bloqueio (em dias)',
  `diasAtivacao` INT NOT NULL DEFAULT 7 COMMENT 'Ativação do bloqueio (em dias)',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Uc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Uc` (
  `id` INT NOT NULL,
  `designacao` VARCHAR(255) NOT NULL COMMENT 'Unidade curricular',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `CodCurso` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Aluno` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `numero` INT NOT NULL COMMENT 'Número do aluno',
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `Curso_id` INT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_Aluno_Curso1_idx` (`Curso_id` ASC),
  INDEX `fk_Aluno_Leitor1_idx` (`Leitor_id` ASC),
  CONSTRAINT `fk_Aluno_Curso1`
    FOREIGN KEY (`Curso_id`)
    REFERENCES `yii2saramago`.`Curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aluno_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'Aluno';


-- -----------------------------------------------------
-- Table `yii2saramago`.`Config`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Config` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `info` VARCHAR(255) NULL,
  `key` VARCHAR(255) NULL,
  `value` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`ConsultaTReal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`ConsultaTReal` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `dataHoraInicial` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e hora inicial',
  `dataHoraFinal` DATETIME NULL COMMENT 'Data e hora de término',
  `operador` VARCHAR(255) NOT NULL COMMENT 'Operador',
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `Exemplar_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_ConsultaTReal_Leitor1_idx` (`Leitor_id` ASC),
  INDEX `fk_ConsultaTReal_Exemplar1_idx` (`Exemplar_id` ASC),
  CONSTRAINT `fk_ConsultaTReal_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ConsultaTReal_Exemplar1`
    FOREIGN KEY (`Exemplar_id`)
    REFERENCES `yii2saramago`.`Exemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Fundo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Fundo` (
  `id` INT NOT NULL COMMENT 'Chave primária',
  `designacao` VARCHAR(255) NOT NULL,
  `Exemplar_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_Fundo_Exemplar1_idx` (`Exemplar_id` ASC),
  CONSTRAINT `fk_Fundo_Exemplar1`
    FOREIGN KEY (`Exemplar_id`)
    REFERENCES `yii2saramago`.`Exemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Irregularidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Irregularidade` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `dataInicial` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data inicial do bloqueio',
  `dataFinal` DATE NOT NULL COMMENT 'Data final do bloqueio',
  `Leitor_id` INT NOT NULL COMMENT 'Chave estrangeira',
  `TipoIrregularidade_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Irregularidade_Leitor1_idx` (`Leitor_id` ASC),
  INDEX `fk_Irregularidade_TipoIrregularidade1_idx` (`TipoIrregularidade_id` ASC),
  CONSTRAINT `fk_Irregularidade_Leitor1`
    FOREIGN KEY (`Leitor_id`)
    REFERENCES `yii2saramago`.`Leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Irregularidade_TipoIrregularidade1`
    FOREIGN KEY (`TipoIrregularidade_id`)
    REFERENCES `yii2saramago`.`TipoIrregularidade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`PubPeriodica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`PubPeriodica` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `volume` VARCHAR(45) NULL COMMENT 'Volume',
  `serie` VARCHAR(45) NULL COMMENT 'Série',
  `numero` INT NOT NULL COMMENT 'Número',
  `ISSN` INT(8) NOT NULL COMMENT 'International Standard Serial Number',
  `Obra_id` INT NOT NULL COMMENT 'Chave estrangeira',
  PRIMARY KEY (`id`),
  INDEX `fk_PubPeriodica_Obra1_idx` (`Obra_id` ASC),
  CONSTRAINT `fk_PubPeriodica_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Analitico_Obra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Analitico_Obra` (
  `Analitico_id` INT NOT NULL,
  `Obra_id` INT NOT NULL,
  PRIMARY KEY (`Analitico_id`, `Obra_id`),
  INDEX `fk_Analitico_has_Obra_Obra1_idx` (`Obra_id` ASC),
  INDEX `fk_Analitico_has_Obra_Analitico1_idx` (`Analitico_id` ASC),
  CONSTRAINT `fk_Analitico_has_Obra_Analitico1`
    FOREIGN KEY (`Analitico_id`)
    REFERENCES `yii2saramago`.`Analitico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Analitico_has_Obra_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Curso_Uc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Curso_Uc` (
  `Curso_id` INT NOT NULL,
  `Uc_id` INT NOT NULL,
  PRIMARY KEY (`Curso_id`, `Uc_id`),
  INDEX `fk_Curso_has_Uc_Uc1_idx` (`Uc_id` ASC),
  INDEX `fk_Curso_has_Uc_Curso1_idx` (`Curso_id` ASC),
  CONSTRAINT `fk_Curso_has_Uc_Curso1`
    FOREIGN KEY (`Curso_id`)
    REFERENCES `yii2saramago`.`Curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Curso_has_Uc_Uc1`
    FOREIGN KEY (`Uc_id`)
    REFERENCES `yii2saramago`.`Uc` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Obra_Autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Obra_Autor` (
  `Obra_id` INT NOT NULL,
  `Autor_id` INT NOT NULL,
  PRIMARY KEY (`Obra_id`, `Autor_id`),
  INDEX `fk_Obra_has_Autor_Autor1_idx` (`Autor_id` ASC),
  INDEX `fk_Obra_has_Autor_Obra1_idx` (`Obra_id` ASC),
  CONSTRAINT `fk_Obra_has_Autor_Obra1`
    FOREIGN KEY (`Obra_id`)
    REFERENCES `yii2saramago`.`Obra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Obra_has_Autor_Autor1`
    FOREIGN KEY (`Autor_id`)
    REFERENCES `yii2saramago`.`Autor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Autor_Analitico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Autor_Analitico` (
  `Autor_id` INT NOT NULL,
  `Analitico_id` INT NOT NULL,
  PRIMARY KEY (`Autor_id`, `Analitico_id`),
  INDEX `fk_Autor_has_Analitico_Analitico1_idx` (`Analitico_id` ASC),
  INDEX `fk_Autor_has_Analitico_Autor1_idx` (`Autor_id` ASC),
  CONSTRAINT `fk_Autor_has_Analitico_Autor1`
    FOREIGN KEY (`Autor_id`)
    REFERENCES `yii2saramago`.`Autor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Autor_has_Analitico_Analitico1`
    FOREIGN KEY (`Analitico_id`)
    REFERENCES `yii2saramago`.`Analitico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`Requisicao_Exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`Requisicao_Exemplar` (
  `Requisicao_id` INT NOT NULL,
  `Exemplar_id` INT NOT NULL,
  PRIMARY KEY (`Requisicao_id`, `Exemplar_id`),
  INDEX `fk_Requisicao_has_Exemplar_Exemplar1_idx` (`Exemplar_id` ASC),
  INDEX `fk_Requisicao_has_Exemplar_Requisicao1_idx` (`Requisicao_id` ASC),
  CONSTRAINT `fk_Requisicao_has_Exemplar_Requisicao1`
    FOREIGN KEY (`Requisicao_id`)
    REFERENCES `yii2saramago`.`Requisicao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Requisicao_has_Exemplar_Exemplar1`
    FOREIGN KEY (`Exemplar_id`)
    REFERENCES `yii2saramago`.`Exemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `yii2saramago`.`LeituraRecomendada_Uc`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2saramago`.`LeituraRecomendada_Uc` (
  `LeituraRecomendada_id` INT NOT NULL,
  `Uc_id` INT NOT NULL,
  PRIMARY KEY (`LeituraRecomendada_id`, `Uc_id`),
  INDEX `fk_LeituraRecomendada_has_Uc_Uc1_idx` (`Uc_id` ASC),
  INDEX `fk_LeituraRecomendada_has_Uc_LeituraRecomendada1_idx` (`LeituraRecomendada_id` ASC),
  CONSTRAINT `fk_LeituraRecomendada_has_Uc_LeituraRecomendada1`
    FOREIGN KEY (`LeituraRecomendada_id`)
    REFERENCES `yii2saramago`.`LeituraRecomendada` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LeituraRecomendada_has_Uc_Uc1`
    FOREIGN KEY (`Uc_id`)
    REFERENCES `yii2saramago`.`Uc` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `yii2saramago`.`Cdu`
-- -----------------------------------------------------
START TRANSACTION;
USE `yii2saramago`;
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 0', ' Generalidades. Ciência e Conhecimento. Organização. Informação. Documentação. Biblioteconomia. Instituições. Publicações.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 01', ' Ciência e técnica bibliográfica. Bibliografias. Catálogos. ');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 02', ' Bibliotecas. Biblioteconomia. ');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 030', ' Obras Gerais de Referência. Enciclopédias');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 040', ' Vago. ');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 050', ' Publicações Periódicas. Periódicos. Função');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 06', ' Organizações e outras formas de Cooperação. Instituições. Academias. Congressos. Sociedades. Organismos Científicos. Exposições. Museus.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 070', ' Jornais. Jornalismo. Imprensa. ');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 08', ' Poligrafias. Obras em Colaboração. Poligrafias Colectivas. ');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 09', ' Manuscritos. Obras Notáveis e Obras Raras.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 1', ' Filosofia. Psicologia');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 11', ' Metafísica.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 122/129', ' Metafísica Especial.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 13', ' Filosofia da Mente e do Espírito. Metafísica da vida espiritual.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 14', ' Sistemas e pontos de vista filosóficos.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 159.9', ' Psicologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 16', ' Lógica. Epistemologia. Teoria do Conhecimento. Metodologia da Lógica.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 17', ' Filosofia Moral. Ética. Filosofia Prática.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 2', ' Religião. Teologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 21', ' Religiões Pré-históricas e Primitivas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 22', ' Religiões do Extremo Oriente. Taoísmo. Confucionismo. Religiões da Coreia e do Japão.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 23', ' Religiões da Índia. Hinduísmo. Bramanismo. Vedismo');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 24', ' Budismo');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 25', ' Religiões do Mundo Antigo.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 26', ' Judaísmo');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 27', ' Cristianismo. Igrejas e Denominações Cristãs.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 28', ' Islamismo.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 29', ' Movimentos Espirituais Modernos.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 3', ' Ciências Sociais. Estatística. Política. Economia. Comércio. Direito. Administração Pública. Forças Armadas. Assistência Social. Seguros. Educação. Etnologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 30', ' Teorias');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 303', ' Métodos das Ciências Sociais');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 31', ' Estatística. Demografia. Sociologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 32', ' Política.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 33', ' Economia. Ciência Económica.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 34', ' Direito. Jurisprudência.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 35', ' Administração Pública. Assuntos Militares.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 36', ' Protecção das Necessidades Materiais e Mentais da Vida. Serviço Social. Ajuda Social. Segurança Social. Habitação. Consumo. Seguros.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 37', ' Educação.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 39', ' Etnologia. Etnografia. Usos e Costumes. Tradições. Modo de Vida. Folclore.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 5', ' Matemática e Ciências Naturais.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 50', ' Generalidades sobre as Ciências Puras.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 502/504', ' Ciência ambiental. Conservação dos Recursos Naturais. Ameaças ao Ambiente e Protecção Contra as Mesmas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 51', ' Matemática.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 52', ' Astronomia. Astrofísica. Investigação Espacial. Geodesia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 53', ' Física.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 54', ' Química. Mineralogia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 55', ' Ciências da Terra. Ciências Geológicas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 56', ' Paleontologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 57', ' Ciências Biológicas no Geral. Antropologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 58', ' Botânica.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 6', ' Ciências Aplicadas. Medicina. Tecnologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 60', ' Questões Gerais Referentes às Ciências Aplicadas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 61', ' Ciências Médicas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 62', ' Engenharia. Tecnologia em Geral.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 63', ' Agricultura. Ciências Agrárias e Técnicas Relacionadas. Silvicultura. Explorações Agrícolas. Exploração da Vida Selvagem.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 64', ' Economia Doméstica. Ciências Domésticas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 65', ' Gestão e Organização da Indústria');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 66', ' Tecnologia Química. Indústrias Químicas e Relacionadas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 67', ' Indústria Artes Industriais e Ofícios Diversos.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 68', ' Indústrias');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 69', ' Indústria da Construção. Materiais para Construção. Procedimentos e Práticas de Construção.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 7', ' Arte. Recreação. Entretenimento. Desportos.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 7 A/Z', '  Artistas e sua obra.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 7.01', ' Teoria Geral da arte. Estética. Filosofia da arte. Crítica de arte');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 71', ' Planeamento territorial');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 72', ' Arquitectura.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 73', ' Artes Plásticas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 74', ' Desenho. Design. Artes e Ofícios Aplicados.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 75', ' Pintura.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 76', ' Artes Gráficas. Gravura.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 77', ' Fotografia e Processos Similares');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 78', ' Música.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 79', ' Divertimento. Espectáculos. Jogos. Desportos.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 8', ' Língua. Linguística. Literatura.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 80', ' Questões Gerais Referentes à Linguística e à Literatura. Filologia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 81', ' Linguística. Línguas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 82', ' Literatura.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.1/.8', ' Literatura de línguas individuais.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.11', ' Literatura em Línguas Germânicas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.124', ' Literatura Latina.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.13', ' Literaturas em Línguas Românicas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.16', ' Literaturas Eslavas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.17', ' Literaturas Bálticas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.21', ' Literaturas Indicas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.22', ' Literaturas em Línguas Iranianas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.411', ' Literaturas em Línguas Semíticas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.411.21', ' Literaturas Árabes.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.432.8/.9', ' Literaturas Africanas em Línguas Bantu.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.62', ' Literaturas em Línguas Austronésias.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.72', ' Literaturas Australianas.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.81/82', ' Literaturas em Línguas dos Índios da América do Norte.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 821.87', ' Literaturas em Línguas dos Índios da América do Sul e Central.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 9', ' Geografia. Biografia. Historia');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 902', ' Arqueologia');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 903', ' Pré-História. Vestígios Pré-Históricos. Artefactos. Antiguidades. Interpretação e Síntese de Relíquias Materiais do Homem Antigo');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 904', ' Vestígios Culturais dos Períodos Históricos. Artefactos da História Antiga');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 908', ' Monografias.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 91', ' Geografia');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 929', ' Biografias.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 929 A/Z', ' Biografias Individuais.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 93/94', ' História');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 93', ' Ciência da História. Historiografia');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94', ' História em Geral.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(41/99)', ' História Individual dos Países.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(4)', ' História da Europa.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(5)', ' História do Oriente. História da Ásia.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(6)', ' História da África.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(7/8)', ' História das Américas (Norte');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(7)', ' História da América do Norte e América Central.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(8)', ' História da América do Sul.');
INSERT INTO `yii2saramago`.`Cdu` (`id`, `codCdu`, `designacao`) VALUES (DEFAULT, ' 94(9)', ' História dos Estados e Regiões do Pacífico Sul e Austrália');

COMMIT;


-- -----------------------------------------------------
-- Data for table `yii2saramago`.`EstatutoExemplar`
-- -----------------------------------------------------
START TRANSACTION;
USE `yii2saramago`;
INSERT INTO `yii2saramago`.`EstatutoExemplar` (`id`, `estatuto`, `prazo`) VALUES (DEFAULT, 'normal', 0);
INSERT INTO `yii2saramago`.`EstatutoExemplar` (`id`, `estatuto`, `prazo`) VALUES (DEFAULT, 'curto', 3);
INSERT INTO `yii2saramago`.`EstatutoExemplar` (`id`, `estatuto`, `prazo`) VALUES (DEFAULT, 'diario', 1);
INSERT INTO `yii2saramago`.`EstatutoExemplar` (`id`, `estatuto`, `prazo`) VALUES (DEFAULT, 'nreq', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `yii2saramago`.`TipoExemplar`
-- -----------------------------------------------------
START TRANSACTION;
USE `yii2saramago`;
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'Cassete', 'materialAv');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'CD', 'materialAv');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'DVD', 'materialAv');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'Journal', 'pubPeriodica');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'Livro', 'monografia');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'PA - Dissertação de Mestrado', 'monografia');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'PA - Tese de Doutoramento', 'monografia');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'PA - Trabalho final de Lic.', 'monografia');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'Revista', 'pubPeriodica');
INSERT INTO `yii2saramago`.`TipoExemplar` (`id`, `designacao`, `tipo`) VALUES (DEFAULT, 'VHS', 'materialAv');

COMMIT;


-- -----------------------------------------------------
-- Data for table `yii2saramago`.`TipoIrregularidade`
-- -----------------------------------------------------
START TRANSACTION;
USE `yii2saramago`;
INSERT INTO `yii2saramago`.`TipoIrregularidade` (`id`, `irregularidade`, `diasBloqueio`, `diasAtivacao`) VALUES (DEFAULT, 'Material Audio-Visual', 30, 7);
INSERT INTO `yii2saramago`.`TipoIrregularidade` (`id`, `irregularidade`, `diasBloqueio`, `diasAtivacao`) VALUES (DEFAULT, 'Monografia', 30, 7);
INSERT INTO `yii2saramago`.`TipoIrregularidade` (`id`, `irregularidade`, `diasBloqueio`, `diasAtivacao`) VALUES (DEFAULT, 'Publicacao Periodica', 30, 7);

COMMIT;


-- -----------------------------------------------------
-- Data for table `yii2saramago`.`Config`
-- -----------------------------------------------------
START TRANSACTION;
USE `yii2saramago`;
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Código Postal', 'entidade_codPostal', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Designação', 'entidade_designacao', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Localidade', 'entidade_localidade', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Favicon', 'entidade_favicon', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Logotipo', 'entidade_logotipo', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Morada', 'entidade_morada', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'NIPC', 'entidade_nipc', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Sigla', 'entidade_sigla', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Módulo Arrumação', 'modulo_arrumacao', NULL);
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Mostrar as últimas obras adquiridas', 'opac_obrasAdquiridas', '1');
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Opção de cancelamento de reservas no OPAC', 'opac_reservaExemplares', '1');
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Envio de recibo de devoluções', 'recibo_devolucao', '1');
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Envio de recibo de empréstimo', 'recibo_emprestimo', '1');
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Envio de recibo de reserva de Postos de Trabalho', 'recibo_postoTrabalho', '1');
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Envio de recibo de renovações', 'recibo_renovacao', '1');
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Envio de reserva de exemplares', 'recibo_reservaExemplar', '1');
INSERT INTO `yii2saramago`.`Config` (`id`, `info`, `key`, `value`) VALUES (DEFAULT, 'Duração das reservas de exemplares (em dias)', 'reservaExemplar_duracao', '3');

COMMIT;

