drop database if exists oneClick;
create database oneClick;

USE oneClick;

drop table if exists Instructor;
create table Instructor(
	InstructorID int NOT NULL auto_increment,
	IDPass varchar(20) NOT NULL,
	FirstName varchar(20) NOT NULL,
	LastName varchar(20),
	primary key(InstructorID));


drop table if exists Student;
create table Student(
	StudentID int NOT NULL auto_increment,
	IDPass varchar(20) NOT NULL,
	FirstName varchar(20) NOT NULL,
	LastName varchar(20),
	photoLocation text,
	primary key(StudentID));


drop table if exists Course;
create table Course(
	CourseID varchar(10) unique,
	CourseName varchar(40),
	semester varchar(10),
	primary key(CourseID));


drop table if exists Instructor_courses;
create table Instructor_courses(
	CourseID varchar(10),
	InstructorID int,
	no_of_enrolled_students int,
	primary key(CourseID,InstructorID),
	foreign key (CourseID) references Course(CourseID) on delete cascade ,
	foreign key (InstructorID) references Instructor(InstructorID) on delete cascade );

	
drop table if exists Student_Attendance;
create table Student_Attendance(
	CourseID varchar(10),
	StudentID int,
	InstructorID int,
	dateTaken TIMESTAMP,
	attendanceStatus int,
	primary key(CourseID,InstructorID),
	foreign key (CourseID) references Course(CourseID) on delete cascade ,
	foreign key (StudentID) references Student(StudentID) on delete cascade ,
	foreign key (InstructorID) references Instructor(InstructorID) on delete cascade );
