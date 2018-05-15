

create OR REPLACE view vwTrader as
SELECT
    t.*,
    ts.planName,
    ts.planAmount,
    ts.planPostCount,
    ts.planValidity,
    ts.planStatus,
    ts.paymentProof,
    ts.paymentTypeChosen,
    ts.planID as tplanID
FROM
    trader t
    LEFT JOIN tradersubscriptionplan ts ON t.traderID = ts.traderID;



create OR REPLACE VIEW  vwProduct as
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productBBrand as Brand,
    p.productBModel as Model,
    p.productBCallPrice as CallPrice,
    p.productBPrice as Price,
    p.productBStatus as AvailablitiyStatus,
    p.cartBType as IsAlshamilProduct,
    p.productBDesc as Description,
    p.productBSubmitDate as SubmitDate,
    p.Bpost_main_img as Image,
    -- p.productBValidity as Validity, -- Product dont have validity, only trader-payment have validity
    p.productBReleaseYear as ReleaseYear,
    NULL as Digits,
    NULL as Number
FROM
    productbike p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productBtBrand as Brand,
    p.productBtModel as Model,
    p.productBtCallPrice as CallPrice,
    p.productBtprice as Price,
    p.productBTStatus as AvailablitiyStatus,
    p.cartBTType as IsAlshamilProduct,
    p.productBDesc as Description,
    p.productBTSubmitDate as SubmitDate,
    p.BTpost_main_img as Image,
    -- p.productBValidity as Validity, -- Product dont have validity, only trader-payment have validity
    p.productBReleaseYear as ReleaseYear,
    NULL as Digits,
    NULL as Number
FROM
    productboat p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productCBrand as Brand,
    p.productCModel as Model,
    p.productCCallPrice as CallPrice,
    p.productCprice as Price,
    p.productCStatus as AvailablitiyStatus,
    p.cartCType as IsAlshamilProduct,
    p.productCDesc as Description,
    p.productCSubmitDate as SubmitDate,
    p.Cpost_main_img as Image,
    -- p.productCValidity as Validity, -- Product dont have validity, only trader-payment have validity
    p.productCReleaseYear as ReleaseYear,
    NULL as Digits,
    NULL as Number
FROM
    productcar p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productNPEmrites as Brand,
    p.productNPCode as Model,
    p.productNPCallPrice as CallPrice,
    p.productNPPrice as Price,
    p.productNPStatus as AvailablitiyStatus,
    p.cartNPType as IsAlshamilProduct,
    p.productNPDesc as Description,
    p.productNPSubmitDate as SubmitDate,
    p.NPpost_main_img as Image,
    -- p.productNPValidity as Validity, -- Product dont have validity, only trader-payment have validity
    NULL as ReleaseYear,
    p.productNPDigits as Digits,
    p.productNPNmbr as Number
FROM
    productnp p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productVBrand as Brand,
    p.productVModel as Model,
    p.productVCallPrice as CallPrice,
    p.productVprice as Price,
    p.productVStatus as AvailablitiyStatus,
    p.cartVType as IsAlshamilProduct,
    p.productVDesc as Description,
    p.productVSubmitDate as SubmitDate,
    p.Vpost_main_img as Image,
    -- p.productVValidity as Validity, -- Product dont have validity, only trader-payment have validity
    NULL as ReleaseYear,
    NULL as Digits,
    NULL as Number
FROM
    productvertu p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productWBrand as Brand,
    p.productWModel as Model,
    p.productWCallPrice as CallPrice,
    p.productWprice as Price,
    p.productWStatus as AvailablitiyStatus,
    p.cartWType as IsAlshamilProduct,
    p.productWDesc as Description,
    p.productWSubmitDate as SubmitDate,
    p.Wpost_main_img as Image,
    -- p.productWValidity as Validity, -- Product dont have validity, only trader-payment have validity
    NULL as ReleaseYear,
    NULL as Digits,
    NULL as Number
FROM
    productwatch p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productOperator as Brand,
    p.productMNPrefix as Model,
    p.productMNCallPrice as CallPrice,
    p.productMNPrice as Price,
    p.productMNStatus as AvailablitiyStatus,
    p.cartMNType as IsAlshamilProduct,
    p.productMNDesc as Description,
    p.productMNSubmitDate as SubmitDate,
    p.MNpost_main_img as Image,
    -- p.productMNValidity as Validity, -- Product dont have validity, only trader-payment have validity
    NULL as ReleaseYear,
    p.productMNDigits as Digits,
    p.productMNNmbr as Number
FROM
    productmn p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productPBrand as Brand,
    p.productPModel as Model,
    p.productPhCallPrice as CallPrice,
    p.productPHprice as Price,
    p.productPHStatus as AvailablitiyStatus,
    p.cartPHType as IsAlshamilProduct,
    p.productPDesc as Description,
    p.productPSubmitDate as SubmitDate,
    p.PHpost_main_img as Image,
    -- p.productPValidity as Validity, -- Product dont have validity, only trader-payment have validity
    NULL as ReleaseYear,
    NULL as Digits,
    NULL as Number
FROM
    productphone p
UNION
SELECT
    UUID() as ID,
    p.productCategoryID as CategoryID,
    p.productID as ProductID,
    p.traderID as TraderID,
    p.productLocation as Location,
    p.productPropSC as Brand,
    p.productPropType as Model,
    p.productPropCallPrice as CallPrice,
    p.productPRPrice as Price,
    p.productPRStatus as AvailablitiyStatus,
    p.cartPRType as IsAlshamilProduct,
    p.productDesc as Description,
    p.productPRSubmitDate as SubmitDate,
    p.PRpost_main_img as Image,
    -- p.productValidity as Validity, -- Product dont have validity, only trader-payment have validity
    NULL as ReleaseYear,
    NULL as Digits,
    NULL as Number
FROM
    productproperty p;



create OR REPLACE VIEW vwProductPost as
SELECT
    product.*,
    post.postID,
    post.postStatus as PostAdminStatus,
    post.rejectMsg,
    post.productViewCount,
    post.productLastViewed
FROM
    vwProduct product
    INNER JOIN post ON product.CategoryID = post.productCategoryID
    AND product.ProductID = post.productID
    AND product.TraderID = post.traderID;




CREATE OR REPLACE view vwNotifications as
select
    1 as isTypeFlagged,
    f.traderID,
    f.flagUserID as notificationBy,
    f.flagDate as date,
    f.postID,
    f.flagDesc as description,
    v.Brand as brand,
    v.Model as model,
    v.Price as price,
    v.CallPrice as callprice,
    v.Image as image
from
    flaggeditems f
    JOIN vwProductPost v ON f.postID = v.postID
UNION
select
    0 as isTypeFlagged,
    traderID,
    notificationBy as notificationBy,
    notificationDate as date,
    postID,
    notificationMessage as description,
    NULL as brand,
    NULL as model,
    NULL as price,
    NULL as callprice,
    NULL as image
from
    tradernotifications;


create OR REPLACE view vwNotificationsByUser as
select
    n.*,
    t.traderFullName as notificationByFullName
from
    vwNotifications n
    join trader t on t.traderID = n.notificationBy
order by
    n.date desc;


CREATE OR REPLACE VIEW `vwNotificationsByUserNw` AS
SELECT
    `n`.`isTypeFlagged` AS `isTypeFlagged`,
    `n`.`traderID` AS `traderID`,
    `n`.`notificationBy` AS `notificationBy`,
    date_format(`n`.`date`, '%d %b %Y') AS `date`,
    `n`.`postID` AS `postID`,
    `n`.`description` AS `description`,
    `n`.`brand` AS `brand`,
    `n`.`model` AS `model`,
    `n`.`price` AS `price`,
    `n`.`callprice` AS `callprice`,
    `n`.`image` AS `image`,
    `t`.`traderFullName` AS `notificationByFullName`
FROM
    (
        `vwNotifications` `n`
        join `trader` `t` on((`t`.`traderID` = `n`.`notificationBy`))
    )
order by
    `n`.`date` desc;    




CREATE  OR REPLACE VIEW  `vwProductPostNw`  AS  
select 
    `product`.`ID` AS `ID`,
    `product`.`CategoryID` AS `CategoryID`,
    `product`.`ProductID` AS `ProductID`,
    `product`.`TraderID` AS `TraderID`,
    `product`.`Location` AS `Location`,
    `product`.`Brand` AS `Brand`,
    `product`.`Model` AS `Model`,
    `product`.`CallPrice` AS `CallPrice`,
    `product`.`Price` AS `Price`,
    `product`.`AvailablitiyStatus` AS `AvailablitiyStatus`,
    `product`.`IsAlshamilProduct` AS `IsAlshamilProduct`,
    `product`.`Description` AS `Description`,
     date_format(`product`.`SubmitDate`,'%d %b %Y') AS `SubmitDate`,
    `product`.`Image` AS `Image`,`product`.`ReleaseYear` AS `ReleaseYear`,
    `product`.`Digits` AS `Digits`,`product`.`Number` AS `Number`,
    `post`.`postID` AS `postID`,`post`.`postStatus` AS `PostAdminStatus` 
from (`vwProduct` `product` 
join `post` 
on(((`product`.`CategoryID` = `post`.`productCategoryID`) 
and (`product`.`ProductID` = `post`.`productID`) 
and (`product`.`TraderID` = `post`.`traderID`)))) ;
   





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
    