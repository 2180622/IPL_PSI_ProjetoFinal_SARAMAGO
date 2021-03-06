-- DEMO

-- Bibliotecas
INSERT INTO `Biblioteca` (`id`, `codBiblioteca`, `nome`, `notasOpac`, `morada`, `localidade`, `codPostal`, `levantamento`) VALUES
(NUll, 'BAC', 'Biblioteca Alberto Caeiro', '<p><strong>knlkkl</strong></p>\r\n', 'Rua Acácio de Paivam', 'Leiria', 2400076, 1),
(NULL, 'BAN', 'Biblioteca Almada Negreiros', NULL, 'Escadas de Artur Lobo de Campos', 'Leiria', 2400101, 1),
(NUll, 'BAG', 'Biblioteca Almeida Garrett', '<p>Fechado por <strong>tempo inderteminado</strong></p>\r\n', 'R. Almeida Garrett 6', 'Leiria', 2400137, 1),
(NULL, 'BAR', 'Biblioteca Alves Redol', '<p><strong>FECHADO</strong></p>\r\n', 'Rua da Flores ', 'Leiria', 2400000, 1);


-- Tipos de Leitor
INSERT INTO `TipoLeitor` (`id`, `estatuto`, `tipo`, `nItens`, `prazoDias`, `registoOpac`, `notas`) VALUES
(NULL, 'Aluno', 'Aluno', '6', '10', '1', NULL),
(NULL, 'Alunos de Mestrados, Doutoramento e Pós-Graduação', 'Aluno', '10', '15', '1', NULL),
(NULL, 'Docentes, Técnicos e Administrativos', 'Docente', '15', '90', '1', NULL),
(NULL, 'Docentes em Mestrado e Doutoramento', 'Docente', '25', '180', '1', NULL),
(NULL, 'Externo', 'Externo', '5', '10', '1', NULL);

-- Postos de Trabalho
INSERT INTO `PostoTrabalho` (`id`, `designacao`, `totalLugares`, `notaOpac`, `notaInterna`, `Biblioteca_id`) VALUES
(NULL, 'Sala de Estudo A', 10, '', 'teste teste', 1),
(NULL, 'Sala de Estudo B', 10, '', '', 1),
(NULL, 'Sala de Informática', 20, '', '', 2),
(NULL, 'Sala de Informática', 30, '<p>Fechado</p>\r\n', '', 3);

-- Cursos
INSERT INTO `Curso` (`id`, `CodCurso`, `nome`) VALUES
(1, 'LIC', 'Licenciatura em Administração Pública'),
(2, 'LIC', 'Licenciatura em Animação Turística'),
(3, 'LIC', 'Licenciatura em Artes Plásticas'),
(4, 'LIC', 'Licenciatura em Biologia Marinha e Biotecnologia'),
(5, 'LIC', 'Licenciatura em Biomecânica'),
(6, 'LIC', 'Licenciatura em Biotecnologia'),
(7, 'LIC', 'Licenciatura em Ciências da Informação em Saúde'),
(8, 'LIC', 'Licenciatura em Comunicação e Media'),
(9, 'LIC', 'Licenciatura em Contabilidade e Finanças'),
(10, 'LIC', 'Licenciatura em Design de Ambientes'),
(11, 'LIC', 'Licenciatura em Design de Produto – Cerâmica e Vidro'),
(12, 'LIC', 'Licenciatura em Design Gráfico e Multimédia'),
(13, 'LIC', 'Licenciatura em Design Industrial'),
(14, 'LIC', 'Licenciatura em Desporto e Bem-Estar'),
(15, 'LIC', 'Licenciatura em Dietética e Nutrição'),
(16, 'LIC', 'Licenciatura em Educação Básica'),
(17, 'LIC', 'Licenciatura em Educação Social'),
(18, 'LIC', 'Licenciatura em Enfermagem'),
(19, 'LIC', 'Licenciatura em Engenharia Alimentar'),
(20, 'LIC', 'Licenciatura em Engenharia Automóvel'),
(21, 'LIC', 'Licenciatura em Engenharia Civil'),
(22, 'LIC', 'Licenciatura em Engenharia da Energia e do Ambiente'),
(23, 'LIC', 'Licenciatura em Engenharia e Gestão Industrial'),
(24, 'LIC', 'Licenciatura em Engenharia Eletrotécnica e de Computadores'),
(25, 'LIC', 'Licenciatura em Engenharia Informática'),
(26, 'LIC', 'Licenciatura em Engenharia Mecânica'),
(27, 'LIC', 'Licenciatura em Fisioterapia'),
(28, 'LIC', 'Licenciatura em Gestão'),
(29, 'LIC', 'Licenciatura em Gestão da Restauração e Catering'),
(30, 'LIC', 'Licenciatura em Gestão de Eventos'),
(31, 'LIC', 'Licenciatura em Gestão Turística e Hoteleira'),
(32, 'LIC', 'Licenciatura em Jogos Digitais e Multimédia'),
(33, 'LIC', 'Licenciatura em Língua Portuguesa Aplicada'),
(34, 'LIC', 'Licenciatura em Marketing'),
(35, 'LIC', 'Licenciatura em Marketing Turístico'),
(36, 'LIC', 'Licenciatura em Programação e Produção Cultural'),
(37, 'LIC', 'Licenciatura em Relações Humanas e Comunicação Organizacional'),
(38, 'LIC', 'Licenciatura em Serviço Social'),
(39, 'LIC', 'Licenciatura em Solicitadoria'),
(40, 'LIC', 'Licenciatura em Som e Imagem'),
(41, 'LIC', 'Licenciatura em Teatro'),
(42, 'LIC', 'Licenciatura em Terapia da Fala'),
(43, 'LIC', 'Licenciatura em Terapia Ocupacional'),
(44, 'LIC', 'Licenciatura em Tradução e Interpretação Português/Chinês – Chinês/Português'),
(45, 'LIC', 'Licenciatura em Turismo'),
(46, 'MEST', 'Mestrado em Administração Pública'),
(47, 'MEST', 'Mestrado em Applied Biotechnology (Lecionado em inglês)'),
(48, 'MEST', 'Mestrado em Aquacultura'),
(49, 'MEST', 'Mestrado em Artes do Som e Imagem'),
(50, 'MEST', 'Mestrado em Artes Plásticas'),
(51, 'MEST', 'Mestrado em Biotecnologia dos Recursos Marinhos'),
(52, 'MEST', 'Mestrado em Cibersegurança e Informática Forense'),
(53, 'MEST', 'Mestrado em Ciências da Educação – Especialização em Educação e Desenvolvimento Comunitário'),
(54, 'MEST', 'Mestrado em Ciências da Educação – Gestão Escolar'),
(55, 'MEST', 'Mestrado em Comunicação Acessível'),
(56, 'MEST', 'Mestrado em Comunicação e Media'),
(57, 'MEST', 'Mestrado em Controlo de Gestão'),
(58, 'MEST', 'Mestrado em Design de Produto'),
(59, 'MEST', 'Mestrado em Design Gráfico/Graphic Design (Lecionado em português e em inglês)'),
(60, 'MEST', 'Mestrado em Design para a Saúde e Bem-Estar'),
(61, 'MEST', 'Mestrado em Desporto e Saúde para Crianças e Jovens'),
(62, 'MEST', 'Mestrado em Educação Especial – Domínio Cognitivo–Motor'),
(63, 'MEST', 'Mestrado em Educação Pré-Escolar'),
(64, 'MEST', 'Mestrado em Educação Pré-Escolar e Ensino do 1.º Ciclo do Ensino Básico'),
(65, 'MEST', 'Mestrado em Enfermagem Comunitária – Área de Enfermagem de Saúde Familiar'),
(66, 'MEST', 'Mestrado em Enfermagem de Saúde Mental e Psiquiátrica'),
(67, 'MEST', 'Mestrado em Enfermagem Médico-Cirúrgica'),
(68, 'MEST', 'Mestrado em Engenharia Alimentar'),
(69, 'MEST', 'Mestrado em Engenharia Automóvel'),
(70, 'MEST', 'Mestrado em Engenharia Civil-Construções Civis/Civil Engineering-Building Construction (Lecionado em português e em inglês)'),
(71, 'MEST', 'Mestrado em Engenharia da Energia e do Ambiente'),
(72, 'MEST', 'Mestrado em Engenharia Eletrotécnica/Electrical and Electronic Engineering (Lecionado em português e em inglês)'),
(73, 'MEST', 'Mestrado em Engenharia Informática-Computação Móvel/Computer Engineering-Mobile Computing (Lecionado em português e em inglês)'),
(74, 'MEST', 'Mestrado em Engenharia Mecânica – Produção Industrial'),
(75, 'MEST', 'Mestrado em Engenharia para Fabricação Digital Direta'),
(76, 'MEST', 'Mestrado em Ensino do 1.º CEB e de Português, História e Geografia de Portugal no 2.º CEB'),
(77, 'MEST', 'Mestrado em Ensino do 1.º Ciclo do Ensino Básico'),
(78, 'MEST', 'Mestrado em Ensino do 1º CEB e de Matemática e Ciências Naturais no 2º CEB'),
(79, 'MEST', 'Mestrado em Finanças Empresariais'),
(80, 'MEST', 'Mestrado em Gastronomia'),
(81, 'MEST', 'Mestrado em Gestão'),
(82, 'MEST', 'Mestrado em Gestão Cultural'),
(83, 'MEST', 'Mestrado em Gestão da Qualidade e Segurança Alimentar'),
(84, 'MEST', 'Mestrado em Gestão e Direção Hoteleira'),
(85, 'MEST', 'Mestrado em Healthcare Information Systems Management (Lecionado em inglês)'),
(86, 'MEST', 'Mestrado em International Business(Lecionado em inglês)'),
(87, 'MEST', 'Mestrado em Intervenção e Animação Artísticas'),
(88, 'MEST', 'Mestrado em Marketing e Promoção Turística'),
(89, 'MEST', 'Mestrado em Marketing Relacional'),
(90, 'MEST', 'Mestrado em Mediação Intercultural e Intervenção Social'),
(91, 'MEST', 'Mestrado em Prescrição do Exercício e Promoção da Saúde'),
(92, 'MEST', 'Mestrado em Product Design Engineering (Lecionado em inglês)'),
(93, 'MEST', 'Mestrado em Solicitadoria de Empresa'),
(94, 'MEST', 'Mestrado em Sustainable Tourism Management (Lecionado em inglês)'),
(95, 'MEST', 'Mestrado em Turismo e Ambiente'),
(96, 'MEST', 'Mestrado em Utilização Pedagógica das TIC'),
(97, 'PG', 'Pós-Graduação em 6 Sigma ao Nível de Black Belt – 13ª Edição'),
(98, 'PG', 'Pós-Graduação em Auditores de HACCP'),
(99, 'PG', 'Pós-Graduação em Auditoria e Relato Financeiro'),
(100, 'PG', 'Pós-Graduação em Desporto e Atividade Física Adaptados'),
(101, 'PG', 'Pós-Graduação em Direção de Organizações de Intervenção Social'),
(102, 'PG', 'Pós-Graduação em Direito do Consumo'),
(103, 'PG', 'Pós-Graduação em Direito do Urbanismo e do Ambiente'),
(104, 'PG', 'Pós-Graduação em Enfermagem do Trabalho'),
(105, 'PG', 'Pós-Graduação em Especialização em Terapia da Mão'),
(106, 'PG', 'Pós-Graduação em Fiscalidade'),
(107, 'PG', 'Pós-Graduação em Gestão de Negócios Online'),
(108, 'PG', 'Pós-Graduação em Gestão de Projetos – 4.ª Edição'),
(109, 'PG', 'Pós-Graduação em Informática de Segurança e Computação Forense'),
(110, 'PG', 'Pós-Graduação em Liderança e Gestão para PME'),
(111, 'PG', 'Pós-Graduação em Marketing Digital'),
(112, 'PG', 'Pós-Graduação em Registos e Notariado'),
(113, 'PG', 'Pós-Graduação em Sistemas de Informação Geográfica'),
(114, 'PG', 'Pós-Graduação em Sistemas Integrados de Gestão – Qualidade, Ambiente, Energia e Segurança'),
(115, 'PG', 'Pós-Graduação em Wine Business – 2.ª Edição'),
(116, 'PG', 'Pós-Licenciatura de Especialização em Enfermagem de Saúde Infantil e Pediatria'),
(117, 'PG', 'Pós-Licenciatura de Especialização em Enfermagem de Saúde Mental e Psiquiatria'),
(118, 'TESP', 'TeSP de Alimentação Saudável'),
(119, 'TESP', 'TeSP de Ambiente, Património e Turismo Sustentável'),
(120, 'TESP', 'TeSP de Análises Laboratoriais'),
(121, 'TESP', 'TeSP de Animação em Turismo de Natureza e Aventura'),
(122, 'TESP', 'TeSP de Apoio à Gestão'),
(123, 'TESP', 'TeSP de Aquacultura e Recursos Marinhos'),
(124, 'TESP', 'TeSP de Audiovisual e Multimédia'),
(125, 'TESP', 'TeSP de Automação, Robótica e Manutenção Industrial'),
(126, 'TESP', 'TeSP de Comunicação Digital'),
(127, 'TESP', 'TeSP de Construção Civil'),
(128, 'TESP', 'TeSP de Cozinha e Produção Alimentar'),
(129, 'TESP', 'TeSP de Desenvolvimento Web e Multimédia'),
(130, 'TESP', 'TeSP de Design para Media Digitais'),
(131, 'TESP', 'TeSP de Eletrónica e Redes de Telecomunicações'),
(132, 'TESP', 'TeSP de Energias Renováveis e Eficiência Energética'),
(133, 'TESP', 'TeSP de Estética, Cosmética e Bem-Estar'),
(134, 'TESP', 'TeSP de Fabricação Automática'),
(135, 'TESP', 'TeSP de Gerontologia'),
(136, 'TESP', 'TeSP de Gestão da Qualidade'),
(137, 'TESP', 'TeSP de Gestão dos Negócios Internacionais'),
(138, 'TESP', 'TeSP de Gestão e Tecnologias Avançadas em Recursos Minerais'),
(139, 'TESP', 'TeSP de Gestão Energética e Ambiental'),
(140, 'TESP', 'TeSP de Gestão Hoteleira e Alojamento'),
(141, 'TESP', 'TeSP de Ilustração e Produção Gráfica'),
(142, 'TESP', 'TeSP de Inovação e Tecnologia Alimentar'),
(143, 'TESP', 'TeSP de Intervenção em Espaços Educativos'),
(144, 'TESP', 'TeSP de Intervenção Social e Comunitária'),
(145, 'TESP', 'TeSP de Intervenção Sociocultural e Desportiva'),
(146, 'TESP', 'TeSP de Marketing Digital no Turismo'),
(147, 'TESP', 'TeSP de Práticas Administrativas e Comunicação Empresarial'),
(148, 'TESP', 'TeSP de Processo Industrial'),
(149, 'TESP', 'TeSP de Processos de Transformação de Plásticos'),
(150, 'TESP', 'TeSP de Produção de Construções Metálicas'),
(151, 'TESP', 'TeSP de Produção Industrial e Desenvolvimento de Produto – Cerâmica e Vidro'),
(152, 'TESP', 'TeSP de Produtos de Apoio em Saúde'),
(153, 'TESP', 'TeSP de Programação de Sistemas de Informação'),
(154, 'TESP', 'TeSP de Projeto de Moldes'),
(155, 'TESP', 'TeSP de Prototipagem Digital e Desenho 3D'),
(156, 'TESP', 'TeSP de Redes e Sistemas Informáticos'),
(157, 'TESP', 'TeSP de Secretariado Clínico'),
(158, 'TESP', 'TeSP de Serviços Jurídicos'),
(159, 'TESP', 'TeSP de Sistemas de Informação e Modelação do Espaço Urbano'),
(160, 'TESP', 'TeSP de Sistemas Eletromecânicos'),
(161, 'TESP', 'TeSP de Tecnologia Automóvel'),
(162, 'TESP', 'TeSP de Tecnologias Informáticas'),
(163, 'TESP', 'TeSP de Veículos Elétricos e Híbridos');

