-- If a drug's price exceeds the 100, drop it to 100
DROP TRIGGER IF EXISTS 'plafon';
CREATE DEFINER='root'@'localhost'
TRIGGER 'plafon'
BEFORE INSERT ON 'Sell' FOR EACH ROW 
BEGIN
IF NEW.Price > 100 THEN
	SET New.Price=100;
END IF;
END

-- If a contract's duration is less than a year, set it to one year
DROP TRIGGER IF EXISTS 'datecheck';
CREATE DEFINER='root'@'localhost'
TRIGGER 'datecheck'
BEFORE INSERT ON 'Contract' FOR EACH ROW 
BEGIN
IF DATEDIFF(NEW.StartDate,NEW.EndDate) > -366 THEN
	SET NEW.EndDate=NEW.StartDate+ INTERVAL 1 YEAR;
END IF;
END
