# Salary Calculator 
The purpose of this application is calculate the weekly wages of a person.

## Scenario
Bob enter the start time time and the end time work for the whole week via the form in the application.The application expect the user to enter time in 24 hours clock.Suppose Bob is rostered on Monday from 2300 to Tuesday morning 0600.Then in the application we select Monday's start-time to be 23 hours 00 min and select(--) on Monday's end-time.We select start-time for Tuesday to (--) and end time for Tuesday to 06 hours and 00 min.Select the check box for Public Holiday if the day you happen to work is a public holiday.(ie the start-time is on public holiday.)


![Images](../images/interface.png)



## Business Rules for calculating the salary.
Salary is calculated in 15-min block.For example.A person can get paid 5 hours 15 miniutes or 30 minutes or 45 minutes.

Salary Calculation are as follows:<br>
- Hourly rate : Example  $21.50 per/hour
- 00 hours to 0500 hours : 130% of base hourly rate.
- 0500 hours to 2400 hours : 100% of base hourly rate.
- Public Holiday 250% of base hourly rate.
  >If your shift start on a public holiday but end on a normal day you will be paid public holiday rates for the whole shift.If your shift start on a normal day but end on a public holiday you will be paid normal rates for the whole shift.     
- Sunday 2100 to 2400 : 200%  base hourly rate.
- Sunday 05 to 2100 : 150%  base hourly rate.
- Sunday 00 to 0500 : 180%  base hourly rate.
- Maxmium hours work in a week 36 hours.Hours > 36 hours to be paid over time @ no of hours X 200%. 