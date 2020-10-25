-- DB: GestionVoluntarios
-- Tabla: Usuarios-> Password (nvarchar(100))
ALTER TABLE [GestionVoluntarios].[dbo].[tbwbUsuarios] ALTER COLUMN Password nVarchar(100);


-- ADD table
CREATE TABLE [GestionVoluntarios].[dbo].[tbwbTipoVoluntario] (
    id int IDENTITY(1,1) PRIMARY KEY,
    Nombre varchar(255),
    status int
);

-- Edit table voluntario
-- no ALTER TABLE [GestionVoluntarios].[dbo].[tbwbVoluntario]  ADD tipo_voluntario_id int NULL ;
-- no ALTER TABLE [GestionVoluntarios].[dbo].[tbwbVoluntario]  ADD CONSTRAINT FK_voluntario_tipo_voluntario_id FOREIGN KEY (tipo_voluntario_id) REFERENCES [GestionVoluntarios].[dbo].[tbwbTipoVoluntario] (id);
CREATE TABLE [GestionVoluntarios].[dbo].[tbwbPeriodoVoluntario] (
    [id] int IDENTITY(1,1) PRIMARY KEY,
    [voluntario_id] int,
	[universidad_id] int ,
	[facultad_id] int,
	[carrera_id] int,
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
    [dlimentacion_id] int,
    [dlimentacion_id] int,
    status int
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
    [periodo_id] int,
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