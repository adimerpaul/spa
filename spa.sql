create table usuario(
  idusuario int not null auto_increment,
  email varchar(255),
  password varchar(255),
  primary key (idusuario)
);
alter table usuario add tipo varchar(255);

create table paciente(
  idpaciente int not null auto_increment,
  nombres varchar(255),
  apellidos varchar(255),
  zona varchar(255),
  direccion varchar(255),
  fechanac date,
  telefono varchar(255),
  celular varchar(255),
  idusuario int,
  primary key (idpaciente),
  foreign key (idusuario) references usuario(idusuario)
);
create table tratamiento(
  idtratamiento int not null auto_increment,
  nombre varchar(255),
  primary key (idtratamiento)
);

create table pacientetratamiento(
  idpacientetratamiento int not null  auto_increment,
  fecha datetime default current_timestamp,
  idpaciente int,
  idtratamiento int,
  primary key (idpacientetratamiento),
  foreign key (idtratamiento) references tratamiento(idtratamiento),
  foreign key (idpaciente) references paciente(idpaciente)
);

create table medicamento(
  idmedicamento int not null auto_increment,
  nombre varchar(255),
  primary key (idmedicamento)
);

create table receta(
  idreceta int not null auto_increment,
  fecha datetime default current_timestamp,
  idpacientetratamiento int,
  primary key (idreceta),
  foreign key (idpacientetratamiento) references pacientetratamiento(idpacientetratamiento)
);
drop table detalle;
create table detalle(
  idreceta int,
  idmedicamento int,
  cantidad int,
  foreign key (idreceta) references receta(idreceta),
  foreign key (idmedicamento) references medicamento(idmedicamento)
);

drop table foto;
create table foto(
  idfoto int not null auto_increment,
  idpacientetratamiento int,
  primary key (idfoto),
  foreign key (idpacientetratamiento) references pacientetratamiento(idpacientetratamiento)
);


create table historial(
 idpaciente int,
 consulta varchar(255),
 pa varchar (255),
 fc varchar (255),
 peso varchar (255),
 talla varchar (255),
 imc varchar (255),
 gc varchar (255),
 diabetes varchar (255),
 hta varchar (255),
 cardios varchar (255),
 cancer varchar (255),
 quefamilia varchar (255),
 estadocivil varchar (255),
 ocupacion varchar (255),
 fuma varchar (255),
 bebe varchar (255),
 actividadfisica varchar (255),
 sueno varchar (255),
 alimentos varchar (255),
 diuresis varchar (255),
 catarsis varchar (255),
 patologico varchar (255),
 alergias varchar (255),
 tratamientos varchar (255),
 estadopsicologico varchar (255),
 fum varchar (255),
 dias varchar (255),
 frecuencia varchar (255),
 caracteristica varchar (255),
 gestas varchar (255),
 partos varchar (255),
 ab varchar (255),
 cesareas varchar (255),
 lactancia varchar (255),
 nhijos varchar (255),
 menopausia varchar (255),
 pap varchar (255),
 anticonceptivos varchar (255),
 examenmamario varchar (255),
 ptsimamaria varchar (255),
 cremas varchar (255),
 cutis varchar (255),
 donde varchar (255),
 queutilizaron varchar (255),
 sol varchar (255),
 solar varchar (255),
 otros varchar (255),
 alopecia varchar (255),
 depilacion varchar (255),
 piel varchar (255),
 biotipo varchar (255),
 arrugas varchar (255),
 foreign key (idpaciente) references paciente(idpaciente)
)

create table consentimiento(
idconsetimiento int not null auto_increment,
nombre varchar (255),
primary  key (idconsetimiento)
)
create table cotizacionconsetimeinto(
idconsetimiento int not null,
idcotizacion int not null,
foreign key (idconsetimiento) references consentimiento(idconsetimiento),
foreign key (idcotizacion) references cotizacion(idcotizacion)
)