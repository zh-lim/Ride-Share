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
-- Name: passenger_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY passenger
    ADD CONSTRAINT passenger_pkey PRIMARY KEY (name, "rStart", "rDriver", "rDate");


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
-- PostgreSQL database dump complete
--

