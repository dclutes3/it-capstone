CREATE OR REPLACE VIEW view_item AS
SELECT
    a.id,
    a.name as item,
    b.name as type,
    c.price as price,
    c.id as price_id,
    d.name as store,
    c.modified_date as date,
    (SELECT SUM(e.type) from vote e WHERE e.price_id = c.id LIMIT 1) as vote
FROM
    item a
LEFT JOIN
    item_type b ON a.type_id = b.id
LEFT JOIN
    price c ON a.id = c.item_id
LEFT JOIN
    store d on c.store_id = d.id
LEFT JOIN
    vote e on c.id = e.price_id
WHERE
    a.name IS NOT NULL;
#AND 
#    c.price is not null;

CREATE OR REPLACE VIEW view_price_voting AS
SELECT
    a.id as id,
    a.type as vote_type,
    b.price as price,
    c.name as item_name,
    f.name as item_type,
    d.name as store_name,
    e.email as user,
    a.created_date as vote_date 
FROM
    vote a,
    price b,
    item c,
    store d,
    user e,
    item_type f
WHERE 
    price_id IS NOT NULL
AND a.price_id = b.id
AND b.item_id = c.id
AND b.user_id = e.id
AND b.store_id = d.id
AND c.type_id = f.id;

#CREATE OR REPLACE VIEW view_price_voting AS
#SELECT 
#    a.price_id as id,
#    c.name as name,
#    SUM(a.type) AS total_votes,
#    (SELECT SUM(a.type) FROM vote a WHERE (a.type = 'upvote') LIMIT 1) AS upvotes,
#    (SELECT SUM(a.type) FROM vote a WHERE (a.type = 'downvotes') LIMIT 1) AS downvotes
#FROM 
#    vote a,
#    price b,
#    item c
#WHERE
#    a.id = b.vote_id
#AND b.item_id = c.id;