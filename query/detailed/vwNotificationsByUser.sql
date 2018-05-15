CREATE VIEW `vwNotificationsByUser` AS
select
    `n`.`isTypeFlagged` AS `isTypeFlagged`,
    `n`.`traderID` AS `traderID`,
    `n`.`notificationBy` AS `notificationBy`,
    `n`.`date` AS `date`,
    `n`.`postID` AS `postID`,
    `n`.`description` AS `description`,
    `n`.`brand` AS `brand`,
    `n`.`model` AS `model`,
    `n`.`price` AS `price`,
    `n`.`callprice` AS `callprice`,
    `n`.`image` AS `image`,
    `t`.`traderFullName` AS `notificationByFullName`
from
    (
        `vwNotifications` `n`
        join `trader` `t` on((`t`.`traderID` = `n`.`notificationBy`))
    )
order by
    `n`.`date` desc