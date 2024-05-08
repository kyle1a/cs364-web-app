DROP TABLE IF EXISTS Questions;

CREATE TABLE Questions (
    question CHARACTER VARYING(500) NOT NULL,
    answer CHARACTER VARYING(1000) NOT NULL,
    unit INTEGER NOT NULL,
    wrong BOOLEAN NOT NULL,
    attempts INTEGER,
    
    PRIMARY KEY (question)
);