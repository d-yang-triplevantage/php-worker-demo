-- Adminer 4.8.0 PostgreSQL 13.2 (Ubuntu 13.2-1.pgdg20.04+1) dump

DROP TABLE IF EXISTS "sfdcmiddle"."middle_out_contact";
DROP SEQUENCE IF EXISTS "sfdcmiddle"."middle_out_contact_id_seq";
CREATE SEQUENCE "sfdcmiddle"."middle_out_contact_id_seq" INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "sfdcmiddle"."middle_out_contact" (
    "vctr__ownerid__c" character varying(1300),
    "jigsaw" character varying(20),
    "lastname" character varying(80),
    "otherstate" character varying(80),
    "mailingpostalcode" character varying(20),
    "emailbouncedreason" character varying(255),
    "mailinglongitude" double precision,
    "mailingstate" character varying(80),
    "othercountry" character varying(80),
    "othergeocodeaccuracy" character varying(255),
    "accountid" character varying(18),
    "otherpostalcode" character varying(20),
    "lastvieweddate" timestamp,
    "assistantname" character varying(40),
    "isemailbounced" boolean,
    "mailingcountry" character varying(80),
    "name" character varying(121),
    "mailinggeocodeaccuracy" character varying(255),
    "mobilephone" character varying(40),
    "birthdate" date,
    "lastmodifieddate" timestamp,
    "phone" character varying(40),
    "masterrecordid" character varying(18),
    "mailingstreet" character varying(255),
    "ownerid" character varying(18),
    "vctr__ownercompany__c" character varying(18),
    "emailbounceddate" timestamp,
    "isdeleted" boolean,
    "homephone" character varying(40),
    "assistantphone" character varying(40),
    "systemmodstamp" timestamp,
    "lastmodifiedbyid" character varying(18),
    "department" character varying(80),
    "lastactivitydate" date,
    "otherstreet" character varying(255),
    "individualid" character varying(18),
    "vctr__vectorno__c" character varying(255),
    "lastcurequestdate" timestamp,
    "reportstoid" character varying(18),
    "createddate" timestamp,
    "mailingcity" character varying(40),
    "mailinglatitude" double precision,
    "leadsource" character varying(255),
    "salutation" character varying(255),
    "title" character varying(128),
    "jigsawcontactid" character varying(20),
    "createdbyid" character varying(18),
    "othercity" character varying(40),
    "firstname" character varying(40),
    "cleanstatus" character varying(255),
    "otherlatitude" double precision,
    "email" character varying(80),
    "description" text,
    "photourl" character varying(255),
    "lastreferenceddate" timestamp,
    "fax" character varying(40),
    "otherphone" character varying(40),
    "otherlongitude" double precision,
    "lastcuupdatedate" timestamp,
    "sfid" character varying(18),
    "id" integer  NOT NULL,
    "_hc_lastop" character varying(32),
    "_hc_err" text,
    CONSTRAINT "middle_out_contact_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "hcu_idx_middle_out_contact_sfid" UNIQUE ("sfid")
) WITH (oids = false);

CREATE INDEX "hc_idx_middle_out_contact_lastmodifieddate" ON "sfdcmiddle"."middle_out_contact" USING btree ("lastmodifieddate");

CREATE INDEX "hc_idx_middle_out_contact_systemmodstamp" ON "sfdcmiddle"."middle_out_contact" USING btree ("systemmodstamp");


-- 2021-04-14 09:44:09.39641+00
