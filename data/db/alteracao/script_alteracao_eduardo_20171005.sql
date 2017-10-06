CREATE TABLE `sub_assunto_materia` (
  `id_sub_assunto_materia` int(11) NOT NULL AUTO_INCREMENT,
  `id_assunto_materia` int(11) DEFAULT NULL,
  `nm_sub_assunto_materia` varchar(100) DEFAULT NULL,
  `cs_ativo` char(1) DEFAULT '1',
  PRIMARY KEY (`id_sub_assunto_materia`),
  KEY `FK_Reference_64` (`id_assunto_materia`),
  CONSTRAINT `FK_Reference_64` FOREIGN KEY (`id_assunto_materia`) REFERENCES `assunto_materia` (`id_assunto_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-----------------------------------------------------
### Relacionar Tabela Sub_assunto a tabela Questão
-----------------------------------------------------
ALTER TABLE `questao` ADD COLUMN `id_sub_assunto_materia` int(11) DEFAULT NULL AFTER id_assunto_materia;
ALTER TABLE `questao` ADD KEY `FK_Reference_65` (`id_sub_assunto_materia`);
ALTER TABLE `questao` ADD CONSTRAINT `FK_Reference_65` FOREIGN KEY (`id_sub_assunto_materia`) REFERENCES `sub_assunto_materia` (`id_sub_assunto_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION;
