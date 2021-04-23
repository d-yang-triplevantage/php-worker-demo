-- Adminer 4.8.0 PostgreSQL 13.2 (Ubuntu 13.2-1.pgdg20.04+1) dump

\connect "d81cm7f22fhdpr";

DROP TABLE IF EXISTS "vctr__using__c";
DROP SEQUENCE IF EXISTS vctr__using__c_id_seq;
CREATE SEQUENCE vctr__using__c_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "salesforce001"."vctr__using__c" (
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
    "id" integer DEFAULT nextval('vctr__using__c_id_seq') NOT NULL,
    "_hc_lastop" character varying(32),
    "_hc_err" text,
    CONSTRAINT "hcu_idx_vctr__using__c_sfid" UNIQUE ("sfid"),
    CONSTRAINT "vctr__using__c_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "hc_idx_vctr__using__c_lastmodifieddate" ON "salesforce001"."vctr__using__c" USING btree ("lastmodifieddate");

CREATE INDEX "hc_idx_vctr__using__c_systemmodstamp" ON "salesforce001"."vctr__using__c" USING btree ("systemmodstamp");


-- 2021-04-23 14:07:36.390276+00
