SELECT orders.O_ID, orderstatus.Order_Status 
from orders, orderstatus 
where orders.PersonID=(SELECT P_ID from people where UsrName='admin') 
and orders.Order_Status = orderstatus.Status_ID;