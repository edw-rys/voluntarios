-- DB: GestionVoluntarios
-- Tabla: Usuarios-> Password (nvarchar(100))

ALTER TABLE [GestionVoluntarios].[dbo].[tbwbUsuarios]  ADD password nVarchar(100) NULL ;

-- Edit table voluntario
CREATE TABLE [GestionVoluntarios].[dbo].[tbwbPeriodoVoluntario] (
    [id] int IDENTITY(1,1) PRIMARY KEY,
    [voluntario_id] int,
	[universidad_id] int ,
	[facultad_id] int,
	[carrera] varchar(70),
	[nivel] varchar(50),
	[tutor] varchar(50),
    [unidad_id] int,
    [departamento_id] int,
    [proyecto] varchar(100),
    [tutor_bspi_id] int,
	[tutor_bspi_nombre] varchar(100),
    [fecha_inicio] date,
    [fecha_fin] date,
    [horas_programada] int,
    [alimentacion_id] int,
	[horario_voluntario_id] int,
    [tipo_practica_id] int,
	[horario]	varchar(40),
    status int default 1
);


-- Horas

CREATE TABLE [GestionVoluntarios].[dbo].[tbwbHorasDias] (
    [id] int IDENTITY(1,1) PRIMARY KEY,
    [hora_inicio] int,
	[hora_fin] int ,
	[detalle] varchar(50),
    status int default 1
);
INSERT INTO [GestionVoluntarios].[dbo].[tbwbHorasDias] (hora_inicio, hora_fin, detalle)VALUES
(0, 1 ,'00:00 - 01:00'),
(1, 2 ,'01:00 - 02:00'),
(2, 3 ,'02:00 - 03:00'),
(3, 4 ,'03:00 - 04:00'),
(4, 5 ,'04:00 - 05:00'),
(5, 6 ,'05:00 - 06:00'),
(6, 7 ,'06:00 - 07:00'),
(7, 8 ,'07:00 - 08:00'),
(8, 9 ,'08:00 - 09:00'),
(9, 10 ,'09:00 - 10:00'),
(10, 11 ,'10:00 - 11:00'),
(11, 12 ,'11:00 - 12:00'),
(12, 13 ,'12:00 - 13:00'),
(13, 14 ,'13:00 - 14:00'),
(14, 15 ,'14:00 - 15:00'),
(15, 16 ,'15:00 - 16:00'),
(16, 17 ,'16:00 - 17:00'),
(17, 18 ,'17:00 - 18:00'),
(18, 19 ,'18:00 - 19:00'),
(19, 20 ,'19:00 - 20:00'),
(20, 21 ,'20:00 - 21:00'),
(21, 22 ,'21:00 - 22:00'),
(22, 23 ,'22:00 - 23:00'),
(23, 0,'23:00 - 00:00');


CREATE TABLE [GestionVoluntarios].[dbo].[tbwbHorarioVoluntario] (
    [id] int IDENTITY(1,1) PRIMARY KEY,
	[voluntario_id] int,
	[lunes_data] varchar(300),
	[martes_data] varchar(300),
	[miercoles_data] varchar(300),
	[jueves_data] varchar(300),
	[viernes_data] varchar(300),
	[sabado_data] varchar(300),
	[domingo_data] varchar(300),
    status int default 1
);

ALTER TABLE [GestionVoluntarios].[dbo].[tbwbEvaluacionAlVoluntario]  ADD periodo_id int NULL ;


  INSERT INTO [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION] (
  [empresa]
      ,[sucursal]
      ,[modulo]
      ,[descripcion]
      ,[imagen]
      ,[tipo]
      ,[ejecutable]
      ,[usuario_ingreso]
      ,[fecha_ingreso]
      ,[usuario_modificacion]
      ,[fecha_modificacion]
      ,[pcname]
      ,[status]
  ) values 
  ( 1,1,1,'Todos los tutores', '.',1,'all_totor_bspi',1,'2014-04-24 15:21:00',1,'2014-04-24 15:21:00','PROFESIONAL-PC',1 ),
  (1,1,1,'Todos los departamentos', '.',1,'all_departments',1,'2014-04-24 15:21:00',1,'2014-04-24 15:21:00','PROFESIONAL-PC',1 );

  INSERT INTO [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL](
  [empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status] 
  ) VALUES 
  (1,1,1,1,31,1,1),(1,1,1,1,32,1,1);


ALTER TABLE [GestionVoluntarios].[dbo].[tbwbVoluntario]  ADD dato_viejo int default 1 ;
 
insert into  [GestionVoluntarios].[dbo].[SG_PERFIL] 
  ( [descripcion]
      ,[abreviatura]
      ,[usuario_ingreso]
      ,[fecha_ingreso]
      ,[status],[usuario_modificacion] ,[fecha_modificacion],[pcname] ) values 
  ('Talento Humano', 'RRH', 1, '2020-11-10 00:00:00', 1 ,1, '2020-11-10 00:00:00', 'pc'),
  ('Jefe de Departamento', 'JDP', 1, '2020-11-10 00:00:00', 1 ,1, '2020-11-10 00:00:00','pc');


  
  insert into  [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION] (
  [empresa]
      ,[sucursal]
      ,[modulo]
      ,[descripcion]
      ,[imagen]
      ,[tipo]
      ,[ejecutable]
      ,[usuario_ingreso]
      ,[fecha_ingreso]
      ,[status]) values
      (1,1,1,'Todos los voluntarios' ,'', 4,'all_voluntarios',1 ,'2018-01-30 00:00:00',1)

-- PROD
   -- Super usuario

insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values(1, 1, 2, 1, 28, 1, 1),
      (1, 1, 1, 2, 29, 1, 1),
      (1, 1, 1, 2, 30, 1, 1),
	  (1, 1, 1, 2, 31, 1, 1),
	  (1, 1, 1, 2, 32, 1, 1),
	  (1, 1, 1, 2, 33, 1, 1),
	  (1, 1, 1, 2, 34, 1, 1),
	  (1, 1, 1, 2, 35, 1, 1),
	  (1, 1, 1, 2, 36, 1, 1),
	  (1, 1, 1, 2, 37, 1, 1),
	  (1, 1, 1, 2, 38, 1, 1),
	  (1, 1, 1, 2, 39, 1, 1),
      (1, 1, 1, 2, 40, 1, 1),
      (1, 1, 1, 2, 41, 1, 1);


-- Admin
insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values(1, 1, 1, 1, 28, 1, 1),
      (1, 1, 1, 1, 29, 1, 1),
      (1, 1, 1, 1, 30, 1, 1),
	  (1, 1, 1, 1, 31, 1, 1),
	  (1, 1, 1, 1, 34, 1, 1),
	  (1, 1, 1, 1, 35, 1, 1),
	  (1, 1, 1, 1, 36, 1, 1),
      (1, 1, 1, 1, 40, 1, 1),
      (1, 1, 1, 1, 41, 1, 1);

-- talento humano

insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values
	  (1, 1, 4, 1, 31, 1, 1),
	  (1, 1, 4, 1, 32, 1, 1),
	  (1, 1, 4, 1, 33, 1, 1),
	  (1, 1, 4, 1, 36, 1, 1),
	  (1, 1, 4, 1, 38, 1, 1),
	  (1, 1, 4, 1, 39, 1, 1),
      (1, 1, 4, 1, 40, 1, 1);


-- Jefe departamento
insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values
	  (1, 1, 5, 1, 30, 1, 1),
	  (1, 1, 5, 1, 31, 1, 1),
	  (1, 1, 5, 1, 33, 1, 1),
	  (1, 1, 5, 1, 34, 1, 1),
	  (1, 1, 5, 1, 35, 1, 1),
	  (1, 1, 5, 1, 36, 1, 1),
	  (1, 1, 5, 1, 37, 1, 1),
	  (1, 1, 5, 1, 38, 1, 1),
      (1, 1, 5, 1, 40, 1, 1);














-- DESA


insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[modulo]
      ,[perfil]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values(1, 1, 2, 1, 31, 1, 1),
      (1, 1, 1, 2, 32, 1, 1),
      (1, 1, 1, 2, 33, 1, 1),
	  (1, 1, 1, 2, 34, 1, 1),
	  (1, 1, 1, 2, 35, 1, 1),
	  (1, 1, 1, 2, 36, 1, 1),
	  (1, 1, 1, 2, 37, 1, 1),
	  (1, 1, 1, 2, 38, 1, 1),
	  (1, 1, 1, 2, 39, 1, 1),
	  (1, 1, 1, 2, 40, 1, 1),
	  (1, 1, 1, 2, 41, 1, 1),
	  (1, 1, 1, 2, 42, 1, 1),
      (1, 1, 1, 2, 43, 1, 1),
      (1, 1, 1, 2, 44, 1, 1);



-- Admin
insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values(1, 1, 1, 1, 31, 1, 1),
      (1, 1, 1, 1, 32, 1, 1),
      (1, 1, 1, 1, 33, 1, 1),
	  (1, 1, 1, 1, 34, 1, 1),
	  (1, 1, 1, 1, 37, 1, 1),
	  (1, 1, 1, 1, 38, 1, 1),
	  (1, 1, 1, 1, 39, 1, 1),
      (1, 1, 1, 1, 43, 1, 1),
      (1, 1, 1, 1, 44, 1, 1);

-- talento humano

insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values
	  (1, 1, 10, 1, 34, 1, 1),
	  (1, 1, 10, 1, 35, 1, 1),
	  (1, 1, 10, 1, 36, 1, 1),
	  (1, 1, 10, 1, 39, 1, 1),
	  (1, 1, 10, 1, 41, 1, 1),
	  (1, 1, 10, 1, 42, 1, 1),
      (1, 1, 10, 1, 43, 1, 1);


-- Jefe departamento
insert into [GestionVoluntarios].[dbo].[SG_OPCION_APLICACION_POR_PERFIL] ([empresa]
      ,[sucursal]
      ,[perfil]
      ,[modulo]
      ,[opcion_aplicacion]
      ,[superior]
      ,[status])
      values
	  (1, 1, 11, 1, 33, 1, 1),
	  (1, 1, 11, 1, 34, 1, 1),
	  (1, 1, 11, 1, 36, 1, 1),
	  (1, 1, 11, 1, 37, 1, 1),
	  (1, 1, 11, 1, 38, 1, 1),
	  (1, 1, 11, 1, 39, 1, 1),
	  (1, 1, 11, 1, 40, 1, 1),
	  (1, 1, 11, 1, 41, 1, 1),
      (1, 1, 11, 1, 43, 1, 1);