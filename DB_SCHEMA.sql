DROP DATABASE IF EXISTS GTFS;

CREATE DATABASE GTFS;

USE GTFS;

CREATE TABLE CALENDAR(
service_id varchar(200) not null primary key ,
monday varchar(200) null,
tuesday varchar(200) null,
wednesday varchar(200) null,
thursday varchar(200) null,
friday varchar(200) null,
saturday varchar(200) null,
sunday varchar(200) null,
start_date varchar(10) null,
end_date varchar(10) null
);

CREATE TABLE CALENDAR_DATES(
service_id varchar(200) not null,
date varchar(200) null,
exception_type varchar(200) null,
FOREIGN KEY (service_id) REFERENCES CALENDAR(service_id)
);

CREATE TABLE AGENCY(
agency_id varchar(200) not null primary key,
agency_name varchar(200) null,
agency_url varchar(200) null,
agency_timezone varchar(200) null,
agency_lang varchar(200) null,
agency_phone varchar(200) null,
agency_fare_url varchar(200) null
);

CREATE TABLE ROUTES(
route_id varchar(200) not  null primary key,
agency_id varchar(200) not null,
route_short_name varchar(200) null,
route_long_name varchar(200) null,
route_desc varchar(200) null,
route_type varchar(200) null,
route_url varchar(200) null,
route_color varchar(200) null,
route_text_color varchar(200) null,
FOREIGN KEY (agency_id) REFERENCES AGENCY(agency_id)
);

CREATE TABLE TRIPS(
route_id varchar(200) not null,
service_id varchar(200) not null,
trip_id varchar(200) not null primary key,
trip_headsign varchar(200) null,
trip_short_name varchar(200) null,
direction_id varchar(200)  null,
block_id varchar(200) null,
shape_id varchar(200) null,
wheelchair_accessible varchar(200) null,
trip_time varchar(200) null,
FOREIGN KEY (route_id) REFERENCES ROUTES(route_id),
FOREIGN KEY (service_id) REFERENCES CALENDAR(service_id)
);

CREATE TABLE SHAPES(
shape_id varchar(200) not null,
shape_pt_lat varchar(200) null,
shape_pt_lon varchar(200) null,
shape_pt_sequence varchar(200) null
);


CREATE TABLE STOPS(
stop_id varchar(200) not null primary key,
stop_code varchar(200) null,
stop_name varchar(200) null,
stop_desc varchar(200) null,
stop_lat varchar(200) null,
stop_lon varchar(200) null
);

CREATE TABLE FARE_ATTRIBUTES(
fare_id varchar(200) not null primary key,
price float null,
currency_type varchar(200) null,
payment_method varchar(200) null,
transfers varchar(200) null
);


CREATE TABLE STOP_TIMES(
trip_id varchar(200) not null,
arrival_time time null,
departure_time time null,
stop_id varchar(200) not null,
stop_sequence varchar(200) null,
FOREIGN KEY (stop_id) REFERENCES STOPS(stop_id),
FOREIGN KEY (trip_id) REFERENCES TRIPS(trip_id)
);

CREATE TABLE FEED_INFO(
feed_publisher_name varchar(200) null,
feed_publisher_url varchar(200) null,
feed_lang varchar(200) null,
feed_start_date varchar(200) null,
feed_end_date varchar(200) null,
feed_version varchar(200) null
);

CREATE TABLE USERS(
user_id int not null primary key auto_increment,
username varchar(80) not null unique key,
email varchar(150) not null unique key,
password text(256) not null,
thumbnail text(256) null,
last_login datetime not null default now(),
created_at datetime not null default now(),
is_admin boolean not null default false
);

INSERT INTO USERS (username, email, password, thumbnail, last_login, created_at, is_admin)
VALUES ('vini','vini@vini.com',12345,null,now(),now(),true);
