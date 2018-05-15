-- Create syntax for 'vwNotificationsByUserNw'
CREATE VIEW `vwNotificationsByUserNw` AS
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