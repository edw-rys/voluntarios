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