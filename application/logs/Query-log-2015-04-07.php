SELECT `username`
FROM (`operators`)
WHERE `username` = 'test'
LIMIT 1 
 Execution Time:0.9809730052948

SELECT `password`
FROM (`operators`)
WHERE `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.024151086807251

SELECT *
FROM (`operators`)
WHERE `username` = 'test'
AND `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.20113301277161

SELECT *
FROM (`mt_role`)
WHERE `rid` = '1'
LIMIT 1 
 Execution Time:0.061751842498779

SELECT `username`
FROM (`operators`)
WHERE `username` = 'test'
LIMIT 1 
 Execution Time:0.06807804107666

SELECT `password`
FROM (`operators`)
WHERE `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.00020098686218262

SELECT *
FROM (`operators`)
WHERE `username` = 'test'
AND `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.00014710426330566

SELECT *
FROM (`mt_role`)
WHERE `rid` = '1'
LIMIT 1 
 Execution Time:9.5844268798828E-5

SELECT DISTINCT AJ.aid, `P`.pid,`P`.p2000_id, `P`.pname, `P`.surname, `P`.sex, `P`.email, `P`.dist_id, `P`.dob, `P`.contact_no, `P`.ssn, `P`.note, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`,`E`.`int_type`,`A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,CW.patient_address as address,CW.patient_city as city,CW.patient_zip as zip_code,CW.patient_latlng as latlang,E.int_type FROM (`assign_job_list` as A) JOIN  `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` JOIN contract_intervent_weekdays as CW on (CW.ciw_id = A.contract_int_id AND CW.pid = A.patient_id AND CW.intervent_id = A.intervent_type_id) JOIN  `intervention_types` as E ON `E`.`int_type_id`= `A`.`intervent_type_id` WHERE '3' IN (`A`.pry_oid,`A`.sec_oid,`A`.sup_id) AND `A`.`sel_week_day` = '2' AND `A`.`week` = '15' AND `AJ`.`status` = '1' AND `AJ`.`oid` = '3' 
 Execution Time:9.6333441734314

SELECT DISTINCT AJ.aid, `P`.*, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`, `A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,`A`.`job_date_assign`,`E`.`int_type` FROM (`assign_job_list` as A) JOIN `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` JOIN  `intervention_types` as E ON `E`.`int_type_id`= `A`.`intervent_type_id` WHERE `AJ`.`oid` = '3' AND (`A`.`job_date_assign` between '2015-04-08' AND '2015-04-14') AND `AJ`.`status` = '1' ORDER BY `A`.job_date_assign ASC, TIME(CONCAT(`A`.start_time_hour,':', `A`.start_time_min)) ASC 
 Execution Time:0.51954197883606

SELECT `username`
FROM (`operators`)
WHERE `username` = 'test'
LIMIT 1 
 Execution Time:0.00023984909057617

SELECT `password`
FROM (`operators`)
WHERE `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.00013399124145508

SELECT *
FROM (`operators`)
WHERE `username` = 'test'
AND `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.00010800361633301

SELECT *
FROM (`mt_role`)
WHERE `rid` = '1'
LIMIT 1 
 Execution Time:9.2983245849609E-5

SELECT DISTINCT AJ.aid, `P`.pid,`P`.p2000_id, `P`.pname, `P`.surname, `P`.sex, `P`.email, `P`.dist_id, `P`.dob, `P`.contact_no, `P`.ssn, `P`.note, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`,`E`.`int_type`,`A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,CW.patient_address as address,CW.patient_city as city,CW.patient_zip as zip_code,CW.patient_latlng as latlang,E.int_type FROM (`assign_job_list` as A) JOIN  `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` JOIN contract_intervent_weekdays as CW on (CW.ciw_id = A.contract_int_id AND CW.pid = A.patient_id AND CW.intervent_id = A.intervent_type_id) JOIN  `intervention_types` as E ON `E`.`int_type_id`= `A`.`intervent_type_id` WHERE '3' IN (`A`.pry_oid,`A`.sec_oid,`A`.sup_id) AND `A`.`sel_week_day` = '2' AND `A`.`week` = '15' AND `AJ`.`status` = '1' AND `AJ`.`oid` = '3' 
 Execution Time:0.00020599365234375

SELECT DISTINCT AJ.aid, `P`.*, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`, `A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,`A`.`job_date_assign`,`E`.`int_type` FROM (`assign_job_list` as A) JOIN `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` JOIN  `intervention_types` as E ON `E`.`int_type_id`= `A`.`intervent_type_id` WHERE `AJ`.`oid` = '3' AND (`A`.`job_date_assign` between '2015-04-08' AND '2015-04-14') AND `AJ`.`status` = '1' ORDER BY `A`.job_date_assign ASC, TIME(CONCAT(`A`.start_time_hour,':', `A`.start_time_min)) ASC 
 Execution Time:0.00029706954956055

