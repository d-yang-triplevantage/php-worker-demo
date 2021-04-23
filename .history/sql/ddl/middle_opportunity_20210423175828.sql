-- Adminer 4.8.0 PostgreSQL 13.2 (Ubuntu 13.2-1.pgdg20.04+1) dump

DROP TABLE IF EXISTS "sfdcmiddle"."middle_opportunity";
DROP SEQUENCE IF EXISTS "sfdcmiddle"."middle_opportunity_id_seq";
CREATE SEQUENCE "sfdcmiddle"."middle_opportunity_id_seq" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "sfdcmiddle"."middle_opportunity" (
    "vctr__ownerid__c" character varying(1300),
    "hasopportunitylineitem" boolean,
    "expectedrevenue" double precision,
    "forecastcategoryname" character varying(255),
    "closedate" date,
    "accountid" character varying(18),
    "lastvieweddate" timestamp,
    "stagename" character varying(255),
    "lastamountchangedhistoryid" character varying(18),
    "lastclosedatechangedhistoryid" character varying(18),
    "campaignid" character varying(18),
    "name" character varying(120),
    "hasoverduetask" boolean,
    "iswon" boolean,
    "lastmodifieddate" timestamp,
    "vctr__month__c" double precision,
    "fiscalquarter" integer,
    "ownerid" character varying(18),
    "vctr__ownercompany__c" character varying(18),
    "isdeleted" boolean,
    "systemmodstamp" timestamp,
    "lastmodifiedbyid" character varying(18),
    "lastactivitydate" date,
    "hasopenactivity" boolean,
    "vctr__vectorno__c" character varying(255),
    "probability" double precision,
    "vctr__shareng__c" boolean,
    "createddate" timestamp,
    "isclosed" boolean,
    "leadsource" character varying(255),
    "amount" double precision,
    "forecastcategory" character varying(255),
    "isprivate" boolean,
    "createdbyid" character varying(18),
    "totalopportunityquantity" double precision,
    "type" character varying(255),
    "pricebook2id" character varying(18),
    "contactid" character varying(18),
    "fiscalyear" integer,
    "description" text,
    "lastreferenceddate" timestamp,
    "syncedquoteid" character varying(18),
    "fiscal" character varying(6),
    "nextstep" character varying(255),
    "sfid" character varying(18),
    "id" integer  NOT NULL,
    "_hc_lastop" character varying(32),
    "_hc_err" text,
    CONSTRAINT "hcu_idx_middle_opportunity_sfid" UNIQUE ("sfid"),
    CONSTRAINT "middle_opportunity_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "hc_idx_middle_opportunity_lastmodifieddate" ON "sfdcmiddle"."middle_opportunity" USING btree ("lastmodifieddate");

CREATE INDEX "hc_idx_middle_opportunity_systemmodstamp" ON "sfdcmiddle"."middle_opportunity" USING btree ("systemmodstamp");


-- 2021-04-14 09:44:16.916878+00
