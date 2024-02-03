-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06/07/2018 às 16:45
-- Versão do servidor: 5.7.21
-- Versão do PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `booknow`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `rg` varchar(45) NOT NULL,
  `cidade` varchar(55) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `endereco` varchar(70) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `senha` varchar(50) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
CREATE TABLE IF NOT EXISTS `avaliacao` (
  `idavaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `usuarios_idusuarios` int(11) NOT NULL,
  `comentario_idcomentario` int(11) NOT NULL,
  `comentario_postagem_idpostagem` int(11) NOT NULL,
  PRIMARY KEY (`idavaliacao`),
  KEY `fk_avaliacao_usuarios1_idx` (`usuarios_idusuarios`),
  KEY `fk_avaliacao_comentario1_idx` (`comentario_idcomentario`,`comentario_postagem_idpostagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `postagem_idpostagem` int(11) NOT NULL,
  `usuarios_idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idcomentario`,`postagem_idpostagem`),
  KEY `fk_comentario_postagem_idx` (`postagem_idpostagem`),
  KEY `fk_comentario_usuarios1_idx` (`usuarios_idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagem`
--

DROP TABLE IF EXISTS `postagem`;
CREATE TABLE IF NOT EXISTS `postagem` (
  `idpostagem` int(11) NOT NULL AUTO_INCREMENT,
  `nomelivro` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `genero` varchar(50) NOT NULL,
  `estadolivro` varchar(45) DEFAULT NULL,
  `preco` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `statuscompra` varchar(45) DEFAULT NULL,
  `usuarios_idusuarios` int(11) DEFAULT NULL,
  `administrador_idusuarios` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpostagem`),
  KEY `fk_postagem_usuarios1_idx` (`usuarios_idusuarios`),
  KEY `administrador_idusuarios` (`administrador_idusuarios`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_compra`
--

DROP TABLE IF EXISTS `tb_compra`;
CREATE TABLE IF NOT EXISTS `tb_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cd_produto` int(11) DEFAULT NULL,
  `cd_comprador` int(11) DEFAULT NULL,
  `cd_status` int(11) DEFAULT NULL,
  `cd_vendedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cd_produto` (`cd_produto`),
  KEY `cd_comprador` (`cd_comprador`),
  KEY `cd_status` (`cd_status`),
  KEY `cd_vendedor` (`cd_vendedor`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_compra`
--

INSERT INTO `tb_compra` (`id`, `cd_produto`, `cd_comprador`, `cd_status`, `cd_vendedor`) VALUES
(92, 5, 1, 1, 2),
(93, 1, 2, 1, 1),
(94, 3, 1, 1, 2),
(95, 15, 1, 1, 3),
(96, 9, 1, 1, 3),
(97, 1, 3, 1, 1),
(98, 10, 3, 1, 1),
(99, 9, 1, 1, 3),
(100, 20, 3, 1, 11),
(101, 38, 1, 1, 13),
(102, 37, 1, 1, 12),
(103, 39, 1, 1, 13),
(104, 4, 3, 1, 2),
(105, 4, 3, 1, 2),
(106, 3, 3, 1, 2),
(107, 3, 1, 1, 2),
(108, 37, 15, 1, 12),
(109, 7, 3, 1, 1),
(110, 5, 3, 1, 2),
(111, 4, 3, 1, 2),
(112, 1, 3, 1, 1),
(146, 7, 3, 1, 1),
(148, 7, 3, 1, 1),
(149, 1, 3, 1, 1),
(188, 3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_postagem`
--

DROP TABLE IF EXISTS `tb_postagem`;
CREATE TABLE IF NOT EXISTS `tb_postagem` (
  `id_postagem` int(11) NOT NULL AUTO_INCREMENT,
  `cd_foto` varchar(200) DEFAULT NULL,
  `nm_livro` varchar(40) DEFAULT NULL,
  `nm_autor` varchar(100) NOT NULL,
  `dt_data` date DEFAULT NULL,
  `cd_descricao` varchar(40) DEFAULT NULL,
  `genero` varchar(40) DEFAULT NULL,
  `editora` varchar(40) NOT NULL,
  `cd_qtd` varchar(200) NOT NULL,
  `dl_estado` varchar(10) NOT NULL,
  `sinopse` text NOT NULL,
  `vl_preco` varchar(30) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_postagem`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_postagem`
--

INSERT INTO `tb_postagem` (`id_postagem`, `cd_foto`, `nm_livro`, `nm_autor`, `dt_data`, `cd_descricao`, `genero`, `editora`, `cd_qtd`, `dl_estado`, `sinopse`, `vl_preco`, `id_usuario`) VALUES
(1, '../banco de dados/imagem/1/produtos/naruto.JPG', 'Naruto', '', '2018-05-17', 'em bom estado ediÃ§Ã£o japonesa', 'Shounem', 'Shōnen Jump', '', '', '', '20.00', 1),
(3, '../banco de dados/imagem/2/produtos/harry.jpg', 'Harry Potter e a pedra filosofal', '', '2018-05-18', 'ediÃ§Ã£o especial amazon. Defeito (folha', 'Literatura fantÃ¡stica', 'amazon', '', '', '', '30.00', 2),
(4, '../banco de dados/imagem/2/produtos/aghata.jpg', 'Cartas na mesa', '', '2018-05-18', 'ediÃ§Ã£o de 1900 e bolinha', 'romance policial ', 'L&PM POCKET', '', '', '', '10.00', 2),
(5, '../banco de dados/imagem/2/produtos/it.jpg', 'IT a coisa', '', '2018-05-18', 'paginas manchadas de cafÃ©', 'Terro', 'Suma', '', '', '', '60.00', 2),
(7, '../banco de dados/imagem/1/produtos/marley.jpg', 'Marley e Eu', 'John Grogan', '2018-05-21', 'meu cachorro comeu algumas paginas', 'Biografia', ' HarperCollins', '', '', 'Os recÃ©m-casados John e Jenny Grogan se mudam de Michigan para a FlÃ³rida, onde eles compram sua primeira casa e encontram trabalhos em competitivos jornais. Mais tarde, o casal adota Marley, um adorÃ¡vel filhote de labrador amarelo. Marley cresce rapidamente e se torna bastante travesso. Ainda assim, mesmo enquanto ele estÃ¡ destruindo a mobÃ­lia e nÃ£o obedece, ele sempre consegue alegrar John, Jenny e sua crescente famÃ­lia.', '10.00', 1),
(9, '../banco de dados/imagem/3/produtos/PRINCESA_MECANICA_1381172077B.jpg', 'Princesa MecÃ¢nica (As PeÃ§as Infernais ', 'Cassandra Clare', '2018-05-27', 'ContinuaÃ§Ã£o de PrÃ­ncipe mecÃ¢nico, â€', 'Aventura & Fantasia', 'Galera Record', '', '', '', '45.00', 3),
(10, '../banco de dados/imagem/1/produtos/escaravelho.jpg', 'Escaravelho do Diabo', 'LÃºcia Machado de Almeida', '2018-05-27', 'apenas algumas orelhas nas capa', 'Suspense', 'Editora Ãtica', '', '', 'A Ãºnica pista que Alberto tem sobre a sÃ©rie de assassinatos que estÃ¡ acontecendo Ã© que vÃ­timas ruivas recebem um escaravelho pelo correio antes de morrer. Ele precisa descobrir o que estÃ¡ por trÃ¡s desses crimes misteriosos antes que outras mortes ocorram na cidade.', '5.00', 1),
(11, '../banco de dados/imagem/1/produtos/canvas.jpg', 'CDZ the los canvas ed 16', 'nÃ£o sei', '2018-06-01', 'semi novo', 'Manga (Quadrinhos Orientais)', 'toei animation', '', '', 'Ocorre 200 anos antes da saga de Hades onde o atual cavaleiro de pegasus Ã© Tema,a saga mostra detalhes sobre a guerra santa ', '5.85', 1),
(12, '../banco de dados/imagem/1/produtos/donabenta.jpg', 'Dona Benta', 'Sem', '2018-06-02', 'EdiÃ§Ã£o especial completa', 'Gastronomia', 'Editora Nacional ', '1', 'Bom', 'Ã© um livro de receitas ', '15.00', 1),
(13, '../banco de dados/imagem/3/produtos/o segredo das sombras.jpg', 'O segredo das sombras', 'Delany Shannon', '2018-06-04', ' Nada Ã© simples quando vocÃª corre com ', 'Suspense', 'Universo dos livros', '1', '', ' Jess Gillmansen acreditava \r\n jÃ¡ ter visto de tudo mas seus olhos estÃ£o prestes a serem abertos a um perigo\r\n e uma realidade mais paranormal do que jamais suspeitou. Com Jess descobrindo \r\n que a mÃ£e dos Rusakovas continua viva e presa, as escolhas do grupo tornam-se \r\n cada vez mais importantes e difÃ­ceis. Linhas sÃ£o desenhadas e relacionamentos\r\n mudam Ã  medida que a famÃ­lia Rusakova luta para se reunir e libertar sua mÃ£e \r\n e pessoas que Jess sempre acreditou serem normais mostram-se algo totalmente diferente.', '50.00', 3),
(15, '../banco de dados/imagem/3/produtos/O TEMPO E O VENTO - PARTE 1.jpg', '    O TEMPO E O VENTO - PARTE 1', 'VERISSIMO, ERICO', '2018-06-04', 'O Continente abre a mais famosa saga da ', 'Suspense', 'Companhia das letras', '1', 'Bom', ' O Continente abre a mais famosa saga da literatura brasileira, O tempo e o vento. A Trilogia â€”\r\n formada por O Continente, O retrato e O arquipÃ©lago â€” percorre um sÃ©culo e meio da histÃ³ria\r\n do Rio Grande do Sul e do Brasil, acompanhando a formaÃ§Ã£o da famÃ­lia Terra CambarÃ¡. NUm\r\n constante ir e vir entre o passado â€” as MissÃµes, a fundaÃ§Ã£o do povoado de Santa FÃ© â€” e o tempo\r\n do Sobrado sitiado pelas forÃ§as federalistas, em 1895, desfilam personagens fascinantes, eternamente\r\n vivos na imaginaÃ§Ã£o dos leitores de Erico Verissimo: o enigmÃ¡tico Pedro Missioneiro, a corajosa\r\n Ana Terra, o intrÃ©pido e sedutor CapitÃ£o Rodrigo, a tenaz Bibiana.\r\n', '25.00', 3),
(17, '../banco de dados/imagem/1/produtos/o-nome-do-vento-capa.jpg', 'O nome do vento', 'patrick rothfuss', '2018-06-18', 'molhou', 'Fantasia', 'nextante', '1', 'RazoÃ¡vel', 'O vento levou a casa do cara e ele foi se vingar da mÃ£e natureza (mentira nunca li)', '20.00', 1),
(19, '../banco de dados/imagem/3/produtos/PEQUENO PRINCIPE, O (BOLSO).jpg', 'O Pequeno PrÃ­ncipe ', 'Antoine de Saint-ExupÃ©ry ', '2018-06-18', 'Livros em excelente estado sem risco e s', 'Infantil', 'Reynal & Hitchcock, Gallimard', '1', 'Exelente', 'Um piloto forÃ§ado a aterrissar no deserto do Saara encontra um pequeno prÃ­ncipe, recÃ©m-chegado de um planeta distante. As sÃ¡bias,\r\n encantadoras e inesquecÃ­veis histÃ³rias contadas pelo pequeno prÃ­ncipe falam de seu prÃ³prio planeta, com seus trÃªs vulcÃµes e uma flor presunÃ§osa.', '20.00', 3),
(20, '../banco de dados/imagem/11/produtos/15055482.jpg', 'zsdas', 'asda', '2018-06-18', 'ads', 'Auto Ajuda', 'ada', '1', 'Exelente', 'adas\r\n', '20', 11),
(21, '../banco de dados/imagem/9/produtos/CUIDE DOS PAIS ANTES QUE SEJA TARDE.jpg', 'ret', 'drt', '2018-06-18', 'ytert', 'Auto Ajuda', 'erter', '2', 'Bom', 'rtytery', '15', 9),
(27, '../banco de dados/imagem/9/produtos/15055482.jpg', 'sdhgsajfrdsalfr', 'fdsfdsf', '2018-06-19', 'dsfadsfa', '', 'dsfsdf', '1', 'RazoÃ¡vel', 'fdsfdsfdsf', '20', 9),
(31, '../banco de dados/imagem/11/produtos/HOMO DEUS.jpg', 'HOMO DEUS', 'HARARI, YUVAL NOAH', '2018-06-19', 'capa suja', 'Suspense', 'NÃƒO SEI', '1', 'Bom', 'Neste Homo Deus: uma breve histÃ³ria do amanhÃ£, Yuval Noah Harari, autor do estrondoso best-seller\r\n Sapiens: uma breve histÃ³ria da humanidade, volta a combinar ciÃªncia, histÃ³ria e filosofia, desta\r\n vez para entender quem somos e descobrir para onde vamos. SEmpre com um olhar no passado e nas\r\n nossas origens, Harari investiga o futuro da humanidade em busca de uma resposta tÃ£o difÃ­cil\r\n quanto essencial: depois de sÃ©culos de guerras, fome e pobreza, qual serÃ¡ nosso destino na Terra?\r\n A partir de uma visÃ£o absolutamente original de nossa histÃ³ria, ele combina pesquisas de ponta e\r\n os mais recentes avanÃ§os cientÃ­ficos Ã  sua conhecida capacidade de observar o passado de uma maneira\r\n inteiramente nova. ASsim, descobrir os prÃ³ximos passos da evoluÃ§Ã£o humana serÃ¡ tambÃ©m redescobrir\r\n quem fomos e quais caminhos tomamos para chegar atÃ© aqui', '19.00', 11),
(34, '../banco de dados/imagem/11/produtos/azul.jpg', 'asd', 'ad', '2018-06-19', 'ad', 'Contos', 'ad', '1', 'Bom', 'asdasdsadsada', '10', 11),
(35, '../banco de dados/imagem/11/produtos/o-nome-do-vento-capa.jpg', 'sfhkjdalfhadsf', 'dsadsad', '2018-06-19', 'sadsad', 'Auto Ajuda', 'sadsadsad', '1', 'Bom', 'botÃ£o', '10.00', 11),
(36, '../banco de dados/imagem/11/produtos/A HORA DA ESTRELA.png', 'A HORA DA ESTRELA', 'LISPECTOR, CLARICE', '2018-06-19', 'capa suja', 'Romance', 'NÃƒO SEI', '01', 'RazoÃ¡vel', ' A histÃ³ria da nordestina MacabÃ©a Ã© contada passo a passo pelo escritor Rodrigo S.M., alter-ego de\r\n Clarice Lispector, de um modo que busca permitir aos leitores acompanhar o seu processo de criaÃ§Ã£o.\r\n O autor faz o relato da vida triste e sem perspectiva da alagoana MacabÃ©a, pontuada com as\r\n informaÃ§Ãµes do \"VocÃª sabia?\" da rÃ¡dio RelÃ³gio, sinistro metrÃ´nomo a comandar o ritmo de seus Ãºltimos\r\n dias de vida. Para a cartomante Carlota, a quem MacabÃ©a procura em busca de um sopro de esperanÃ§a,\r\n esses dias derradeiros deveriam ser coroados com o casamento com um estrangeiro rico. Mas, ironicamente,\r\n MacabÃ©a termina sob as rodas de um automÃ³vel de luxo Mercedes-Benz.', '15', 11),
(37, '../banco de dados/imagem/12/produtos/batman.jpg', 'Batman Silencio', 'nÃ£o informado', '2018-06-20', 'vendo para comprar outras em bom estado', 'HQS (Quadrinhos Ocidentais)', 'Eaglemos', '1', 'Bom', 'nÃ£o informada ', '20.00', 12),
(38, '../banco de dados/imagem/13/produtos/livro-50-tons-mais-escuros-capa-do-filme-D_NQ_NP_723205-MLB26483964478_122017-F.jpg', 'CINQUENTA TONS MAIS ECUROS', 'E. L. James', '2018-06-20', 'putaria', 'Fantasia', 'Richard Francis-Bruce', '100', 'RazoÃ¡vel', 'Putaria sadomasoquista', '1.99', 13),
(39, '../banco de dados/imagem/13/produtos/51aImH-uicL._SX382_BO1,204,203,200_.jpg', 'JUSTIN BIEBER: Just Getting Started', 'Justin Bieber', '2018-06-20', 'NAD', 'Biografia', 'HarperCollins', '1', 'RazoÃ¡vel', '\"My story is something I like to share with others, to show people that with enough belief in yourself and what you can accomplish, anything is possible.\"â€”Justin Bieber', '0.50', 13),
(40, '../banco de dados/imagem/1/produtos/Capa_toda_poesia3.jpg', 'asdfdasdsa', 'zxdfdsaf', '2018-06-21', 'dsaasdasda', 'Contos', 'sadasdas', '1', 'RazoÃ¡vel', 'dsadasdasdasd', '20.00', 1),
(41, '../banco de dados/imagem/1/produtos/Vampiro que descobriu o Brasil.jpg', 'O vampiro que descobriu o Brasil', 'Ivan Jaf', '2018-06-24', 'Primeiro livro que eu li recomendo', 'Fantasia', 'Ãtica', '1', 'RazoÃ¡vel', 'Lisboa, 1500. AntÃ´nio Ã© mordido no pescoÃ§o e se transforma num vampiro. Inconformado e nÃ£o desejando a imortalidade, ele descobre que, para desfazer a maldiÃ§Ã£o, terÃ¡ de reencontrar seu agressor - que estÃ¡ justamente entre a tripulaÃ§Ã£o de Pedro Ãlvares Cabral! Enquanto procura por seu inimigo em desventuras cÃ´micas, ele vai se tornando - acidentalmente - a maior testemunha da HistÃ³ria brasileira. Por cinco sÃ©culos, acompanha o crescimento de uma naÃ§Ã£o: ColÃ´nia, ImpÃ©rio e RepÃºblica. Do terra Ã  vista de 22 de abril Ã  era globalizada do sÃ©culo XXI, sua trajetÃ³ria cruza a de vÃ¡rias figuras de carne e osso: Tiradentes, Calabar, Dom JoÃ£o VI, Dom Pedro I, GetÃºlio Vargas, Castelo Branco, Tancredo Neves...\r\nUma visÃ£o irreverente do nosso paÃ­s, num misto de realidade e ficÃ§Ã£o que vai fazer vocÃª encarar o Brasil de um jeito diferente...', '5.00', 1),
(42, '../banco de dados/imagem/1/produtos/download.png', 'Mistborn', 'Brandon', '2018-07-04', 'muito loko', 'AÃ§Ã£o', 'nÃ£o sei', '1', 'Bom', 'O primeiro volume da aguardada saga fantÃ¡stica de Brandon Sanderson! Certa vez, um jovem com uma heranÃ§a misteriosa, desafiou corajosamente a escuridÃ£o que sufocava a Terra. Mas ele falhou... Desde entÃ£o, hÃ¡ mil anos, o mundo Ã© um deserto de cinzas e brumas, governado por um imperador imortal conhecido como Senhor Soberano. Nessa sociedade onde as pessoas sÃ£o divididas em classes sociais, Kelsier, um ladrÃ£o bastardo, se torna o Ãºnico sobrevivente que escapou da prisÃ£o brutal do Senhor Soberano, onde ele descobriu ter os poderes alomÃ¢nticos de um Nascido da Bruma â€“ uma magia misteriosa e proibida. Agora, Kelsier planeja o seu ataque mais ousado: invadir o centro do palÃ¡cio para descobrir o segredo do poder do Senhor Soberano e destruÃ­-lo. Mas para ter sucesso, Kel vai depender tambÃ©m da determinaÃ§Ã£o de uma heroÃ­na improvÃ¡vel, uma menina de rua que precisa aprender a confiar em novos amigos e dominar seus poderes.', '5.00', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_status`
--

DROP TABLE IF EXISTS `tb_status`;
CREATE TABLE IF NOT EXISTS `tb_status` (
  `id` int(11) NOT NULL,
  `cd_status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_status`
--

INSERT INTO `tb_status` (`id`, `cd_status`) VALUES
(1, 'AGUARDANDO PAGAMENTO'),
(2, 'PAGAMENTO EM ANALIZE'),
(3, 'PAGAMENTO APROVADO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `idTicket` int(11) NOT NULL,
  `assunto` varchar(50) NOT NULL,
  `descrição` varchar(300) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `statusticket` varchar(45) DEFAULT NULL,
  `respostaadmin` varchar(300) DEFAULT NULL,
  `administrador_idAdmin` int(11) NOT NULL,
  `usuarios_idusuarios` int(11) NOT NULL,
  `datapostagem` date DEFAULT NULL,
  PRIMARY KEY (`idTicket`),
  KEY `fk_Ticket_administrador1_idx` (`administrador_idAdmin`),
  KEY `fk_Ticket_usuarios1_idx` (`usuarios_idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `cidade` varchar(55) DEFAULT NULL,
  `cep` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nome`, `sobrenome`, `email`, `cidade`, `cep`, `estado`, `cpf`, `cnpj`, `endereco`, `complemento`, `senha`, `foto`) VALUES
(1, 'Gabriel', 'Olimpio', 'gabriel@gmail.com', 'Itanhaem', 11740000, 'SP', NULL, NULL, 'Gino arduini  391 Umuarama', 'em frente a deciclo', '236', 'banco de dados/imagem/1/pp.jpg'),
(2, 'Rafael', 'Olimpio', 'faelmilk@gmail.com', 'Itanhaem', 11740000, 'SP', NULL, NULL, 'rua gino arduini 391 umuarama', 'em frente a deciclo', '236', '../banco de dados/imagem/2/004.jpg'),
(3, 'Thais', 'Vieira', 'thaisoliiveira1999@gmail.com', 'ItanhaÃ©m', 11740000, 'SP', NULL, NULL, 'av.: Abelardo MendonÃ§a de Oliveira 46', 'Casa', '411080', 'banco de dados/imagem/3/1430510481288.jpg'),
(4, 'jaco', 'souza', 'jacozica@hotmail.com', 'ItanhaÃ©m', 0, 'SP', NULL, NULL, 'Albert0 Barbosa 580, casa', 'casa', 'jaco', '../banco de dados/imagem/user.png'),
(5, 'Maria', 'Bispo', 'bispomaria@gmail.com', 'itanhaem', 0, 'SP', NULL, NULL, 'gino arduini 391', 'umuarama', '236', '../banco de dados/imagem/user.png'),
(8, 'Maicao', 'silva', 'maico@gmail.com', 'ItanhaÃ©m', 0, 'SP', NULL, NULL, 'Albert0 Barbosa 580, casa', 'casa', 'maico', '../banco de dados/imagem/user.png'),
(9, 'alissa', 'pinto', 'alissa', 'campinas', 0, 'SP', NULL, NULL, 'jo fernado', 'casa', '123456', 'banco de dados/imagem/9/CASA GRANDE E SENZALA'),
(11, 'bu', 'na', 'bu@gmail.com', 'a', 0, 'b', NULL, NULL, 'ab.590', 'af', '123456', 'banco de dados/imagem/11/a.jpg'),
(12, 'Mauro', 'Antonio', 'mauro@gmail.com', 'Itanhaem', 11740000, 'SP', NULL, NULL, 'asdkhlsld', 'adasfdga', '236', '../banco de dados/imagem/user.png'),
(13, 'Allanis Maiyumi', 'Simabuku', 'allanissimabuku@hotmail.com', 'Toulouse', 0, 'Haute-Garone', NULL, NULL, '122 Av de Lavaur', 'Apt', 'aaronetmaiyumi1792', '../banco de dados/imagem/user.png'),
(14, 'Gburis', 'Play', 'gburis@gmail.com', 'Itanhaem', 11740000, 'SP', '466166832800', NULL, 'Rua Gino Arduini 391 Umuarama', 'em frente ao bar do branco', '236', '../banco de dados/imagem/user.png'),
(15, 'exemplo', 'sobrenome', 'exemplo@exemplo.com', 'cidade', 1124501564, 'Estado', '15695165016', NULL, 'EndereÃ§o', '', '123', '../banco de dados/imagem/user.png');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_comentario1` FOREIGN KEY (`comentario_idcomentario`,`comentario_postagem_idpostagem`) REFERENCES `comentario` (`idcomentario`, `postagem_idpostagem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_avaliacao_usuarios1` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_postagem` FOREIGN KEY (`postagem_idpostagem`) REFERENCES `postagem` (`idpostagem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_usuarios1` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `fk_postagem_administrador1` FOREIGN KEY (`administrador_idusuarios`) REFERENCES `administrador` (`idAdmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_postagem_usuarios1` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_compra`
--
ALTER TABLE `tb_compra`
  ADD CONSTRAINT `tb_compra_ibfk_1` FOREIGN KEY (`cd_produto`) REFERENCES `tb_postagem` (`id_postagem`),
  ADD CONSTRAINT `tb_compra_ibfk_2` FOREIGN KEY (`cd_comprador`) REFERENCES `usuarios` (`idusuarios`),
  ADD CONSTRAINT `tb_compra_ibfk_3` FOREIGN KEY (`cd_status`) REFERENCES `tb_status` (`id`),
  ADD CONSTRAINT `tb_compra_ibfk_4` FOREIGN KEY (`cd_vendedor`) REFERENCES `usuarios` (`idusuarios`);

--
-- Restrições para tabelas `tb_postagem`
--
ALTER TABLE `tb_postagem`
  ADD CONSTRAINT `tb_postagem_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuarios`);

--
-- Restrições para tabelas `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_Ticket_administrador1` FOREIGN KEY (`administrador_idAdmin`) REFERENCES `administrador` (`idAdmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ticket_usuarios1` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
