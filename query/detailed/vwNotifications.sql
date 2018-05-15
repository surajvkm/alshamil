
CREATE OR REPLACE view vwNotifications as
select
    1 as isTypeFlagged,
    -- isTypeFlagged : to differentiate notification message as Flagged and AdminMessage
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
    -- dont use traderId (because this adminmessage is not for a single post, but general message)
    notificationDate as date,
    postID,
    notificationMessage as description,
    NULL as brand,
    NULL as model,
    NULL as price,
    NULL as callprice,
    NULL as image
from
    tradernotifications 


create OR REPLACE view vwNotificationsByUser as
select
    n.*,
    t.traderFullName as notificationByFullName
from
    vwNotifications n
    join trader t on t.traderID = n.notificationBy
order by
    n.date desc