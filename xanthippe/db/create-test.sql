insert into jperetz.exercise (type,description,lesson_lesson_id, assignment_assignment_id, weight, private, allow_late, due_date) values ("test","Javascript Final Exam",89,16,10,0,0,"2013-12-16 23:59:59");

insert into jperetz.exercise (type,description,lesson_lesson_id, assignment_assignment_id, weight, private, allow_late, due_date) values ("test","HTML5 Final Exam",72,25,10,0,0,"2013-12-16 23:59:59");

insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,1,"Which HTML5 technology allows a web server to initiate communication with a browser and send data to a browser without browser request?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,2,"A single page web application can present multiple, addressable pages with different URLs using which HTML5 technology?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,3,"The Geolocation API provides which functionality?");


insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,4,"Which of the following HTML5 client-side storage APIs has been deprecated?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,5,"Enabling offline access to your web page involves adding which attribute to your <html> tag?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,6,"Tangential information such as a sidebar or note is placed into what element?");




insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,7,"What does the term SEMANTIC code mean?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,8,"Which HTML5 element should contain site name, logo, tagline?");

insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,9,"What is the difference between the ARTICLE and SECTION elements?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,10,"What tag is often nested within the <figure> element?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,11,"An ASIDE element should always be floated as a sidebar in your layout");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,12,"All links must be enclosed in the new NAV element.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,13,"A document can contain more than one NAV element.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,14,"Opacity is the property that will be animated in this CSS directive: transition: opacity 1s ease-in-out;");


insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,15,"The CANVAS element can display graphics without the use of Javascript");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,16,"The CANVAS element renders graphics on a webpage using vectors.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,17,"A JavaScript program be added to a Web page in either the head or body of the document.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,18,"An HTML element can have only one class.");

insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,19,"A webpage can be POLY-FILLED so that it is defined as both an HTML5 and an xhtml document.");

insert into jperetz.question (exercise_exercise_id, question_num, text) values (70,20,"HTML5 is pretty cool, but the really interesting stuff is coming next year in HTML6");


insert into jperetz.test_option (question_question_id, number, text, value) values (128,1,"AJAX",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (128,2,"XMLHttpRequest",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (128,3,"WebSockets",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (128,4,"JSON",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (129,1,"WebSockets",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (129,2,"History API",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (129,3,"Local Storage",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (129,4,"IndexedDB",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (130,1,"get the browsers current position on earth",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (130,2,"change the browsers virtual position",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (130,3,"get driving directions to the nearest restaurant",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (130,4,"display a map",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (131,1,"Web Storage",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (131,2,"IndexedDB",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (131,3,"WebSQL API",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (131,4,"File System API",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (132,1,"appcache",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (132,2,"offline",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (132,3,"manifest",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (132,4,"cache",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (133,1,"iframe",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (133,2,"article",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (133,3,"sidebar",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (133,4,"aside",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (133,1,"the code is indented properly",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (133,2,"the markup reflects the content that it contains",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (133,3,"there are no div elements",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (133,4,"the document has been validated",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (134,1,"nav",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (134,2,"article",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (134,3,"header",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (134,4,"section",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (135,1,"an ARTICLE must be contained within a SECTION",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (135,2,"ARTICLE can contain only text",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (135,3,"ARTICLE content should stand on its own",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (135,4,"there is no difference",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (136,1,"src",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (136,2,"figcaption",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (136,3,"figurecaption",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (136,4,"caption",0);


insert into jperetz.test_option (question_question_id, number, text, value) values (137,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (137,2,"False",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (138,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (138,2,"False",1;

insert into jperetz.test_option (question_question_id, number, text, value) values (139,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (139,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (140,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (140,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (141,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (141,2,"False",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (142,1,"True",0;
insert into jperetz.test_option (question_question_id, number, text, value) values (142,2,"False",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (143,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (143,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (144,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (144,2,"False",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (145,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (145,2,"False",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (146,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (146,2,"False",1);















insert into jperetz.question (exercise_exercise_id, question_num, text) values (69,1,"The geolocation API is implemented based on the capabilities of the user device.   Smartphones with GPS can provide websites with information such as how fast the user is travelling and which direction they are facing.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (69,2,"The geolocation API includes a geocoding function for determining the mailing address of the users location.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (69,3,"The indexedDB API uses which of these objects  to store document-based data?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (69,4,"Which attribute of the HTML element is used to trigger the Application Cache object?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (69,5,"AJAX is a technique that requires a server program.");


insert into jperetz.test_option (question_question_id, number, text, value) values (102,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (102,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (103,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (103,2,"False",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (104,1,"tables",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (104,2,"object stores",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (104,3,"arrays",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (104,4,"containers",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (105,1,"src",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (105,2,"cache",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (105,3,"manifest",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (105,4,"href",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (106,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (106,2,"False",0);






insert into jperetz.exercise (type,description,lesson_lesson_id, assignment_assignment_id, weight, private, allow_late, due_date) values ("test","HTML5 Quiz 3",67,23,5,0,0,"2013-11-17 23:59:59");

insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,7,"Which method of the  Javascript Array object deletes and returns the last member of the array?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,8,"The Javascript Array object supports  matrix arrays with this syntax:  myArray[x][y]");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,9,"What is the value of x in this statement?  var x = function() {return \"Hello World\";}()");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,10,"What is the value of slice? var slice = (Math.PI<3)?\"too big\":\"too small\";");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,11,"The Javascript Date( ) object can be used to store values for times of day.");


insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,12,"The scope that Javascript creates when a function is declared is referred to by what term?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,13,"A programmer can change the value of the property of a Javascript object.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,14,"A programmer can add a  property to a Javascript object.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,15,"A programmer can define an object as a value of a  property of a Javascript object.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,16,"A programmer can define a function as a value of a  property of a Javascript object.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,17,"In Javascript, number is a:");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,18,"In Javascript, a word that is part of  the language can also be used as a variable name.");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,19,"Which JavaScript function makes it easy to access a specific webpage element?");
insert into jperetz.question (exercise_exercise_id, question_num, text) values (56,20,"What is an important workflow practice to follow when coding a webpage with Javascript?");


insert into jperetz.test_option (question_question_id, number, text, value) values (67,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (67,2,"False",1);





insert into jperetz.test_option (question_question_id, number, text, value) values (70,1,"==",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (70,2,".",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (70,3,"=",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (70,4,"||",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (71,1,"59",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (71,2,"NaN",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (71,3,"undefined",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (71,4,"cs4",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (72,1,"a document",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (72,2,"a set of statements",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (72,3,"a collection of properties",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (72,4,"a recursive expression",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (72,4,"an anonymous function",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (73,1,"slice",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (73,2,"pop",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (73,3,"push",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (73,4,"remove",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (74,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (74,2,"False",1);


insert into jperetz.test_option (question_question_id, number, text, value) values (75,1,"Hello World",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (75,2,"function() {return \"Hello World\";}",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (75,4,"undefined",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (75,3,"null",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (76,1,"too bit",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (76,2,"too small",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (76,3,"just right",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (76,4,"3.141",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (77,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (77,2,"False",0);



insert into jperetz.test_option (question_question_id, number, text, value) values (78,1,"local scope",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (78,2,"global scope",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (78,3,"closure",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (78,4,"memory stack",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (79,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (79,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (80,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (80,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (81,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (81,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (82,1,"True",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (82,2,"False",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (83,1,"object",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (83,2,"type",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (83,3,"function",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (83,4,"variable",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (84,1,"True",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (84,2,"False",1);

insert into jperetz.test_option (question_question_id, number, text, value) values (85,1,"div( )",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (85,2,"getElementById( )",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (85,3,"element( )",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (85,4,"DOM.get( )",0);

insert into jperetz.test_option (question_question_id, number, text, value) values (86,1,"drink lots of coffee to stay up late programming",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (86,2,"keep the browser development tools open and check for Javascript errors",1);
insert into jperetz.test_option (question_question_id, number, text, value) values (86,3,"use lots of Javascript variables",0);
insert into jperetz.test_option (question_question_id, number, text, value) values (86,4,"validate your page at W3C",0);


