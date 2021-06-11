use wsers2;
SELECT p.FName, p.LName, o.O_ID FROM PEOPLE p, ORDERS o where o.PersonID = p.P_ID;
