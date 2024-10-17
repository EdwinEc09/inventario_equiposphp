use Inventario_equipos;


create table usuarios (
		ID int identity (1,1) primary key,
		usuario char(250)  NULL,
		clave char(250) NOT NULL,
);

select * from usuarios;

insert into usuarios (usuario, clave) values ('edwi','edebesca');

/*esto es para empleados*/
DROP TABLE empleados;

create table empleados (
		ID int identity (1,1) primary key,
		nombres char(250) NOT NULL,
		correo char(250) NULL,
		cede char(100) not null,
		fecha_creacion datetime NOT NULL,
		Fecha_ingreso date NULL,
		cargo char(30) null,
		area char(30) null,
		estado bit NOT NULL 
);

select * from empleados;

select distinct ID,nombres from empleados where  estado = 1;
select  correo from empleados where  ID  in ('1','2');

insert into empleados (nombres, correo,cede, fecha_creacion,Fecha_ingreso,cargo,area, estado) values ('ANDRES BUSTAMANTE','andres@gmail.com','barannquilla', '2024-05-01','2024-01-01','practicante TI','TI',1);
insert into empleados (nombres, correo,cede, fecha_creacion,Fecha_ingreso,cargo,area, estado) values ('CESAR PALLARES','cesar@gmail.com','monteria','2024-05-01','2024-01-01','auxiliar TI','TI',0);

UPDATE empleados SET nombres = 'paopo12' ,correo = 'papo@1', cede ='cota' ,Fecha_ingreso='2024-05-01', cargo ='cordinador',area='mercadeo',estado=1 WHERE ID = 1;

/*este es para equipos*/

DROP TABLE equipos;

create table equipos (
	ID int identity (1,1) primary key,
	tipo char(100) not null,
	marca char(100) null,
	serial char(50) null ,
	direccion_mac_wifi char(100) null,
	direccion_mac_ethenet char(100) null,
	imei1 char(100) null,
	imei2 char(100) null,
	fecha_creacion char(25) not null,
	estado char(100) not null,
	observacion char(250) null
);

select * from equipos;

select ID,marca,serial,tipo from equipos where  estado = 'Disponible';

SELECT e.ID, e.tipo, e.marca, e.serial, e.direccion_mac_wifi, e.direccion_mac_ethenet, e.imei1, e.imei2, e.fecha_creacion, ee.estado, e.observacion FROM equipos e JOIN estado_equipos ee ON e.estado = ee.ID;

SELECT e.ID, te.tipo AS tipo_equipo, e.marca, e.serial, e.direccion_mac_wifi, e.direccion_mac_ethenet, e.imei1, e.imei2, e.fecha_creacion, ee.estado, e.observacion FROM equipos e JOIN estado_equipos ee ON e.estado = ee.ID JOIN tipos_equipos te ON e.tipo = te.ID;

insert into equipos (tipo, marca, serial, direccion_mac_wifi, direccion_mac_ethenet, imei1, imei2,fecha_creacion,estado,observacion) values ('PC','Lenovo','1128YUA8','direccion1234wifi','direccion12345ethenet','imei1222','imei2333','2024-05-01','Disponible','esta es una observacion de prueba');
insert into equipos (tipo, marca, serial, direccion_mac_wifi, direccion_mac_ethenet, imei1, imei2,fecha_creacion,estado,observacion) values ('celular','sansung A20','123456789','direccion1234wifi','direccion12345ethenet','imei1222','imei2333','2024-05-01','Averiado', 'esta es una pruena de la descripcion de prueba 2');

UPDATE equipos SET estado = 'Disponible' WHERE estado  = 'Asignado';
UPDATE equipos SET estado = 'Asignado' WHERE ID = 2;
UPDATE equipos SET tipo = ?, marca = ?, serial = ?, direccion_mac_wifi = ?, direccion_mac_ethenet = ?, imei1 = ?, imei2 = ?,estado =?,observacion =? WHERE ID = ?

/*este es para el estado de equipos*/
DROP TABLE estado_equipos;

create table estado_equipos (
	ID int identity (1,1) primary key,
	estado char(50) null,
	color_estado char(100) null
);

select * from estado_equipos;

select distinct estado from estado_equipos where  estado not in ('');



insert into estado_equipos (estado) values ('Asignado');
insert into estado_equipos (estado) values ('Disponible');
insert into estado_equipos (estado) values ('Averiado');
insert into estado_equipos (estado) values ('Robado');
insert into estado_equipos (estado) values ('Otrosss');


/*este es para tipo de equipo*/
DROP TABLE tipos_equipos;

create table tipos_equipos (
	ID int identity (1,1) primary key,
	tipo char(50) null,
);

select * from tipos_equipos;

select distinct tipo from tipos_equipos where  tipo not in ('');

insert into tipos_equipos (tipo) values ('Telefono');
insert into tipos_equipos (tipo) values ('PC Mesa');
insert into tipos_equipos (tipo) values ('Portatil');
insert into tipos_equipos (tipo) values ('Monitor');
insert into tipos_equipos (tipo) values ('AP');



/*asignaciones de equipos*/

drop table asignaciones;

create table asignaciones(
	ID int identity (1,1) primary key,
	id_empleado int not null,
	id_equipos int not null,
	fecha_asignacion date null,
	fecha_registro datetime not null,
	estado_asignacion bit not null,
	acta_firmada bit not null

	FOREIGN KEY (id_empleado) REFERENCES empleados(ID),
    FOREIGN KEY (id_equipos) REFERENCES equipos(ID)
);

select * from asignaciones;

insert into asignaciones (id_empleado,id_equipos,fecha_asignacion,fecha_registro,estado_asignacion,acta_firmada) values (1,1,'2024-03-04','2024-09-26',0,0);
insert into asignaciones (id_empleado,id_equipos,fecha_asignacion,fecha_registro,estado_asignacion,acta_firmada) values (2,2,'2024-05-04','2024-09-26',1,1);


SELECT e.ID,  ee.nombres,te.tipo,te.marca,e.fecha_asignacion, e.fecha_registro, eq.estado FROM asignaciones e JOIN empleados ee ON e.id_empleado = ee.ID JOIN equipos te ON e.id_equipos = te.ID join estado_equipos eq on e.estado_asignacion = eq.ID;
