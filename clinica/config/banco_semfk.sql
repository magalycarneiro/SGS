create database sgs;
use sgs;

create table funcionarios (
    idfuncionario int primary key auto_increment,
    nome varchar(100),
    cpf varchar(14) unique,
    data_nascimento date,
    telefone varchar(45),
    email varchar(100) unique,
    cargo enum('Médico', 'Secretário'),
    idmedico int unique,
    idsecretaria int unique
);

create table secretaria (
    idsecretaria int primary key auto_increment,
    nome varchar(100),
    cpf varchar(14) unique,
    data_nascimento date,
    telefone varchar(45),
    email varchar(100) unique
);

create table medico (
    idmedico int primary key auto_increment,
    nome varchar(100),
    crm varchar(12) unique,
    especialidade varchar(45),
    idfuncionario int unique
);

create table paciente (
    idpaciente int primary key auto_increment,
    nome varchar(100),
    cpf varchar(14) unique,
    data_nascimento date,
    telefone varchar(45),
    email varchar(100) unique,
    endereco varchar(100)
);

create table prontuario (
    idprontuario int primary key auto_increment,
    nomepaciente varchar(100),
    prescricao varchar(200),
    observacoes varchar(200),
    diagnostico varchar(100),
	atestado varchar(100),
    encaminhamento varchar(200),
    antecedentes varchar(200),
    solicitacaoexames varchar(300),
    exames varchar(200)
);

create table consulta (
    idconsulta int primary key auto_increment,
    data_hora datetime,
    status varchar(45),
    idmedico varchar(45),
    idprontuario varchar(45),
    idsecretaria int,
    idpaciente varchar(45)
);
select * from consulta;
create table pacientemedico (
    idmedico int,
    idpaciente int,
    primary key (idmedico, idpaciente)
);

create table agendamentos (
    id INTEGER PRIMARY KEY auto_increment,
    medico text,
    data text,
    hora text,
    especialidade text
);

