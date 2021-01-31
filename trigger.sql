DELIMITER 
$$
USE `arbresdb`
$$
CREATE  
TRIGGER `arbresdb`.`nodetrigger` 
BEFORE INSERT ON `arbresdb`.`trees`
FOR EACH ROW
-- Edit trigger body code below this line. Do not edit lines above this one
BEGIN  
DECLARE pnode varchar(600);
select node into pnode from trees where id=NEW.treeId;
IF NEW.treeId IS NULL THEN
SET NEW.node=(SELECT `AUTO_INCREMENT`  
FROM  INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'arbresdb'
AND   TABLE_NAME   = 'trees');
ELSE
SET NEW.node=CONCAT(pnode,'.',(SELECT `AUTO_INCREMENT`  
FROM  INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = 'arbresdb'
AND   TABLE_NAME   = 'trees'));
 END IF;
END$$