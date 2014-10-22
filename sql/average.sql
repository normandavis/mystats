# The AVG() function returns the average value of a numeric column.

# // SQL AVG() Syntax

SELECT AVG(column_name) FROM table_name

SELECT AVG(`systolic`) FROM `actual`;

# The following SQL statement gets the average value of the "Price" column from the "Products" table:

# Example

SELECT AVG(Price) AS PriceAverage FROM Products;

SELECT	AVG(`systolic`) AS avgsys,
        AVG(`diastolic`) AS avgdias, 
	AVG(pulse) AS avgpulse 
FROM `actual` 
WHERE `systolic` > 0;


# The following SQL statement selects the "ProductName" and "Price" records that have an above average price:

# Example

SELECT ProductName, Price FROM Products
WHERE Price>(SELECT AVG(Price) FROM Products);


/* Doesn't work */
UPDATE `actual` SET `systolic` = `bollox` where SELECT AVG(`systolic`) FROM `actual` as `bollox` WHERE `id` IN (448,450);



UPDATE 
    t2
SET 
    t2.MeanNum = sub.MeanNum
From 
    Table2 t2
    INNER JOIN 
        (
        Select DISTINCT 
            Table1.[MIU ID], 
            Avg(Table1.[Avg RSSI] as MeanNum
        From 
            Table1  
        GROUP BY 
            Table1.[MIU ID] 
        ) sub
        ON sub.[MIU ID] = t2.MIUID 


UPDATE analyzedCopy2 AS target
INNER JOIN 
(
    select avg(RSSI) as AvgRSSI, readings_miu_id
    from analyzedCopy2 T
    group by readings_miu_id
) as source
ON target.readings_miu_id = source.readings_miu_id
SET target.RSSI = source.AvgRSSI
