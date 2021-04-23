-- Adminer 4.8.0 PostgreSQL 13.2 (Ubuntu 13.2-1.pgdg20.04+1) dump

DROP TABLE IF EXISTS "sfdcmiddle"."middle_account";
DROP SEQUENCE IF EXISTS "sfdcmiddle"."middle_account_id_seq";
CREATE SEQUENCE "sfdcmiddle"."middle_account_id_seq" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "sfdcmiddle"."middle_account" (
    "vctr__ownerid__c" character varying(1300),
    "jigsaw" character varying(20),
    "shippinglongitude" double precision,
    "tickersymbol" character varying(20),
    "shippingstate" character varying(80),
    "yearstarted" character varying(4),
    "numberofemployees" integer,
    "parentid" character varying(18),
    "shippingpostalcode" character varying(20),
    "billingcity" character varying(40),
    "site" character varying(80),
    "billinglatitude" double precision,
    "accountsource" character varying(255),
    "shippingcountry" character varying(80),
    "lastvieweddate" timestamp,
    "shippinggeocodeaccuracy" character varying(255),
    "operatinghoursid" character varying(18),
    "dandbcompanyid" character varying(18),
    "name" character varying(255),
    "sic" character varying(20),
    "tradestyle" character varying(255),
    "lastmodifieddate" timestamp,
    "phone" character varying(40),
    "masterrecordid" character varying(18),
    "ownerid" character varying(18),
    "vctr__ownercompany__c" character varying(18),
    "ownership" character varying(255),
    "isdeleted" boolean,
    "systemmodstamp" timestamp,
    "lastmodifiedbyid" character varying(18),
    "shippingstreet" character varying(255),
    "lastactivitydate" date,
    "billingpostalcode" character varying(20),
    "naicscode" character varying(8),
    "billinglongitude" double precision,
    "vctr__vectorno__c" character varying(255),
    "createddate" timestamp,
    "billingstate" character varying(80),
    "accountnumber" character varying(40),
    "jigsawcompanyid" character varying(20),
    "naicsdesc" character varying(120),
    "shippingcity" character varying(40),
    "shippinglatitude" double precision,
    "createdbyid" character varying(18),
    "type" character varying(255),
    "website" character varying(255),
    "billingcountry" character varying(80),
    "cleanstatus" character varying(255),
    "description" text,
    "billinggeocodeaccuracy" character varying(255),
    "annualrevenue" double precision,
    "rating" character varying(255),
    "photourl" character varying(255),
    "lastreferenceddate" timestamp,
    "fax" character varying(40),
    "sicdesc" character varying(80),
    "industry" character varying(255),
    "billingstreet" character varying(255),
    "dunsnumber" character varying(9),
    "sfid" character varying(18),
    "id" integer  NOT NULL,
    "_hc_lastop" character varying(32),
    "_hc_err" text,
    CONSTRAINT "middle_account_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "hcu_idx_middle_account_sfid" UNIQUE ("sfid")
) WITH (oids = false);

CREATE INDEX "hc_idx_middle_account_lastmodifieddate" ON "sfdcmiddle"."middle_account" USING btree ("lastmodifieddate");

CREATE INDEX "hc_idx_middle_account_systemmodstamp" ON "sfdcmiddle"."middle_account" USING btree ("systemmodstamp");


-- 2021-04-14 09:43:57.915289+00
