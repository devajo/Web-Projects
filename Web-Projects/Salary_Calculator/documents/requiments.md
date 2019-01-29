# Salary Calculator 
The purpose of this application is calculate the weekly wages of a person.

## Scenario
Bob enter the start time time and the end time work for the whole week via the form in the application.The application expect the user to enter time in 24 hours clock.


## Business Rules for calculating the salary.
Salary is calculated in 15-min block.For example.A person can get paid 5 hours 15 miniutes or 30 minutes or 45 minutes.
Salary Calculation are as follows:<br>
- Hourly rate : Example  $21.50 per/hour
- 00 hours to 0500 hours : 130% of base hourly rate.
- 0500 hours to 2400 hours : 100% of base hourly rate.
- Public Holiday 250% of base hourly rate.
- Sunday 2100 to 2400 : 200%  base hourly rate.
- Sunday 05 to 2100 : 150%  base hourly rate.
- Sunday 00 to 0500 : 180%  base hourly rate.