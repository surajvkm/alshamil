-- create view vwProductPost as
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
    AND product.TraderID = post.traderID