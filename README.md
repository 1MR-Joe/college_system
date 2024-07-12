# College system
## problem statement
we need a system for our college, it should provide some functionalities
- for the student
  - roll and unroll courses from the list of available courses
  - make requests
  - get notifications (e.g. tuition fees, official holidays)
  - receive exams schedule
- for the professor
  - see courses he/she is teaching 
  - send notifications for the students
  - enter attendance
- for the administrators (e.g. head of staff, manager, principle)
  - assign available courses
  - force withdrawal for some courses for some students
  - modify attendance

## [DB diagram](https://drive.google.com/drive/folders/1VWJEQQKJoLaR9zoVAUVo5OYvJfnYlBhX)
- visit the link, or take a look at the pdf version in `/resources/diagrams` directory 

## steps
1. tackle entities, course management, authentication
2. 

## notes
- the student dashboard will be a template(e.x. a header and a sidebar) the mid-section content depends on the route 
- 

## assumptions
- until an admin can register professor and student, the register feature will be public
- will use auto-incremented semester_course_code until custom code becomes useful


## interfaces ??
- login form

---
| interface                 | get                                        | send                |
|---------------------------|--------------------------------------------|---------------------|
| student registration form | `/student/form` until handled by frontend  | `/student/register` |   
| student dashboard         | `/student`                                 | -                   |

---

| interface                   | get                                         | send                  |
|-----------------------------|---------------------------------------------|-----------------------|
| professor registration form | `/professor/form` until handled by frontend | `/professor/register` |   
| professor dashboard         | `/professor`                                | -                     |

---

- admin dashboard

---
---

## next project goals
1. learn and use laravel
2. use Jira (project ticketing software)
3. more branching and git utilization 
4. wait for me. 😉