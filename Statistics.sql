

SELECT u.FirstName, u.LastName, u.Email, u.Phone, u.Gender, u.Age
    , count(t.transactionid) as NoOfTransactions
    from client c,user u,transaction t
    where u.username = 'mstuttard1'
    and u.userid=c.userid
    and c.clientid = t.clientid;