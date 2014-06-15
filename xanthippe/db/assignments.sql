use jperetz;
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,1,"Participation",10,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,2,"Quiz 1",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,3,"Quiz 2",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,4,"Midterm Exam",10,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,5,"Quiz 3",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,6,"Quiz 4",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,7,"Final Exam",10,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,8,"Exercises",30,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (3,9,"Final Project",20,"2013-12-19");

insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,1,"Participation",10,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,2,"Quiz 1",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,3,"Quiz 2",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,4,"Midterm Exam",10,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,5,"Quiz 3",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,6,"Quiz 4",5,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,7,"Final Exam",10,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,8,"Exercises",30,"2013-12-19");
insert into assignment (syllabus_syllabus_id, position, name, value, due_date) values (4,9,"Final Project",20,"2013-12-19");

insert into jperetz.exercise (type,description,lesson_lesson_id, assignment_assignment_id, weight, private, due_date, allow_late) values ("form","SJRC Certification Survey",60,26,2,0,"2013-12-19 23:59:00", 1);

insert into jperetz.exercise (type,description,lesson_lesson_id, assignment_assignment_id, weight, private, due_date, allow_late) values ("form","SJRC Certification Survey",78,17,2,0,"2013-12-19 23:59:00", 1);

insert into jperetz.question (exercise_exercise_id, question_num, text) values (44,1,"This class is a key requirement for obtaining the Web Developer's Certificate, you may be eligible by completing this class.   Will you be applying for the certificate, or do you plan to do so in the future.    What are your thoughts about the value of the certification program at the JC?  ");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (45,1,"This class is a key requirement for obtaining the Javascript Programmer's Certificate , you may be eligible by completing this class.   Will you be applying for the certificate, or do you plan to do so in the future.    What are your thoughts about the value of the certification program at the JC? ");


insert into question (exercise_exercise_id, question_num, text) values (37,3,"What CSS rule is it a good practice to set to display new HTML5 elements correctly in old browser versions?");
insert into question (exercise_exercise_id, question_num, text) values (37,2,"According to the textbook, HTML validation is:");
insert into question (exercise_exercise_id, question_num, text) values (37,4,"True or False: The ARTICLE tag is used for 'sectioning' an HTML document.");

insert into test_option (question_question_id, number, text, value) values (7,1,"Number",0);
insert into test_option (question_question_id, number, text, value) values (7,2,"String",1);
insert into test_option (question_question_id, number, text, value) values (7,3,"Boolean",0);

insert into test_option (question_question_id, number, text, value) values (17,1,"True",0);
insert into test_option (question_question_id, number, text, value) values (17,2,"False",1);

insert into test_option (question_question_id, number, text, value) values (4,1,"Local Operating System",0);
insert into test_option (question_question_id, number, text, value) values (4,2,"Local Web Browser",1);
insert into test_option (question_question_id, number, text, value) values (4,3,"Web Server",0);
insert into test_option (question_question_id, number, text, value) values (4,4,"Internet",0);

insert into test_option (question_question_id, number, text, value) values (18,1,"newtag {float:left;}",0);
insert into test_option (question_question_id, number, text, value) values (18,2,"newtag {height:200px;width:200px;}",0);
insert into test_option (question_question_id, number, text, value) values (18,3,"newtag {display:block;}",1);
insert into test_option (question_question_id, number, text, value) values (18,4,"newtag {version: html5;}",0);

insert into test_option (question_question_id, number, text, value) values (19,1,"A means to an end of authoring a webpage",0);
insert into test_option (question_question_id, number, text, value) values (19,2,"The Goal of authoring a webpage",0);
insert into test_option (question_question_id, number, text, value) values (19,3,"a complete waste of time",1);
insert into test_option (question_question_id, number, text, value) values (19,4,"not necessary for team development workflows",0);