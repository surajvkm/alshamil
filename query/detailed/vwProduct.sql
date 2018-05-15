-- create view vwProduct as
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
    productproperty p