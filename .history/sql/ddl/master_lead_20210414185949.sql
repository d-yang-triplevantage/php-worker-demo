-- Adminer 4.8.0 PostgreSQL 13.2 (Ubuntu 13.2-1.pgdg20.04+1) dump

DROP TABLE IF EXISTS "master_lead";
DROP SEQUENCE IF EXISTS master_lead_id_seq;
CREATE SEQUENCE master_lead_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "sfdcmaster"."master_lead" (
    "converteddate" date,
    "jigsaw" character varying(20),
    "lastname" character varying(80),
    "street" character varying(255),
    "isunreadbyowner" boolean,
    "emailbouncedreason" character varying(255),
    "numberofemployees" integer,
    "lastvieweddate" timestamp,
    "isconverted" boolean,
    "convertedcontactid" character varying(18),
    "dandbcompanyid" character varying(18),
    "city" character varying(40),
    "name" character varying(121),
    "latitude" double precision,
    "mobilephone" character varying(40),
    "lastmodifieddate" timestamp,
    "phone" character varying(40),
    "masterrecordid" character varying(18),
    "ownerid" character varying(18),
    "emailbounceddate" timestamp,
    "longitude" double precision,
    "isdeleted" boolean,
    "systemmodstamp" timestamp,
    "lastmodifiedbyid" character varying(18),
    "state" character varying(80),
    "status" character varying(255),
    "lastactivitydate" date,
    "individualid" character varying(18),
    "createddate" timestamp,
    "convertedaccountid" character varying(18),
    "country" character varying(80),
    "leadsource" character varying(255),
    "geocodeaccuracy" character varying(255),
    "postalcode" character varying(20),
    "salutation" character varying(255),
    "title" character varying(128),
    "jigsawcontactid" character varying(20),
    "createdbyid" character varying(18),
    "website" character varying(255),
    "firstname" character varying(40),
    "cleanstatus" character varying(255),
    "companydunsnumber" character varying(9),
    "convertedopportunityid" character varying(18),
    "email" character varying(80),
    "description" text,
    "company" character varying(255),
    "annualrevenue" double precision,
    "rating" character varying(255),
    "photourl" character varying(255),
    "lastreferenceddate" timestamp,
    "fax" character varying(40),
    "industry" character varying(255),
    "sfid" character varying(18),
    "id" integer  NOT NULL,
    "_hc_lastop" character varying(32),
    "_hc_err" text,
    "vctr__ownerid__c" character varying(1300),
    "vctr__introducer__c" character varying(255),
    "vctr__ownercompany__c" character varying(18),
    "vctr__shareok__c" boolean,
    "vctr__vectorno__c" character varying(255),
    CONSTRAINT "hcu_idx_master_lead_sfid" UNIQUE ("sfid"),
    CONSTRAINT "master_lead_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "hc_idx_master_lead_lastmodifieddate" ON "sfdcmaster"."master_lead" USING btree ("lastmodifieddate");

CREATE INDEX "hc_idx_master_lead_systemmodstamp" ON "sfdcmaster"."master_lead" USING btree ("systemmodstamp");


-- 2021-04-14 09:42:35.703933+00
