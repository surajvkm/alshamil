CREATE  VIEW `vwProductPostNw`  AS  
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
