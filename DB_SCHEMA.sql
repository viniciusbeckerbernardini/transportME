DROP DATABASE IF EXISTS GTFS;

CREATE DATABASE GTFS;

USE GTFS;


CREATE TABLE CALENDAR_DATES(

service_id varchar(200) not null primary key,
date varchar(10) not null,
exception_type char(2) not null

);


CREATE TABLE CALENDAR(

service_id varchar(200) not null primary key,
monday int(2) not null,
tuesday int(2) not null,
wednesday int(2) not null,
thursday int(2) not null,
friday int(2) not null,
saturday int(2) not null,
sunday int(2) not null,
start_date varchar(10) not null,
end_date varchar(10) not null

);

CREATE TABLE SHAPES(
shape_id varchar(200) not null primary key,
shape_pt_lat varchar(200) not null,
shape_pt_lon varchar(200) not null,
shape_pt_sequence int not null
);

CREATE TABLE AGENCY(
agency_id varchar(200) not null primary key,
agency_name varchar(200) not null,
agency_url varchar(200) not null,
agency_timezone varchar(200) not null,
agency_lang char(2) not null,
agency_phone char(18) not null,
agency_fare_url text not null

);


CREATE TABLE ROUTES(
route_id varchar(200) not null primary key,
agency_id varchar(200) not null,
route_short_name varchar(200) not null,
route_long_name varchar(200) not null,
route_desc varchar(200) not null,
route_type varchar(200) not null,
route_url varchar(200) not null,
route_color varchar(200) not null,
route_text_color varchar(200) not null,
FOREIGN KEY (agency_id) REFERENCES AGENCY(agency_id)
);


CREATE TABLE STOPS(
stop_id int not null primary key auto_increment,
stop_code varchar(200) null,
stop_name varchar(200) not null,
stop_desc varchar(200) null,
stop_lat varchar(200) not null,
stop_lon varchar(200) not null
);


CREATE TABLE TRIPS(
route_id varchar(200) not null,
service_id varchar(200) not null,
trip_id varchar(200) not null primary key,
trip_headsign varchar(200) null,
trip_short_name varchar(200) null,
direction_id varchar(200) not null,
block_id varchar(200) not null,
shape_id varchar(200) not null,
wheelchair_accessible varchar(200) not null,
trip_time varchar(200) not null,
FOREIGN KEY (route_id) REFERENCES ROUTES(route_id),
FOREIGN KEY (shape_id) REFERENCES SHAPES(shape_id)
);


CREATE TABLE STOP_TIMES(
trip_id varchar(200) not null,
arrival_time time not null,
departure_time time not null,
stop_id int not null,
stop_sequence int not null,
FOREIGN KEY (trip_id) REFERENCES TRIPS(trip_id),
FOREIGN KEY (stop_id) REFERENCES STOPS(stop_id)
);



CREATE TABLE FARE_ATTRIBUTES(
fare_id varchar(200) not null primary key,
price float not null,
currency_type varchar(200) not null,
payment_method int not null,
transfers int not null
);

CREATE TABLE FEED_INFO(
feed_publisher_name varchar(200) not null,
feed_publisher_url varchar(200) not null,
feed_lang varchar(200) not null,
feed_start_date varchar(200) not null,
feed_end_date varchar(200) not null,
feed_version varchar(200) not null
);
