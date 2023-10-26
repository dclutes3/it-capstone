CREATE OR REPLACE VIEW view_item AS
SELECT
    a.id,
    a.name as name,
    b.name as type_name,
    c.price as price
FROM
    item a,
    item_type b,
    price c
WHERE
    a.type_id = b.id
AND
    a.id = c.item_id;

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