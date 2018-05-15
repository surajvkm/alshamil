DROP FUNCTION IF EXISTS ChangePostStatus;

DELIMITER $$
CREATE FUNCTION `ChangePostStatus`(`toUpdatepostID` INT, `newAvailabiltiyStatus` INT)  RETURNS INT
BEGIN

	DECLARE result INT;
    DECLARE category int;
    DECLARE producty int;

    SELECT  CategoryID, ProductID INTO @category, @producty
    FROM    vwProductPost
    WHERE   postID= toUpdatepostID
    LIMIT 1;
    
		IF (@category=1) THEN
			UPDATE productcar SET productCStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;
            
		ELSEIF (@category=2) THEN
			UPDATE productbike SET productBStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;

		ELSEIF (@category=3) THEN
			UPDATE productnp SET productNPStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;

        ELSEIF (@category=4) THEN
			UPDATE productvertu SET productVStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;

        ELSEIF (@category=5) THEN
			UPDATE productwatch SET productWStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1; 

        ELSEIF (@category=6) THEN
			UPDATE productmn SET productMNStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;

        ELSEIF (@category=7) THEN
			UPDATE productboat SET productBTStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;

        ELSEIF (@category=8) THEN
			UPDATE productphone SET productPHStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;    

        ELSEIF (@category=9) THEN
			UPDATE productproperty SET productPRStatus = newAvailabiltiyStatus WHERE productID=@producty;
			SET result=1;

        ELSE
			SET result=0;
		END IF;

 RETURN(result);
END$$