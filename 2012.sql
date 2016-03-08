--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: account; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE account (
    username character varying(32) NOT NULL,
    firstname character varying(16) NOT NULL,
    lastname character varying(16) NOT NULL,
    licensenum character(9) NOT NULL,
    email character varying(256) NOT NULL,
    birthday date,
    password character varying(16) NOT NULL,
    balance money DEFAULT 0.00 NOT NULL,
    contact character(8) NOT NULL,
    gender character(1) NOT NULL,
    CONSTRAINT gender CHECK (((gender = 'M'::bpchar) OR (gender = 'F'::bpchar)))
);


ALTER TABLE account OWNER TO postgres;

--
-- Name: car; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE car (
    "regNum" character varying(8) NOT NULL,
    "numSeat" integer DEFAULT 0 NOT NULL,
    model character varying(20),
    owner character varying(32) NOT NULL,
    color character varying(12),
    make character varying(20)
);


ALTER TABLE car OWNER TO postgres;

--
-- Name: passenger; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE passenger (
    name character varying(32) NOT NULL,
    "rStart" time without time zone NOT NULL,
    "rDriver" character varying(32) NOT NULL,
    "rDate" date NOT NULL,
    status character(1) DEFAULT 'p'::bpchar NOT NULL
);


ALTER TABLE passenger OWNER TO postgres;

--
-- Name: COLUMN passenger.status; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN passenger.status IS 'P=pending C=confirmed R=rejected';


--
-- Name: ride; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ride (
    "startTime" time without time zone NOT NULL,
    date date NOT NULL,
    driver character varying(32) NOT NULL,
    car character varying(8) NOT NULL,
    "availSeats" integer NOT NULL,
    cost money DEFAULT 0 NOT NULL,
    "sNhood" character varying(20) NOT NULL,
    "sPostal" character(6) NOT NULL,
    "sAddr" character varying(64) NOT NULL,
    "dNhood" character varying(20) NOT NULL,
    "dPostal" character(6) NOT NULL,
    "dAddr" character varying(64) NOT NULL,
    status character(1) DEFAULT 'p'::bpchar NOT NULL
);


ALTER TABLE ride OWNER TO postgres;

--
-- Name: COLUMN ride.status; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN ride.status IS 'P=pending C=confirmed F=finished';


--
-- Name: transaction; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE transaction (
    "debitFrom" character varying(32) NOT NULL,
    "creditTo" character varying(32) NOT NULL,
    "rStart" time without time zone NOT NULL,
    "rDate" date NOT NULL,
    amount money
);


ALTER TABLE transaction OWNER TO postgres;

--
-- Name: account_contact_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY account
    ADD CONSTRAINT account_contact_key UNIQUE (contact);


--
-- Name: account_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY account
    ADD CONSTRAINT account_email_key UNIQUE (email);


--
-- Name: account_licensenum_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY account
    ADD CONSTRAINT account_licensenum_key UNIQUE (licensenum);


--
-- Name: account_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY account
    ADD CONSTRAINT account_pkey PRIMARY KEY (username);


--
-- Name: car_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY car
    ADD CONSTRAINT car_pkey PRIMARY KEY ("regNum");


--
-- Name: passenger_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY passenger
    ADD CONSTRAINT passenger_pkey PRIMARY KEY (name, "rStart", "rDriver", "rDate");


--
-- Name: ride_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ride
    ADD CONSTRAINT ride_pkey PRIMARY KEY (driver, date, "startTime");


--
-- Name: transaction_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY transaction
    ADD CONSTRAINT transaction_pkey PRIMARY KEY ("debitFrom", "creditTo", "rStart", "rDate");


--
-- Name: car_owner_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY car
    ADD CONSTRAINT car_owner_fkey FOREIGN KEY (owner) REFERENCES account(username) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: passenger_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY passenger
    ADD CONSTRAINT passenger_name_fkey FOREIGN KEY (name) REFERENCES account(username);


--
-- Name: passenger_rStart_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY passenger
    ADD CONSTRAINT "passenger_rStart_fkey" FOREIGN KEY ("rStart", "rDate", "rDriver") REFERENCES ride("startTime", date, driver);


--
-- Name: ride_car_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ride
    ADD CONSTRAINT ride_car_fkey FOREIGN KEY (car) REFERENCES car("regNum");


--
-- Name: ride_driver_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ride
    ADD CONSTRAINT ride_driver_fkey FOREIGN KEY (driver) REFERENCES account(username) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: transaction_debitFrom_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transaction
    ADD CONSTRAINT "transaction_debitFrom_fkey" FOREIGN KEY ("debitFrom") REFERENCES account(username);


--
-- Name: transaction_rStart_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transaction
    ADD CONSTRAINT "transaction_rStart_fkey" FOREIGN KEY ("rStart", "rDate", "creditTo") REFERENCES ride("startTime", date, driver);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

