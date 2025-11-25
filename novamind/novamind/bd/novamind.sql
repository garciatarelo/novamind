create database novamind;

drop database novamind;

use novamind;

/*Creacion de tablas*/

create table users(
	idUser integer not null auto_increment,
	name char(30),
	ap char(30),
	am char(30),
	username varchar (50),
	email varchar(50),
	password varchar(100),
	birthDate date,
	profileImage varchar(30),
	recieveOffers boolean,
	registrationDate date,
	primary key (idUser)
);


create table courses(
	idCourse integer not null auto_increment,
	name char (30),
	description text,
	level tinyint,
	status boolean,
	durationHours numeric(3),
	publicationDate date,
	cost decimal(10, 2),
	startDate date,
	img varchar(30),
	idInstructor integer,
	idCategory integer,
	primary key(idCourse),
	foreign key (idInstructor) references instructors(idInstructor),
    foreign key (idCategory) references categories(idCategory)
);

create table lessons(
	idLesson integer not null auto_increment,
	name char(30),
	description text,
	image varchar(30),
	idLessonType integer,
	idCourse integer,
	primary key(idLesson),
	foreign key (idLessonType) references lessonTypes(idLessonType),
    foreign key (idCourse) references courses(idCourse)
);

create table lessonTypes(
	idLessonType integer not null auto_increment,
	lessonType char(20),
	primary key(idLessonType)
);

create table categories(
	idCategory integer not null auto_increment,
	name char (30),
	primary key (idCategory)
);

create table instructors(
	idInstructor integer not null auto_increment,
	phone varchar(20),
	speciality text,
	status boolean,
	idUser integer not null,
	primary key(idInstructor),
    foreign key (idUser) references users(idUser)
);

create table categoryInstructors(
	idCategory integer, 
	idInstructor integer,
	 PRIMARY KEY (idCategory, idInstructor),
	foreign key (idCategory) references categories(idCategory),
	foreign key (idInstructor) references instructors(idInstructor)
);

create table usersProgress(
	idProgress integer not null auto_increment,
	status boolean,
	startDate datetime,
	endDate datetime,
	idUser integer,
	idCourse integer,
	progress int,
	primary key(idProgress),
	foreign key (idUser) references users(idUser),
    foreign key (idCourse) references courses(idCourse)
);

create table evaluations(
	idEvaluation integer not null auto_increment,
	type char(20),
	feedback text,
	grade decimal (5,2),
	idUser integer,
	idCourse integer,
	primary key(idEvaluation),
	foreign key (idUser) references users(idUser),
    foreign key (idCourse) references courses(idCourse)
);

create table questions(
	idQuestion integer not null auto_increment,
	question text,
	type char(20),
	correctAnswer text,
	idEvaluation integer,
	primary key (idQuestion),
	foreign key (idEvaluation) references evaluations(idEvaluation)
);

create table options(
	idOption integer not null auto_increment,
	optionText text,
	isCorrect boolean,
	idQuestion integer,
	primary key (idOption),
	foreign key (idQuestion) references questions(idquestion) 
);

create table certifications(
	idCertification integer not null auto_increment,
	certificationDate date,
	primary key(idCertification),
	idUser integer,
	idCourse integer,
	idProgress integer,
	foreign key (idUser) references users(idUser),
    foreign key (idCourse) references courses(idCourse),
    foreign key (idProgress) references usersProgress(idProgress)
);

create table interactionsLessons(
	idInteractionLesson integer not null auto_increment,
	comment text,
	interactionDate date,
	type char(20),
	time time,
	idUser integer,
	idLesson integer,
	primary key(idInteractionLesson),
	foreign key (idUser) references users(idUser),
    foreign key (idLesson) references lessons(idLesson)
);

create table interactionsCourses(
	idInteractionCourse integer not null auto_increment,
	comment text,
	interactionDate date,
	type char(20),
	time time,
	idCourse integer,
	idUser integer,
	primary key(idInteractionCourse),
	foreign key (idCourse) references lessons(idCourse),
	foreign key (idUser) references users(idUser)
);

create table autentication(
	idAutentication integer not null auto_increment,
	sessionToken text,
	sessionStatus boolean,
	sessionStart datetime,
	sessionEnd datetime,
	idUser integer,
	primary key(idAutentication),
	foreign key (idUser) references users(idUser)
);

create table payments(
	idPayment integer not null auto_increment,
	amount decimal (10, 2),
	amountPaid decimal(10,2),
	paymentMethod text,
	status enum('Pendiente', 'En Proceso', 'Completado', 'Fallido'),
	paymentDate datetime,
	idUser integer,
	idCourse integer,
	primary key(idPayment),
	foreign key (idUser) references users(idUser),
    foreign key (idCourse) references courses(idcourse)
);

drop table payments;


create table support(
	idSupport integer not null auto_increment,
	subject text,
	message text,
	requestDate date,
	completionDate date,
	status enum('Pendiente', 'En proceso', 'Resuelto'),
	response text,
	idUserIssuer integer,
	idUserResponder integer,
	idCourse integer,
	primary key (idSupport),
	foreign key (idUserIssuer) references users(idUser),
    foreign key (idUserResponder) references users(idUser),
    foreign key (idCourse) references courses(idCourse)
);

/*Seleccionar tablas*/

select * from autentication a ;
select * from categories c ;
select * from categoryinstructors c;
select * from certifications c ;
select * from courses c ;
select * from evaluations e ;
select * from instructors i ;
select * from interactionscourses i ;
select * from interactionslessons i ;
select * from lessons l ;
select * from lessontypes l ;
select * from options o ;
select * from payments p ;
select * from questions q ;
select * from support s ;
select * from users u ;
select * from usersprogress u ;

delete from users where email = 'aaa@aaa';

insert into users(name, ap, am, username, email, password, birthDate, recieveOffers)
    values('Humberto', 'Saenz', 'Loya', 'loyahum12', 'humbertosl87@outlook.com', '123456', '2000-06-12', 0);


/*INSERTAR DATOS*/


/*Crear users*/

insert into users values (0, 'Pamela', 'Garcia', 'Tarelo', 'admin', 'admin123@gmail.com',
'1234', '2004-11-18', 'default.jpg', '1', '2024-11-21');

select * from users where email = 'admin123@gmail.com' and password = '1234';

insert into users values (0, 'Renzo', 'Caycho', 'Pomachagua', 'renzocp123', 'renzo@gmail.com',
'123456', '2000-04-03', 'default1.jpg', '0', '2024-11-27');

insert into users values (0, 'Jaime', 'Enriquez', 'Lozano', 'jaimito10', 'enriquezl4567@outlook.com',
'hola123', '1998-07-23', 'default2.jpg', '1', '2024-11-28');

select * from users order by idUser desc;

/*Crear lessonType*/

insert into lessontypes values(0, 'Juego' );
insert into lessontypes values(0, 'Video' );
insert into lessontypes values(0, 'Texto' );

select * from lessontypes order by idLessonType desc; 


/*Crear category*/

insert into categories values(0, 'Fundamentos de la tecnología');
insert into categories values(0, 'Productividad digital');
insert into categories values(0, 'Ciberseguridad');
insert into categories values(0, 'Redes');
insert into categories values(0, 'Programación');
insert into categories values(0, 'Inteligencia artificial');

select * from categories order by idCategory desc;


/*Crear instructor*/

insert into instructors values (0, '6367418522','Programación', 1, 3);
insert into instructors values (0, '6361566983','Redes', 1, 4);

select instructors.*, users.* from instructors inner join users on instructors.idUser = users.idUser;


/*Crear course*/
insert into courses values(0, 'Introducción a la computadora', 'Aprende los fundamentos de una computadora
 y componentes', 1, 1, 120,'2024-11-27', 350, '2025-1-1', 'pc1.webp', 1, 1);

select instructors.idInstructor, concat(users.name, ' ', users.ap, ' ', users.am) as fullName
from instructors inner join users on instructors.idUser = users.idUser;

/*Crear categoryInstructor*/
insert into categoryinstructors values(1, 1);



/*Crear lesson*/
insert into lessons values(0,'¿Qué es una computadora?', 'Descubre qué es una computadora, cómo funciona y para qué sirve.',
'computadora.webp', 1, 1 );
insert into lessons values(0,'Primeros pasos en programación: variables y operadores', 'Aprende qué son las variables, los operadores y cómo se utilizan para crear programas básicos',
'programmer.webp', 2, 2 );
insert into lessons values(0,'Configurando una red doméstica', 'Configura tu propia red en casa, conectando computadoras, impresoras y otros dispositivos.',
'cablered.webp', 1, 3 );
insert into lessons values(0,'Chatbots: ¿Cómo funcionan?', 'Comprende los principios de la inteligencia artificial',
'chatgpt.webp', 3, 4 );

select * from courses;


select lessons.* from lessons inner join lessontypes
on lessonTypes.idLessonType = lessons.idLessonType inner join courses
on courses.idCourse = lessons.idCourse ;



/*Crear userProgress*/
insert into usersprogress values(0, '1', '2024-11-27', '2025-1-1', 2, 1, 20);

select * from usersprogress order by idProgress desc;



/*Crear evaluations*/
insert into evaluations values(0, 'examen', 'Demostraste un buen entendimiento de los conceptos básicos de una computadora. ¡Buen trabajo!',
10, 2, 1);

select * from evaluations order by idEvaluation desc;



/*Crear question*/
insert into questions values(0, '¿Qué es una computadora?', 'opción múltiple', 'Un dispositivo electrónico que procesa datos', 1);

select * from questions order by idQuestion desc;



/*Crear option*/
insert into options values (0, 'Un dispositivo mecánico', 0, 1);

select * from options order by idOption desc;



/*Crear certification*/
insert into certifications values(0, '2025-1-1', 2, 1, 1);

select * from certifications order by idCertification desc;



/*Crear interactionLesson*/
insert into interactionslessons values(0, 'Muy interesante la lección.', '2024-11-25', 'comentario', '10:00:00', 2, 1);

select * from interactionslessons order by idInteractionLesson desc;



/*Crear interactionCourse*/
insert into interactionscourses values(0, 'Me gustaría más ejemplos prácticos.', '2024-11-22', 'Comentario', '15:00:00', 1, 2);

select * from interactionscourses order by idInteractionCourse desc;



/*Crear autentication*/
insert into autentication values(0, 'abc123', TRUE, '2024-11-27 09:00:00', '2024-11-27 10:00:00', 2);

select * from autentication order by idAutentication desc;



/*Crear payment*/
insert into payments values(0, 350, 350, 'Tarjeta de débito', 'Completado' , '2024-11-28 10:24:12', 2, 1);

select payments.* from payments inner join users on payments.idUser = users.idUser
inner join courses on courses.idCourse = payments.idCourse;



/*Crear support*/
insert into support values(0, 'Problema con el pago', 'Mi pago no se refleja.', '2024-11-22',
'2024-11-23', 'Resuelto', 'Pago validado.', 2, 1, 1);

select * from support order by idSupport desc;

delete from support where idSupport = 2;




/*DISPARADOR*/

create table control_update(
idCourse integer,
message text,
date date
);


create trigger update1
after update on courses
for each row 
begin 
	/*Verifica si el campo 'cost' ha sido actualizado*/
	if old.cost != new.cost then 
		/*Inserta un registro en la tabla de control de actuaizaciones*/
		insert into control_update(idCourse, message, date)
		values (new.idCourse, 'Id Update', now());
	end if;
end


select * from control_update;
select * from courses;

update courses 
set cost= 500
where idCourse =1;


/*PRCEDIMIENTO ALMACENADO*/

delimiter $$

create procedure AddUser(
    in p_name char(30),
    in p_ap char(30),
    in p_am char(30),
    in p_username varchar(50),
    in p_email varchar(50),
    in p_password varchar(100),
    in p_birthDate date,
    in p_profileImage varchar(30),
    in p_recieveOffers boolean
)
begin
    insert into users (
        name, ap, am, username, email, password, birthDate, profileImage, recieveOffers, registrationDate
    )
    values (
        p_name, p_ap, p_am, p_username, p_email, p_password, p_birthDate, p_profileImage, p_recieveOffers, 
        curdate()
    );
end 

delimiter ;



drop procedure if exists AddUser;


select * from users u ;

