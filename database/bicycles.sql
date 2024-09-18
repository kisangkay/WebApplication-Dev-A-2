drop table if exists bicycles;
drop table if exists review_users;
drop table if exists reviews;
drop table if exists manufacturers;
CREATE TABLE "bicycles"
(
    "bicycle_id"              INTEGER NOT NULL,
    "bicycle_name"            TEXT    NOT NULL UNIQUE,
    "bicycle_manufacturer_ID" INTEGER NOT NULL,
    "bicycle_image"           BLOB    DEFAULT null,
    "bicycle_description"     TEXT    DEFAULT ' ',
    "bicycle_total_reviews"   INTEGER DEFAULT 0,
    "bicycle_poster_user_id"  INTEGER NOT NULL,
    "bicycle_date_posted"     TEXT    NOT NULL,
    PRIMARY KEY ("bicycle_id" AUTOINCREMENT),
    FOREIGN KEY ("bicycle_manufacturer_ID") REFERENCES "manufacturers" ("manufacturer_id"),
    FOREIGN KEY("bicycle_poster_user_id") REFERENCES "review_users"("user_id")
);
CREATE TABLE "review_users"
(
    "user_id"  INTEGER NOT NULL,
    "username" INTEGER NOT NULL UNIQUE,
    "banned"   TEXT    NOT NULL DEFAULT 'no',
    PRIMARY KEY ("user_id" AUTOINCREMENT)
);
CREATE TABLE "reviews"
(
    "review_id"                          INTEGER NOT NULL,
    "review_creator_id"                  INTEGER NOT NULL,
    "rating"                             INTEGER NOT NULL,
    "review_date"                        TEXT    NOT NULL,
    "review_text"                        TEXT    NOT NULL,
    "bicycle_id_being_reviewed"          INTEGER NOT NULL,
    "manuf_id_of_bicycle_being_reviewed" INTEGER NOT NULL,
    "flags"                              INTEGER NOT NULL DEFAULT 0,
    PRIMARY KEY ("review_id" AUTOINCREMENT),
    FOREIGN KEY ("bicycle_id_being_reviewed") REFERENCES "bicycles" ("bicycle_id"),
    FOREIGN KEY ("review_creator_id") REFERENCES "review_users" ("user_id"),
    FOREIGN KEY ("manuf_id_of_bicycle_being_reviewed") REFERENCES "manufacturers" ("manufacturer_id")
);
CREATE TABLE "manufacturers"
(
    "manufacturer_id"               INTEGER NOT NULL,
    "manufacturer_name"             TEXT    NOT NULL,
    "manufacturer_headquarters"     TEXT    NOT NULL,
    "manufacturer_founder"          TEXT    NOT NULL,
    "manufacturer_year_established" TEXT    NOT NULL,
    "manufacturer_total_reviews"    INTEGER DEFAULT 0,
    PRIMARY KEY ("manufacturer_id" AUTOINCREMENT)
);

INSERT INTO bicycles (bicycle_name, bicycle_manufacturer_ID, bicycle_image, bicycle_description,
                      bicycle_total_reviews, bicycle_poster_user_id, bicycle_date_posted)
VALUES ('Mountain Bike X1', 1, 'images/atmos.png', 'A durable mountain bike for off-road adventures.', 1, 1,
        '02-09-2024'),
       ('Merida Scultura 200', 5, 'images/merida.png',
        'This is a great entry-level drop bar road bike, featuring a lightweight aluminium design that makes it affordable ' ||
        'without detracting from the dynamics of the design.', 1, 1, '02-09-2024'),
       ('Pedal Lynx 2 Electric', 2, 'images/atmos nerang.png',
        ' Pedal have made a great bike even more impressive! Featuring Big 29" wheels fitted with fast-rolling Maxxis tyres, a Boost Thru-Axle fork that helps improve steering accuracy.',
        1, 1, '02-09-2024'),
       ('Atmos Jubilee Hardtail', 3, 'images/norco.png', 'A versatile bike for both road and light trail use.', 2, 1,
        '02-09-2024'),
       ('Norco Storm 1 SE 29', 4, 'images/pedal.png',
        'The Norco Storm 1 SE Hardtail Mountain Bike is one of the most ' ||
        'popular hardtail mountain bikes on the market and you all know why after your first' ||
        ' ride. The Storm 1 is built with a lightweight alloy frame.', 1, 2, '02-09-2024');

INSERT INTO review_users (username, banned)
VALUES ('sam', 'no'),
       ('kim', 'no'),
       ('ted', 'no'),
       ('fay', 'yes'),
       ('hary', 'no'),
       ('vin', 'no'),
       ('admin', 'no');


INSERT INTO reviews (review_creator_id, rating, review_date, review_text, bicycle_id_being_reviewed,
                     manuf_id_of_bicycle_being_reviewed, flags)
VALUES (1, 4, '02-09-2024', 'I''d say one of the best durable tyres from the 2022 batch', 1, 1, 0),
       (3, 5, '02-09-2024', 'Excellent for its price', 3, 2, 0),
       (4, 5, '02-09-2024', 'Yes it seems to do exactly as I expected on steeps', 4, 3, 0),
       (6, 4, '02-09-2024', 'Very good bike', 4, 3, 0),
       (2, 4, '02-09-2024', 'Yes it seems to do exactly as I expected on steeps', 5, 4, 0),
       (5, 5, '02-09-2024',
        'I couldn''t tell if the tyres needed to be readjusted until I saw the manual. very easy to service ', 2, 5, 0);

INSERT INTO manufacturers (manufacturer_name, manufacturer_headquarters, manufacturer_founder,
                           manufacturer_year_established, manufacturer_total_reviews)
VALUES ('Cube', 'Waldershof, Germany', 'Marcus Pürner', 1993, 1),
       ('Pedal', 'Gledswood Hills NSW, Australia', ' Matt Turner ', 2013, 1),
       ('Atmos Jubilee ', '2/14 Haigh Avenue Nowra NSW, Australia', 'Atmos Group', 2001, 2),
       ('Norco Storm', 'South Windsor NSW, Australia', 'Bert Lewis', 2016, 1),
       ('Merida ', 'Yuanlin City, Taiwan', 'Ike Tseng', 1972, 1);



