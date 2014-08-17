CREATE DATABASE IF NOT EXISTS syscap DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE syscap;

CREATE TABLE IF NOT EXISTS departamentos /*ETL obtenido de la tabla mdl_cat_deptos*/ (
	id_departamento INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	nombre_departamento VARCHAR(255) NOT NULL,	/*ETL obtenido del campo deptos*/
	PRIMARY KEY	(id_departamento)
) ENGINE=MyISAM	DEFAULT CHARSET=latin1 COMMENT='Catalogo de nombres de los departamentos de El Salvador' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS centros_educativos /*ETL obtenido de la tabla mdl_cat_educativa*/ (
	id_centro_educativo INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	codigo_centro_educativo VARCHAR(5) NOT NULL,	/*ETL obtenido del campo codigo_entidad*/
	nombre_centro_educativo VARCHAR(150) DEFAULT NULL,	/*ETL* obtenido del campo nombre*/
	telefono_centro_educativo VARCHAR(12) DEFAULT NULL,	/*ETL obtenido del campo tel_escuela*/
	id_departamento INT(4) UNSIGNED NOT NULL,	/*ETL obtenido del campo depto*/
	id_municipio INT(4) UNSIGNED NOT NULL,	/*ETL* obtenido del campo muni*/
	PRIMARY KEY (id_centro_educativo)
) ENGINE=MyISAM	DEFAULT CHARSET=latin1 COMMENT='Catalogo de centros educativos' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS municipios /*ETL obtenido de la tabla mdl_cat_municip*/ (
	id_municipio INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	id_departamento INT(4) UNSIGNED NOT NULL,	/*ETL obtenido del campo relacion*/
	nombre_municipio VARCHAR(255) NOT NULL,	/*ETL obtenido del campo opcion*/
	PRIMARY KEY	(id_municipio)
) ENGINE=MyISAM	DEFAULT CHARSET=latin1 COMMENT='Catalogo de nombres de los municipios de El Salvador' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS niveles_estudios /*ETL obtenido de la tabla mdl_cat_nestudio*/ (
	id_nivel_estudio INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo cod_nestudio*/
	nombre_nivel_estudio VARCHAR(100) NOT NULL,	/*ETL obtenido del campo descripcion*/
	PRIMARY KEY (id_nivel_estudio)
) ENGINE=MyISAM	DEFAULT CHARSET=latin1 COMMENT='Catalogo de niveles de estudios' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS matriculas /*ETL obtenido de la tabla mdl_context*/ (
	id_matricula BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	id_curso BIGINT(10) UNSIGNED NOT NULL,	/*ETL obtenido del campo instanceid*/
	PRIMARY KEY	(id_matricula)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Informacion de las matriculas de usuarios con cursos' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS cursos /*ETL obtenido de la tabla mdl_course*/ (
	id_curso BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	nombre_completo_curso VARCHAR(255) NOT NULL,	/*ETL obtenido del campo fullname*/
	nombre_corto_curso VARCHAR(100) NOT NULL,	/*ETL obtenido del campo shortname*/
	PRIMARY KEY	(id_curso)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Informacion central de los cursos' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS examenes /*ETL obtenido de la tabla mdl_quiz*/ (
	id_examen BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	id_curso BIGINT(10) UNSIGNED NOT NULL,	/*ETL obtenido del campo course*/
	nombre_examen VARCHAR(255) NOT NULL,	/*ETL obtenido del campo name*/
	PRIMARY KEY	(id_examen)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Informacion principal de cada examen' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS examenes_calificaciones /*ETL obtenido de la tabla mdl_quiz_grades*/ (
	id_examen_calificacion BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	id_examen BIGINT(10) UNSIGNED NOT NULL,	/*ETL obtenido del campo quiz*/
	id_usuario BIGINT(10) UNSIGNED NOT NULL,	/*ETL obtenido del campo userid*/
	nota_examen_calificacion DOUBLE NOT NULL,	/*ETL obtenido del campo grade*/
	PRIMARY KEY	(id_examen_calificacion)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Informacion de la nota de cada examen final' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS roles /*ETL obtenido de la tabla mdl_role*/ (
	id_rol INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	nombre_completo_rol VARCHAR(255) NOT NULL,	/*ETL obtenido del campo name*/
	nombre_corto_rol VARCHAR(100) NOT NULL,	/*ETL obtenido del campo shortname*/
	descripcion_rol text NOT NULL,	/*ETL obtenido del campo description*/
	criterio_rol INT(4) UNSIGNED NOT NULL DEFAULT '0',	/*ETL obtenido del campo sortorder*/
	PRIMARY KEY	(id_rol)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Catalogo de roles de moodle' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS roles_asignados /*ETL obtenido de la tabla mdl_role_assignments*/ (
	id_rol_asignado BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	id_rol INT(4) UNSIGNED NOT NULL,	/*ETL obtenido del campo roleid*/
	id_matricula BIGINT(10) UNSIGNED NOT NULL,	/*ETL obtenido del campo contextid*/
	id_usuario BIGINT(10) UNSIGNED NOT NULL,	/*ETL obtenido del campo userid*/
	PRIMARY KEY	(id_rol_asignado)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Informacion de la asignacion de funciones a diferentes contexts' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS usuarios /*ETL obtenido de la tabla mdl_user*/ (
	id_usuario BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,	/*ETL obtenido del campo id*/
	nombre_usuario VARCHAR(100) NOT NULL,	/*ETL obtenido del campo username*/
	contrasena_usuario VARCHAR(32) NOT NULL,	/*ETL obtenido del campo password*/
	id_tipo_usuario INT(4) NOT NULL,	/*ETL obtenido del campo tipo*/
	nombres_usuario VARCHAR(100) NOT NULL,	/*ETL obtenido del campo firstname*/
	apellido1_usuario VARCHAR(100) NOT NULL,	/*ETL obtenido del campo lastname*/
	apellido2_usuario VARCHAR(100) DEFAULT NULL,	/*ETL obtenido del campo apellido2*/
	dui_usuario VARCHAR(10) DEFAULT NULL,	/*ETL obtenido del campo dui*/
	sexo_usuario CHAR(2) NOT NULL,	/*ETL obtenido del campo sexo*/
	profesion_usuario VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,	/*ETL obtenido del campo profesion*/
	id_nivel_estudio INT(4) DEFAULT NULL,	/*ETL obtenido del campo nestudio*/
	correo_electronico_usuario VARCHAR(100) NOT NULL,	/*ETL obtenido del campo email*/
	telefono1_usuario VARCHAR(12) DEFAULT NULL,	/*ETL obtenido del campo phone1*/
	telefono2_usuario VARCHAR(12) DEFAULT NULL,	/*ETL obtenido del campo phone2*/
	id_centro_educativo INT(10) DEFAULT NULL,	/*ETL obtenido del campo institution*/
	id_departamento INT(4) UNSIGNED NOT NULL,	/*ETL obtenido del campo deptorec*/
	id_municipio INT(4) UNSIGNED NOT NULL,	/*ETL obtenido del campo munirec*/
	pais_usuario CHAR(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,	/*ETL obtenido del campo country*/
	direccion_usuario VARCHAR(200) DEFAULT NULL,	/*ETL obtenido del campo address*/
	ciudad_usuario VARCHAR(20) NOT NULL,	/*ETL obtenido del campo city*/
	fecha_nacimiento_usuario DATE DEFAULT NULL,	/*ETL obtenido del campo fecha*/
	PRIMARY KEY	(id_usuario)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Informacion de usuarios' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS bitacoras (
	id_bitacora BIGINT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	id_usuario BIGINT(10) UNSIGNED NOT NULL,
	fecha_bitacora DATETIME NOT NULL,
	accion_bitacora VARCHAR(255) NOT NULL,
	PRIMARY KEY	(id_bitacora)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Informacion de las acciones realizadas por los usuarios' AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS tipos_usuarios (
	id_tipo_usuario INT(4) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_tipo_usuario VARCHAR(255),
	PRIMARY KEY	(id_tipo_usuario)
) ENGINE=MyISAM	DEFAULT CHARSET=utf8 COMMENT='Catalogo de los tipos de usuarios' AUTO_INCREMENT=1;

ALTER TABLE bitacoras ADD CONSTRAINT fk_bitacoras_usuarios FOREIGN KEY (id_usuario)
      REFERENCES usuarios (id_usuario);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_departamentos FOREIGN KEY (id_departamento)
      REFERENCES departamentos (id_departamento);

ALTER TABLE centros_educativos ADD CONSTRAINT fk_centros_educativos_municipios FOREIGN KEY (id_municipio)
      REFERENCES municipios (id_municipio);

ALTER TABLE matriculas ADD CONSTRAINT fk_matriculas_cursos FOREIGN KEY (id_curso)
      REFERENCES cursos (id_curso) on delete restrict on update restrict;

ALTER TABLE examenes ADD CONSTRAINT fk_examenes_cursos FOREIGN KEY (id_curso)
      REFERENCES cursos (id_curso);

ALTER TABLE examenes_calificaciones ADD CONSTRAINT fk_examenes_calificaciones_usuarios FOREIGN KEY (id_usuario)
      REFERENCES usuarios (id_usuario);

ALTER TABLE examenes_calificaciones ADD CONSTRAINT fk_examenes_calificaciones_examenes FOREIGN KEY (id_examen)
      REFERENCES examenes (id_examen);

ALTER TABLE municipios ADD CONSTRAINT fk_municipios_departamentos FOREIGN KEY (id_departamento)
      REFERENCES departamentos (id_departamento);

ALTER TABLE roles_asignados ADD CONSTRAINT fk_roles_asignados_roles FOREIGN KEY (id_rol)
      REFERENCES roles (id_rol);

ALTER TABLE roles_asignados ADD CONSTRAINT fk_roles_asignados_usuarios FOREIGN KEY (id_usuario)
      REFERENCES usuarios (id_usuario);

ALTER TABLE roles_asignados ADD CONSTRAINT fk_roles_asignados_matriculas FOREIGN KEY (id_matricula)
      REFERENCES matriculas (id_matricula);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_centros_educativos FOREIGN KEY (id_centro_educativo)
      REFERENCES centros_educativos (id_centro_educativo);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_niveles_estudios FOREIGN KEY (id_nivel_estudio)
      REFERENCES niveles_estudios (id_nivel_estudio);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_tipos_usuarios FOREIGN KEY (id_tipo_usuario)
      REFERENCES tipos_usuarios (id_tipo_usuario);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_departamentos FOREIGN KEY (id_departamento)
      REFERENCES departamentos (id_departamento);

ALTER TABLE usuarios ADD CONSTRAINT fk_usuarios_municipios FOREIGN KEY (id_municipio)
      REFERENCES municipios (id_municipio);