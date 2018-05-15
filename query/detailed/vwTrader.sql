
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
    LEFT JOIN tradersubscriptionplan ts ON t.traderID = ts.traderID