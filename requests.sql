

// compter 
SELECT t1.id, t1.name,count(*)  FROM `trees` t1 inner join trees t2 on t1.id=t2.treeid group by t1.id, t1.name;