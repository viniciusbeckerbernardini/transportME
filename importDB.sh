#!/bin/bash

#CALENDAR
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c service_id,monday,tuesday,wednesday,thursday,friday,saturday,sunday,start_date,end_date "/var/lib/mysql-files/gtfs_csv_files/CALENDAR.csv";

#CALENDAR_DATES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c service_id,date,exception_type "/var/lib/mysql-files/gtfs_csv_files/CALENDAR_DATES.csv";

#AGENCY
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c agency_id,agency_name,agency_url,agency_timezone,agency_lang,agency_phone,agency_fare_url "/var/lib/mysql-files/gtfs_csv_files/AGENCY.csv";

#ROUTES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c route_id,agency_id,route_short_name,route_long_name,route_desc,route_type,route_url,route_color,route_text_color "/var/lib/mysql-files/gtfs_csv_files/ROUTES.csv";

#TRIPS
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c route_id,service_id,trip_id,trip_headsign,trip_short_name,direction_id,block_id,shape_id,wheelchair_accessible,trip_time "/var/lib/mysql-files/gtfs_csv_files/TRIPS.csv";

#SHAPES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c shape_id,shape_pt_lat,shape_pt_lon,shape_pt_sequence "/var/lib/mysql-files/gtfs_csv_files/SHAPES.csv";

#STOPS
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c stop_id,stop_code,stop_name,stop_desc,stop_lat,stop_lon "/var/lib/mysql-files/gtfs_csv_files/STOPS.csv";

#FARE_ATTRIBUTES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c fare_id,price,currency_type,payment_method,transfers "/var/lib/mysql-files/gtfs_csv_files/FARE_ATTRIBUTES.csv";

#STOP_TIMES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c trip_id,arrival_time,departure_time,stop_id,stop_sequence "/var/lib/mysql-files/gtfs_csv_files/STOP_TIMES.csv";

#FEED_INFO
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," -c feed_publisher_name,feed_publisher_url,feed_lang,feed_start_date,feed_end_date,feed_version "/var/lib/mysql-files/gtfs_csv_files/FEED_INFO.csv";




