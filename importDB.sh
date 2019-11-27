#!/bin/bash

#CALENDAR_DATES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c service_id,date,exception_type "./gtfs_csv_files/CALENDAR_DATES.csv";

#CALENDAR
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c service_id,monday,tuesday,wednesday,thursday,friday,saturday,sunday,start_date,end_date "./gtfs_csv_files/CALENDAR.csv";


#SHAPES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c service_id,monday,tuesday,wednesday,thursday,friday,saturday,sunday,start_date,end_date "./gtfs_csv_files/SHAPES.csv";


#AGENCY
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c agency_id,agency_name,agency_url,agency_timezone,agency_lang,agency_phone,agency_fare_url "./gtfs_csv_files/AGENCY.csv";

#ROUTES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c route_id,agency_id,route_short_name,route_long_name,route_desc,route_type,route_url,route_color,route_text_color "./gtfs_csv_files/ROUTES.csv";

#STOPS
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c stop_id,stop_code,stop_name,stop_desc,stop_lat,stop_lon "./gtfs_csv_files/STOPS.csv";

#TRIPS
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c route_id,service_id,trip_id,trip_headsign,trip_short_name,direction_id,block_id,shape_id,wheelchair_accessible,trip_time "./gtfs_csv_files/TRIPS.csv";

#STOP_TIMES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c trip_id,arrival_time,departure_time,stop_id,stop_sequence"./gtfs_csv_files/STOP_TIMES.csv";

#FARE_ATTRIBUTES
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c fare_id,price,currency_type,payment_method,transfers "./gtfs_csv_files/FARE_ATTRIBUTES.csv";

#FEED_INFO
mysqlimport -h localhost -P3306 -u vini -pvini GTFS --ignore-lines=1 --lines-terminated-by="\n" --fields-terminated-by="," --fields-enclosed-by="\""  -c feed_publisher_name,feed_publisher_url,feed_lang,feed_start_date,feed_end_date,feed_version"./gtfs_csv_files/FEED_INFO.csv";




