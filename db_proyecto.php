<?php
$conexion = mysql_connect("localhost","admin","itesm");

	if(!$conexion){
		die('No se ha podido conectar'.mysql_error());
	}
	mysql_query("drop database proyecto");
	if(mysql_query("create database if not exists proyecto",$conexion)){
		echo "Se ha creado la Base de datos";
	}
	else{
		echo "Error al crear la base de datos  ". mysql_error();
	}

mysql_select_db("proyecto",$conexion);
													
/***** Tabla Contenedor **************/
mysql_query("drop table contenedor;");
$contenedor=("CREATE TABLE IF NOT EXISTS contenedor(
  id bigint(20) NOT NULL AUTO_INCREMENT,
  usuario varchar(15) NOT NULL,
  fecha text NOT NULL,
  accion text NOT NULL,
  mensaje text NOT NULL,
  nombre_tabla varchar(15) NOT NULL,
  ip varchar(10) NOT NULL,
  PRIMARY KEY (id)
)engine = innodb;");
mysql_query($contenedor, $conexion);


/***** Tabla Informacion **************/

mysql_query("drop table informacion;");
$informacion=("CREATE TABLE IF NOT EXISTS informacion(
  id int(4) NOT NULL AUTO_INCREMENT,
  rfc varchar(15) NOT NULL,
  ra_social text NOT NULL,
  nombre text NOT NULL,
  direccion text NOT NULL,
  ciudad varchar(20) NOT NULL,
  entidad varchar(20) NOT NULL,
  cp varchar(5) NOT NULL,
  telefono text NOT NULL,
  predeterminada text NOT NULL,
  PRIMARY KEY (id)
) engine = innodb;");
mysql_query($informacion, $conexion);


/***** Tabla Noticias **************/
mysql_query("drop table noticias;");
$noticias=("CREATE TABLE IF NOT EXISTS noticias (
  id int(5) NOT NULL AUTO_INCREMENT,
  categoria varchar(100) NOT NULL,
  titulo varchar(100) NOT NULL,
  foto longblob NOT NULL,
  tamano int(11) NOT NULL,
  tamano_unidad varchar(150) NOT NULL,
  tipo varchar(150) NOT NULL,
  nombre_archivo varchar(250) NOT NULL,
  contenido text NOT NULL,
  valido varchar(2) NOT NULL,
  PRIMARY KEY (id)
) engine = innodb;");
mysql_query($noticias, $conexion);


/***** Tabla Producto **************/
mysql_query("drop table producto;");
$producto=("CREATE TABLE IF NOT EXISTS producto (
  id bigint(8) NOT NULL AUTO_INCREMENT,
  area varchar(50) NOT NULL,
  categoria text NOT NULL,
  articulo text NOT NULL,
  cantidad int(5) NOT NULL,
  foto longblob NOT NULL,
  tamano int(11) NOT NULL,
  tamano_unidad varchar(150) NOT NULL,
  tipo int(150) NOT NULL,
  nombre_archivo varchar(250) NOT NULL,
  observaciones text NOT NULL,
  valido varchar(2) NOT NULL,
  PRIMARY KEY (id)
) engine = innodb;");
mysql_query($producto, $conexion);


/***** Tabla Registro **************/
mysql_query("drop table registro;");
$registro=("CREATE TABLE IF NOT EXISTS registro(
  id bigint(8) NOT NULL AUTO_INCREMENT,
  ip varchar(100) NOT NULL,
  identificador text NOT NULL,
  navegador text NOT NULL,
  segundero varchar(50) NOT NULL,
  observaciones text NOT NULL,
  PRIMARY KEY (id)
) engine = innodb;");
mysql_query($registro, $conexion);


/***** Tabla Usuario **************/
mysql_query("drop table usuario;");
$usuario=("CREATE TABLE IF NOT EXISTS usuario (
  id int(4) NOT NULL AUTO_INCREMENT,
  usuario varchar(15) NOT NULL,
  clave text NOT NULL,
  perfil text NOT NULL,
  foto longblob NOT NULL,
  nombre text NOT NULL,
  correo varchar(80) NOT NULL,
  ip varchar(100) NOT NULL,
  acceso text NOT NULL,
  f_acceso text NOT NULL,
  observaciones text NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY usuario (usuario)
) engine = innodb;");
mysql_query($usuario, $conexion);



echo "<br> se crearon todas las tablas";

