-- MySQL dump 10.16  Distrib 10.1.21-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `bdejur`
--

USE `bdejur`;

-----------------------------------------------------
### Realizando atualizações no modulo de Permissionamento
-----------------------------------------------------
--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action` (
  `id_action` int(11) NOT NULL AUTO_INCREMENT,
  `nm_action` varchar(200) DEFAULT NULL COMMENT '{"label":"Ação"}',
  PRIMARY KEY (`id_action`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (1,'index'),(6,'cadastro'),(7,'gravar'),(8,'excluir'),(9,'upload'),(14,'dados-pessoais'),(15,'atualizar-dados'),(17,'gravar-atualizacao'),(27,'enviar-id'),(30,'ativar-id'),(35,'negar-id'),(36,'alterar-senha'),(37,'salvar-redefinicao-senha'),(51,'index-pagination'),(52,'cadastroperiodoletivodetalhe'),(53,'detalhe-pagination'),(54,'adicionarperiodoletivodetalhe'),(55,'excluirvialistagemperiodoletivo'),(57,'listar-permissoes-acoes'),(58,'relacionar-materia'),(59,'excluir-relacao-materia-semestre'),(60,'cadastro-alternativas'),(61,'gravar-alternativas'),(62,'gerar-pdf-quantitativo-questoes-por-assunto'),(63,'gerar-relatorio-pdf'),(64,'cadastro-questao'),(65,'adicionar-questao-aleatoria'),(66,'gravar-questao-aleatoria'),(67,'imprimir-prova-pdf'),(68,'cadastro-via-prova'),(69,'imprimir-gabarito-pdf'),(70,'desativar'),(71,'adicionar-questao-manual'),(72,'adicionar-varias-questoes-aleatorias'),(73,'detalhes-filtros-pagination'),(74,'gravar-varias-questoes-aleatorias'),(75,'gravar-adicionar-varias-questoes-aleatorias'),(76,'gravar-questao-manual'),(77,'remover-questao-prova-ajax'),(78,'carregar-combo-materias-ajax'),(79,'relatorio-usuarios'),(80,'gravar-via-prova'),(81,'cadastro-alternativas-via-prova'),(82,'gravar-alternativas-via-prova'),(83,'carregar-combo-assunto-materia-ajax'),(84,'gerar-pdf-materia-semestre'),(85,'detalhar-questoes-pagination'),(86,'adicionar-questao-prova-manual'),(87,'adicionar-questao-prova-aleatoria'),(88,'atualizar'),(89,'excluirLog'),(90,'aplicar-temporizador-questao-prova-ajax'),(91,'marcar-avaliacao-como-aplicada'),(92,'liberar-temporizador-questao-prova-ajax'),(93,'carregar-combo-sub-assunto-materia-ajax');
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `controller`
--

DROP TABLE IF EXISTS `controller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controller` (
  `id_controller` int(11) NOT NULL AUTO_INCREMENT,
  `nm_controller` varchar(400) DEFAULT NULL COMMENT '{"label":"Controller"}',
  `nm_modulo` varchar(50) DEFAULT NULL,
  `cs_exibir_combo` char(1) DEFAULT 'S',
  PRIMARY KEY (`id_controller`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controller`
--

LOCK TABLES `controller` WRITE;
/*!40000 ALTER TABLE `controller` DISABLE KEYS */;
INSERT INTO `controller` VALUES (3,'usuario-usuario','Usuario','S'),(4,'application-index','Aplicação','N'),(9,'PhpBoletoZf2\\Controller\\Itau','Boleto do Itau','N'),(11,'principal-principal','Principal','S'),(12,'perfil-perfil','Perfil','S'),(23,'periodo_letivo-periodoletivo','Periodo Letivo','S'),(24,'detalhe_periodo_letivo','Detalhe Periodo Letivo','S'),(25,'controller-controller','Controller','S'),(26,'action-action','Actions','S'),(27,'teste-teste','Modulo teste','S'),(28,'prova-prova','Prova','S'),(29,'nivel_dificuldade-niveldificuldade','Nível de Dificuldade','S'),(30,'unidade_tempo-unidadetempo','Unidade de Tempo','S'),(31,'temporizacao-temporizacao','Temporização','S'),(32,'permissao-permissao','Gerenciador de Permissão','S'),(33,'tipo-questao_tipoquestao','Tipo de Questao','S'),(34,'assunto-materia_assuntomateria','Assunto Materia','S'),(35,'infra-infra','Infraestrutura','S'),(36,'fonte-fonte','Fonte da Questão','S'),(37,'classificacao-classificacao','Classificação de Semestre','S'),(38,'materia-materia','Matéria da Questão','N'),(39,'assunto_materia-assuntomateria','Assunto de Cada Matéria','S'),(40,'tipo_questao-tipoquestao','Tipo de Questão','S'),(41,'materia_semestre-materiasemestre','Matérias por Semestre','S'),(42,'questao-questao','Questao','S'),(43,'relatorio-relatorio','Relatorios','S'),(44,'questoes_prova-questoesprova','Questoes Prova','S'),(45,'filtro_prova-filtroprova','Filtros da prova','S'),(46,'sub_assunto_materia-subassuntomateria','Sub Assunto Matéria','S');
/*!40000 ALTER TABLE `controller` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"label":"Id Perfil"}',
  `nm_perfil` varchar(100) NOT NULL COMMENT '{''label'':"Perfil"}',
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Administrador'),(2,'Coordenação'),(3,'Professor');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_controller_action`
--

DROP TABLE IF EXISTS `perfil_controller_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil_controller_action` (
  `id_perfil_controller_action` int(11) NOT NULL AUTO_INCREMENT,
  `id_controller` int(11) NOT NULL,
  `id_action` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_perfil_controller_action`),
  KEY `ix_perfil_controller_action_controller` (`id_controller`),
  KEY `ix_perfil_controller_action_action` (`id_action`),
  KEY `ix_perfil_controller_action_perfil` (`id_perfil`),
  CONSTRAINT `fk_perfil_controller_action_action` FOREIGN KEY (`id_action`) REFERENCES `action` (`id_action`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_controller_action_controller` FOREIGN KEY (`id_controller`) REFERENCES `controller` (`id_controller`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_perfil_controller_action_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1060 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_controller_action`
--

LOCK TABLES `perfil_controller_action` WRITE;
/*!40000 ALTER TABLE `perfil_controller_action` DISABLE KEYS */;
INSERT INTO `perfil_controller_action` VALUES (4,4,1,1),(33,4,1,2),(87,9,1,1),(88,9,1,2),(93,11,1,1),(167,23,1,1),(168,23,6,1),(169,23,7,1),(170,23,8,1),(171,23,51,1),(172,23,52,1),(173,23,53,1),(174,23,54,1),(175,24,55,1),(176,25,1,1),(177,25,6,1),(178,25,7,1),(179,25,8,1),(180,25,51,1),(181,26,1,1),(182,26,6,1),(183,26,7,1),(184,26,8,1),(185,26,51,1),(196,30,1,1),(197,30,6,1),(198,30,7,1),(199,30,8,1),(200,30,51,1),(206,32,1,1),(207,32,6,1),(208,32,7,1),(209,32,8,1),(210,32,51,1),(221,25,57,1),(222,32,57,1),(244,35,1,1),(250,37,1,1),(251,37,6,1),(252,37,7,1),(253,37,8,1),(254,37,51,1),(296,11,1,2),(297,11,1,3),(315,12,1,1),(316,12,6,1),(317,12,7,1),(318,12,8,1),(469,45,1,1),(470,45,6,1),(471,45,7,1),(472,45,8,1),(473,45,51,1),(520,3,1,1),(521,3,6,1),(522,3,7,1),(523,3,14,1),(524,3,15,1),(525,3,17,1),(527,3,36,1),(528,3,37,1),(529,3,51,1),(530,3,70,1),(531,3,79,1),(593,43,84,1),(594,43,62,1),(595,43,63,1),(596,43,69,1),(597,43,67,1),(598,43,79,1),(657,44,65,1),(658,44,71,1),(659,44,87,1),(660,44,86,1),(661,44,72,1),(662,44,6,1),(663,44,85,1),(664,44,8,1),(665,44,7,1),(666,44,1,1),(667,44,51,1),(668,44,65,2),(669,44,71,2),(670,44,87,2),(671,44,86,2),(672,44,72,2),(740,42,88,1),(741,42,15,1),(742,42,6,1),(743,42,60,1),(744,42,81,1),(745,42,68,1),(746,42,83,1),(747,42,78,1),(748,42,8,1),(749,42,89,1),(750,42,7,1),(751,42,61,1),(752,42,82,1),(753,42,80,1),(754,42,1,1),(755,42,51,1),(756,42,9,1),(757,39,6,1),(758,39,8,1),(759,39,89,1),(760,39,7,1),(761,39,1,1),(762,39,51,1),(763,41,6,1),(764,41,53,1),(765,41,8,1),(766,41,59,1),(767,41,89,1),(768,41,7,1),(769,41,1,1),(770,41,51,1),(771,41,58,1),(772,38,6,1),(773,38,8,1),(774,38,89,1),(775,38,7,1),(776,38,1,1),(777,38,51,1),(778,29,6,1),(779,29,8,1),(780,29,89,1),(781,29,7,1),(782,29,1,1),(783,29,51,1),(784,31,6,1),(785,31,8,1),(786,31,89,1),(787,31,7,1),(788,31,1,1),(789,31,51,1),(790,33,6,1),(791,33,8,1),(792,33,89,1),(793,33,7,1),(794,33,1,1),(795,33,51,1),(796,40,6,1),(797,40,8,1),(798,40,89,1),(799,40,7,1),(800,40,1,1),(801,40,51,1),(802,36,6,1),(803,36,8,1),(804,36,89,1),(805,36,7,1),(806,36,1,1),(807,36,51,1),(853,28,65,1),(854,28,71,1),(855,28,72,1),(856,28,90,1),(857,28,6,1),(858,28,64,1),(859,28,83,1),(860,28,78,1),(861,28,73,1),(862,28,8,1),(863,28,89,1),(864,28,63,1),(865,28,7,1),(866,28,75,1),(867,28,66,1),(868,28,76,1),(869,28,74,1),(870,28,69,1),(871,28,67,1),(872,28,1,1),(873,28,51,1),(874,28,92,1),(875,28,91,1),(876,28,77,1),(891,46,6,1),(892,46,93,1),(893,46,89,1),(894,46,7,1),(895,46,1,1),(896,46,51,1),(897,28,65,2),(898,28,71,2),(899,28,72,2),(900,28,6,2),(901,28,64,2),(902,28,68,2),(903,28,83,2),(904,28,78,2),(905,28,73,2),(906,28,89,2),(907,28,63,2),(908,28,7,2),(909,28,75,2),(910,28,66,2),(911,28,76,2),(912,28,74,2),(913,28,69,2),(914,28,67,2),(915,28,1,2),(916,28,51,2),(917,28,92,2),(918,28,77,2),(919,28,65,3),(920,28,71,3),(921,28,72,3),(922,28,6,3),(923,28,64,3),(924,28,68,3),(925,28,83,3),(926,28,78,3),(927,28,73,3),(928,28,89,3),(929,28,63,3),(930,28,7,3),(931,28,75,3),(932,28,66,3),(933,28,76,3),(934,28,74,3),(935,28,69,3),(936,28,67,3),(937,28,1,3),(938,28,51,3),(939,28,92,3),(940,28,77,3),(941,42,88,3),(942,42,15,3),(943,42,6,3),(944,42,60,3),(945,42,81,3),(946,42,68,3),(947,42,83,3),(948,42,78,3),(949,42,93,3),(950,42,89,3),(951,42,7,3),(952,42,61,3),(953,42,82,3),(954,42,80,3),(955,42,1,3),(956,42,51,3),(957,42,9,3),(958,42,88,2),(959,42,15,2),(960,42,6,2),(961,42,60,2),(962,42,81,2),(963,42,68,2),(964,42,83,2),(965,42,78,2),(966,42,93,2),(967,42,89,2),(968,42,7,2),(969,42,61,2),(970,42,82,2),(971,42,80,2),(972,42,1,2),(973,42,51,2),(974,42,9,2),(975,43,84,2),(976,43,62,2),(977,43,63,2),(978,43,69,2),(979,43,67,2),(980,43,79,2),(981,39,6,2),(982,39,89,2),(983,39,7,2),(984,39,1,2),(985,39,51,2),(986,34,6,2),(987,34,89,2),(988,34,7,2),(989,34,1,2),(990,34,51,2),(991,37,6,2),(992,37,89,2),(993,37,7,2),(994,37,1,2),(995,37,51,2),(996,45,6,2),(997,45,8,2),(998,45,89,2),(999,45,7,2),(1000,45,1,2),(1001,45,51,2),(1002,36,6,2),(1003,36,89,2),(1004,36,7,2),(1005,36,1,2),(1006,36,51,2),(1007,38,6,2),(1008,38,89,2),(1009,38,7,2),(1010,38,1,2),(1011,38,51,2),(1012,29,6,2),(1013,29,89,2),(1014,29,7,2),(1015,29,1,2),(1016,29,51,2),(1017,46,6,2),(1018,46,89,2),(1019,46,7,2),(1020,46,1,2),(1021,46,51,2),(1022,31,6,2),(1023,31,89,2),(1024,31,7,2),(1025,31,1,2),(1026,31,51,2),(1027,33,6,2),(1028,33,89,2),(1029,33,7,2),(1030,33,1,2),(1031,33,51,2),(1032,40,6,2),(1033,40,89,2),(1034,40,7,2),(1035,40,1,2),(1036,40,51,2),(1037,30,6,2),(1038,30,89,2),(1039,30,7,2),(1040,30,1,2),(1041,30,51,2),(1042,41,6,2),(1043,41,53,2),(1044,41,59,2),(1045,41,89,2),(1046,41,7,2),(1047,41,1,2),(1048,41,51,2),(1049,41,58,2),(1050,3,36,2),(1051,3,15,2),(1052,3,14,2),(1053,3,70,2),(1054,3,7,2),(1055,3,17,2),(1056,3,1,2),(1057,3,51,2),(1058,3,79,2),(1059,3,37,2);
/*!40000 ALTER TABLE `perfil_controller_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(250) NOT NULL COMMENT '{"label":"Usuário"}',
  `nm_funcao` varchar(200) DEFAULT NULL COMMENT '{"label":"Profissão"}',
  `id_sexo` int(11) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `id_situacao_usuario` int(11) NOT NULL,
  `id_email` int(11) DEFAULT NULL,
  `id_telefone` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `ix_usuarios_sexo` (`id_sexo`),
  KEY `ix_usuarios_situacao_usuario` (`id_situacao_usuario`),
  KEY `ix_usuarios_emails` (`id_email`),
  KEY `ix_usuarios_telefones` (`id_telefone`),
  KEY `ix_usuarios_perfil` (`id_perfil`),
  CONSTRAINT `fk_usuarios_emails` FOREIGN KEY (`id_email`) REFERENCES `email` (`id_email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_sexo` FOREIGN KEY (`id_sexo`) REFERENCES `sexo` (`id_sexo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_situacao_usuario` FOREIGN KEY (`id_situacao_usuario`) REFERENCES `situacao_usuario` (`id_situacao_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_telefones` FOREIGN KEY (`id_telefone`) REFERENCES `telefone` (`id_telefone`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ix_usuarios_tipo_usuario` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Admin','Administrador',1,1,1,1,1),(2,'Alysson Vicuña de Oliveira','Professor',1,2,1,2,2),(3,'teste001',NULL,NULL,2,2,3,3),(4,'teste002',NULL,NULL,2,2,4,4),(5,'Rogerio Souza','Coordenador de Atividades',1,2,1,5,10),(6,'Rosangela Silva','Assistente de Coordenaçao',1,2,1,6,11),(7,'Pierre Tramontini','Diretor de Coordenaçao',1,1,1,7,12),(8,'juliana ferreira da Silva','testes',2,1,2,8,13);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-05 21:54:44