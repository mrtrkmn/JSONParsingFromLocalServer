SELECT instructor.dept_name,instructor.name,instructor.salary FROM department
 JOIN instructor ON department.dept_name=instructor.dept_name
 WHERE instructor.salary>6000 AND instructor.dept_name='Comp. Sci.' ;