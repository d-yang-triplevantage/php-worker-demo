-- Adminer 4.8.0 PostgreSQL 13.2 (Ubuntu 13.2-1.pgdg20.04+1) dump

DROP TABLE IF EXISTS "sfdcmaster"."master_company__c";
DROP SEQUENCE IF EXISTS "sfdcmaster"."master_company__c_id_seq";
CREATE SEQUENCE "sfdcmaster"."master_company__c_id_seq" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "sfdcmaster"."master_company__c" (
    "vctr__account__c" character varying(18),
    "name" character varying(80),
    "lastmodifieddate" timestamp,
    "vctr__contact__c" character varying(18),
    "isdeleted" boolean,
    "systemmodstamp" timestamp,
    "lastmodifiedbyid" character varying(18),
    "createddate" timestamp,
    "vctr__groupcompany__c" character varying(18),
    "createdbyid" character varying(18),
    "vctr__lead__c" character varying(18),
    "vctr__optout__c" boolean,
    "sfid" character varying(18),
    "id" integer  NOT NULL,
    "_hc_lastop" character varying(32),
    "_hc_err" text,
    CONSTRAINT "hcu_idx_master_company__c_sfid" UNIQUE ("sfid"),
    CONSTRAINT "master_company__c_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "hc_idx_master_company__c_lastmodifieddate" ON "sfdcmaster"."master_company__c" USING btree ("lastmodifieddate");

CREATE INDEX "hc_idx_master_company__c_systemmodstamp" ON "sfdcmaster"."master_company__c" USING btree ("systemmodstamp");


-- 2021-04-14 09:44:30.858022+00
