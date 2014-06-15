update jperetz.grade set value = value + 1 where assignment_assignment_id = 23 and student_email in (select student_email from jperetz.homework h,  jperetz.test_answer a where homework_id = homework_homework_id  and test_option_question_question_id=96 and test_option_number=2);

