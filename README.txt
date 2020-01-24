Names: Kenton Carrier, Sydney Taylor
Description: A simple web application in PHP that displays a dynamic form and runs a report based on submitted 
input from the form.

1)  What parts of the assignment did you implement {designate as: working, attempted, not implemented}
A)  HTML form - working
B)  dynamic OPTIONS for SELECT fields - working
C)  HTML report - working
D)  dynamic fields for report (no hard-coded fieldnames) - working
E)  EXTRA CREDIT 1
F)  EXTRA CREDIT 2
G)  EXTRA CREDIT 3

2) What happens if your program receives a "sourcedata"and no other GET parameters?  Be very specific here.

   We did not implement the extra credit. The program therefore prints out the report if the program receives a "sourcedata"
   and no other GET parameters or if it receives a "sourcedata" and a "fielddata". To produce the report, the program gets the 
   url associated with the "sourcedata". Then it prints, in order of key, the values associated with the keys on that url.

3) What happens if your program receives a "sourcedata""resolves" to a corresponding url of "foo.json" ?Be specific! 
   The P4_Sources.json has an entry like:"name": "Your_File","url": "foo.json", ....
   and your program receives sourcedata=Your_File as a GET submission (along with the rest of the formdata)?

   The program prints out the values associated with the keys in foo.json.
