SELECT `username`
FROM (`operators`)
WHERE `username` = 'test'
LIMIT 1 
 Execution Time:0.17732620239258

SELECT `password`
FROM (`operators`)
WHERE `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.00025796890258789

SELECT *
FROM (`operators`)
WHERE `username` = 'test'
AND `password` = '098f6bcd4621d373cade4e832627b4f6'
LIMIT 1 
 Execution Time:0.030365943908691

SELECT *
FROM (`mt_role`)
WHERE `rid` = '1'
LIMIT 1 
 Execution Time:0.040504932403564

SELECT DISTINCT AJ.aid, `P`.pid,`P`.p2000_id, `P`.pname, `P`.surname, `P`.sex, `P`.email, `P`.dist_id, `P`.dob, `P`.contact_no, `P`.ssn, `P`.note, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`,`E`.`int_type`,`A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,CW.patient_address as address,CW.patient_city as city,CW.patient_zip as zip_code,CW.patient_latlng as latlang,E.int_type FROM (`assign_job_list` as A) JOIN  `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` JOIN contract_intervent_weekdays as CW on (CW.ciw_id = A.contract_int_id AND CW.pid = A.patient_id AND CW.intervent_id = A.intervent_type_id) JOIN  `intervention_types` as E ON `E`.`int_type_id`= `A`.`intervent_type_id` WHERE '3' IN (`A`.pry_oid,`A`.sec_oid,`A`.sup_id) AND `A`.`sel_week_day` = '7' AND `A`.`week` = '20' AND `AJ`.`status` = '1' AND `AJ`.`oid` = '3' 
 Execution Time:7.2923669815063

SELECT DISTINCT AJ.aid, `P`.*, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`, `A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,`A`.`job_date_assign`,`E`.`int_type` FROM (`assign_job_list` as A) JOIN `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` JOIN  `intervention_types` as E ON `E`.`int_type_id`= `A`.`intervent_type_id` WHERE `AJ`.`oid` = '3' AND (`A`.`job_date_assign` between '2015-05-18' AND '2015-05-24') AND `AJ`.`status` = '1' ORDER BY `A`.job_date_assign ASC, TIME(CONCAT(`A`.start_time_hour,':', `A`.start_time_min)) ASC 
 Execution Time:0.99408197402954

SELECT `piid`, `pid`, `rid`, `info`
FROM (`patients_info_details`)
WHERE `pid` =  '817'
AND `status` =  '1'
AND FIND_IN_SET('1',rid) != 0 
 Execution Time:0.41567802429199

select a.label_name,a.type,a.options,a.required,a.order,b.int_type_id as intervent_type_id from intervention_fields as a, intervention_types_assign as b where (b.int_type_asg_id  =  a.int_type_asg_id) and (b.role='1' and b.int_type_id = '6') and visible = 1 order by `order` ASC 
 Execution Time:0.13854002952576

