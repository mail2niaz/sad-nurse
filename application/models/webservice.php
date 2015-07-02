<?php
$img_url = "";
error_reporting(0);
require('fpdf16/fpdf.php');
/* require the action as the parameter */
	if(isset($_REQUEST['action'])) {
		
		$action = $_REQUEST['action'];
		$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
		/* connect to the db */
		$link = mysql_connect('localhost','root','Passw0rd@123') or die('Cannot connect to the DB');
		mysql_select_db('shriram_property',$link) or die('Cannot select the DB');

		/* grab the posts from the db */
		if($action == 'project_detail')
		{
			$query = "SELECT * FROM projects";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i = 1;
				while($post = mysql_fetch_assoc($result)) {
				
				    /* Gallery Image */
					$query1 = "SELECT * FROM project_images where project_id =".$post['id'] ;
					$result1 = mysql_query($query1,$link) or die('Errant query:  '.$query1);
					
					/* Amenity Image */
					$query2 = "SELECT * FROM amenity_images where project_id =".$post['id'] ;
					$result2 = mysql_query($query2,$link) or die('Errant query:  '.$query2);
					
					/* Club House Image */
					$query3 = "SELECT * FROM club_house_images where project_id =".$post['id'] ;
					$result3 = mysql_query($query3,$link) or die('Errant query:  '.$query3);
					
					/* Floor Plan Image */
					$query4 = "SELECT * FROM floor_plan_images where project_id =".$post['id'] ;
					$result4 = mysql_query($query4,$link) or die('Errant query:  '.$query4);
					
					$posts['projects_name'] =$post['projects_name'];
					$posts['descrptions'] =$post['descrptions'];
					$posts['address'] =$post['address'];
					$posts['city'] =$post['city'];
					$posts['latitude'] =$post['latitude'];
					$posts['longtitude'] =$post['longtitude'];
					$posts['specification'] =$post['specification'];
					
					/* Gallery Image */
					$ii = 1;
					while($post1 = mysql_fetch_assoc($result1)) {
						$posts['gallery_image'][]['image'] =$post1['image'];
						$ii++;
					}
					/* Amenity Image */
					$iii = 1;
															
					while($post2 = mysql_fetch_assoc($result2)) {
						$posts['amenity_images'][]['image'] =$post2['image'];
						$iii++;
					}
					
					/* Club House Image */
					$iiii = 1;
					while($post3 = mysql_fetch_assoc($result3)) {
						$posts['club_house_images'][]['image'] =$post3['image'];
						$iiii++;
					}
					/* Floor Plan Image */
					$j = 1;
					while($post4 = mysql_fetch_assoc($result4)) {
						$posts['floor_plan_images'][]['image'] =$post4['image'];
						$j++;
					}
					$i++;
					$projects['projects'][] = $posts;
					$posts = array();
				}
				
			}
			header('Content-type: application/json');
			echo json_encode($projects);
		}
		if($action == 'home_page') {
		
			$query = "SELECT * FROM projects LIMIT 0,4";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i = 1;
				while($post = mysql_fetch_assoc($result)) {
				
				    /* Gallery Image */
					$query1 = "SELECT * FROM project_images where project_id =".$post['id'] ;
					$result1 = mysql_query($query1,$link) or die('Errant query:  '.$query1);
					
					/* Amenity Image */
					$query2 = "SELECT * FROM amenity_images where project_id =".$post['id'] ;
					$result2 = mysql_query($query2,$link) or die('Errant query:  '.$query2);
					
					/* Club House Image */
					$query3 = "SELECT * FROM club_house_images where project_id =".$post['id'] ;
					$result3 = mysql_query($query3,$link) or die('Errant query:  '.$query3);
					
					/* Floor Plan Image */
					$query4 = "SELECT * FROM floor_plan_images where project_id =".$post['id'] ;
					$result4 = mysql_query($query4,$link) or die('Errant query:  '.$query4);
					
					$posts['projects_name'] =$post['projects_name'];
					$posts['descrptions'] =$post['descrptions'];
					$posts['address'] =$post['address'];
					$posts['city'] =$post['city'];
					$posts['latitude'] =$post['latitude'];
					$posts['longtitude'] =$post['longtitude'];
					$posts['video1'] =$post['video1'];
					$posts['video2'] =$post['video2'];
					$posts['video3'] =$post['video3'];
					$posts['video4'] =$post['video4'];
					$posts['video5'] =$post['video5'];
					$posts['specification'] =$post['specification'];
					
					/* Gallery Image */
					$ii = 1;
					while($post1 = mysql_fetch_assoc($result1)) {
						$posts['gallery_image'][]['image'] =$post1['image'];
						$ii++;
					}
					/* Amenity Image */
					$iii = 1;
															
					while($post2 = mysql_fetch_assoc($result2)) {
						$posts['amenity_images'][]['image'] =$post2['image'];
						$iii++;
					}
					
					/* Club House Image */
					$iiii = 1;
					while($post3 = mysql_fetch_assoc($result3)) {
						$posts['club_house_images'][]['image'] =$post3['image'];
						$iiii++;
					}
					/* Floor Plan Image */
					$j = 1;
					while($post4 = mysql_fetch_assoc($result4)) {
						$posts['floor_plan_images'][]['image'] =$post4['image'];
						$j++;
					}
					$i++;
					$projects['projects'][] = $posts;
					$posts = array();
				}
				
			}
			header('Content-type: application/json');
			echo json_encode($projects);
		}
		if($action == 'city_list') {
		
			$query = "SELECT DISTINCT city FROM projects";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i =1;
				while($post = mysql_fetch_assoc($result)) {
					$posts[$i]['citylist'] =$post['city'];
					$i++;
				}
			
			}
			header('Content-type: application/json');
			echo json_encode($posts);
		}
		if($action == 'projectlist') {
		
			$query = "SELECT id,city FROM projects";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i =1;
				while($post = mysql_fetch_assoc($result)) {
					$posts[$i]['city'] =$post['city'];
					$posts[$i]['id'] =$post['id'];
					$i++;
				}
			
			}
			header('Content-type: application/json');
			echo json_encode($posts);
		}
		if($action == 'projectnews') {
		
			$query = "SELECT * from project_news";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i =1;
				while($post = mysql_fetch_assoc($result)) {
					if($post['title'] != '' && $post['url'] != ''){
						$posts['title'] =$post['title'];
						$posts['url'] =$post['url'];
						$news['news'][] = $posts;
						$i++;
					}					
				}			
			}
			
			
			header('Content-type: application/json');
			echo json_encode($news);
		}
		if($action == 'projectnewsletter') {
		
			$query = "SELECT * from newsletter LIMIT 0,1";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i =1;
				while($post = mysql_fetch_assoc($result)) {
					$posts['newsletter_url'] =$post['newsletter_image'];
					$news['newsletter'][] = $posts;
					$i++;
				}
			
			}
			header('Content-type: application/json');
			echo json_encode($news);
		}
		if($action == 'contact_us') {
		
			$query = "SELECT * from contact_us";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i ='contact_us';
				while($post = mysql_fetch_assoc($result)) {
					$posts[$i]['name'] =$post['name'];
					$posts[$i]['email'] =$post['email'];
					$posts[$i]['logo'] =$post['conatact_us_image'];
					$posts[$i]['phone'] =$post['phone'];
					$posts[$i]['address'] =$post['address'];
					$posts[$i]['facebook'] =$post['facebook'];
					$posts[$i]['url'] =$post['url'];
					$posts[$i]['twitter'] =$post['twitter'];
					$posts[$i]['youtube'] =$post['youtube'];
					$posts[$i]['blog'] =$post['blog'];
					//$i++;
				}
			}
			header('Content-type: application/json');
			echo json_encode($posts);
		}
		if($action == 'project_testimonials') {
		
			$query = "SELECT * from project_testimonials";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i =1;
				while($post = mysql_fetch_assoc($result)) {
					$posts['title'] =$post['title'];
					$posts['description'] =$post['desctiption'];
					$posts['logo'] =$post['testimonial_image'];
					$news['project_testimonials'][] = $posts;
					$i++;
				}
				
				
			}
			header('Content-type: application/json');
			echo json_encode($news);
		}
		if($action == 'about_us') {
		
			$query = "SELECT * from about_us";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i =1;
				while($post = mysql_fetch_assoc($result)) {
					$posts['title'] =$post['title'];
					$posts['description'] =$post['desctiption'];
					$posts['image'] =$post['about_us_image'];
					$news['about_us'][] = $posts;
					$i++;
				}
			}
			header('Content-type: application/json');
			echo json_encode($news);
		}
		if($action == 'project_specification') {
		
			$query = "SELECT * from specification";
			$result = mysql_query($query,$link) or die('Errant query:  '.$query);
			$posts = array();
			if(mysql_num_rows($result)) {
			$i =1;
				while($post = mysql_fetch_assoc($result)) {
					$posts[$i]['specification'] =$post['specification'];
					$i++;
				}
			
			}
			header('Content-type: application/json');
			echo json_encode($posts);
		}
		/* create one master array of the records */
				
		/* output in necessary format */
		/*if($action == 'json') {
			header('Content-type: application/json');
			echo json_encode(array('posts'=>$posts));
		}*/
		
		/* Refer Friend Email */
		if($action == 'mail') {
			// Settings

            require('fpdf16/PHPMailerAutoload.php');
            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mail.shriramproperties.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'splmobile@shriramproperties.com';                 // SMTP username
            $mail->Password = 'Mb$spl4%62T';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->From = 'vinothkumar@constient.com';
            $mail->FromName = 'Mailer';
            $mail->addAddress('rvinoth227@gmail.com', 'Joe User');     // Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('rvinoth227@gmail.com');
            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            echo "<pre>";
            print_r($mail);die;
            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
		            }
		            if($action == 'valid_json'){
			            $res = array('myname'=>'logesh','myEmail'=>'chandranlogesh@gmail.com','myPhone'=>'9789234550','friendname'=>'logesh','friendEmail'=>'chandranlogesh@gmail.com','friendPhone'=>'9789234550','projectName'=>'ChirpingWood Sarjapur');
			            //echo $json = json_encode($res);
			            $json = '{"myname":"logesh","myEmail":"chandranlogesh@gmail.com","myPhone":"9789234550","friendname":"logesh","friendEmail":"chandranlogesh@gmail.com","friendPhone":"9789234550","projectName":"ChirpingWood Sarjapur"}';
			            $response = json_decode($json);
			            print_r($response); 	
		            }

		if($action == 'refer_friend'){
				
			$res = array('name'=>'logesh','email'=>'lakshmi.g@constient.com');
			//echo $json = json_encode($res);
			//echo "input:".$_REQUEST['ipjson'];
			$response = json_decode(stripslashes($_REQUEST['ipjson']));
			//$to='lakshmi.g@constient.com';				
			$to = $response->friendEmail;
			$subject = $response->myname." Refered you a Sriram's Project".$response->projectName;

			$message = "
				<p> Hi ".$response->friendname.", <br><br> I refer you sriram property's project : ".$response->projectName."</p>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: '.$response->myname.'<'.$response->myEmail.'>' . "\r\n";
			//$headers .= 'From: 'lakshmi.g@constient.com'' . "\r\n";
			$mail = mail($to,$subject,$message,$headers);
			if($mail){
				echo "Mail sent";
			} else{
				echo "error";
		}
		}
		
		if($action == 'enquiry'){
			$email_id=$_REQUEST['email'];
			$res = array('name'=>'lakshmi','email'=>'lakshmi.g@constient.com','mobile'=>'9934599900');
			//echo $json = json_encode($res);
			//echo "input:".$_REQUEST['ipjson'];
			$response = json_decode(stripslashes($_REQUEST['ipjson']));
							
			$to = $response->friendEmail;
			$subject = $response->myname."Sriram has Received Enquiry From ".$response->projectName;

			$message = "
				<p> Hi ".$response->friendname.", <br><br> Name  : ".$response->projectName."</p>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: '.$response->myname.'<'.$response->myEmail.'<'.$response->mymobile.'>' . "\r\n";
			$mail = mail($email_id,$subject,$message,$headers);
			if($mail){
				echo "Mail sent";
			} else{
				echo "error";
		}
		}
		
		if($action == 'refer_app'){
				
			$res = array('name'=>'logesh','email'=>'chandranlogesh@gmail.com');
			//echo $json = json_encode($res);
			//echo "input:".$_REQUEST['ipjson'];
			$response = json_decode(stripslashes($_REQUEST['ipjson']));
							
			$to = $response->friendEmail;
			$subject = $response->myname." Refered you a Sriram's mobile app".$response->projectName;

			$message = "
				<p> Hi ".$response->friendname.", <br><br> I refer you sriram property's mobile app : ".$response->app_url."</p>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: '.$response->myname.'<'.$response->myEmail.'>' . "\r\n";
			$mail = mail($to,$subject,$message,$headers);
			if($mail){
				echo "Mail sent";
			} else{
				echo "error";
		}
		}
		

		if($action == 'block1' || $action == 'block2' || $action == 'block3' || $action == 'block4' || $action == 'block5'){
			$field = 'project'.$action;
			$result = mysql_query("SELECT `projects`.* FROM `projects` INNER JOIN home_page ON(projects.id = home_page.$field)");			
			$posts = array();
			if(mysql_num_rows($result)) {
			$i = 1;
				while($post = mysql_fetch_assoc($result)) {
				
				    /* Gallery Image */
					$query1 = "SELECT * FROM project_images where project_id =".$post['id'] ;
					$result1 = mysql_query($query1,$link) or die('Errant query:  '.$query1);
					
					/* Amenity Image */
					$query2 = "SELECT * FROM amenity_images where project_id =".$post['id'] ;
					$result2 = mysql_query($query2,$link) or die('Errant query:  '.$query2);
					
					/* Club House Image */
					$query3 = "SELECT * FROM club_house_images where project_id =".$post['id'] ;
					$result3 = mysql_query($query3,$link) or die('Errant query:  '.$query3);
					
					/* Floor Plan Image */
					$query4 = "SELECT * FROM floor_plan_images where project_id =".$post['id'] ;
					$result4 = mysql_query($query4,$link) or die('Errant query:  '.$query4);
					
					$posts['projects_name'] =$post['projects_name'];
					$posts['descrptions'] =$post['descrptions'];
					$posts['address'] =$post['address'];
					$posts['city'] =$post['city'];
					$posts['latitude'] =$post['latitude'];
					$posts['longtitude'] =$post['longtitude'];
					$posts['video1'] =$post['video1'];
					$posts['video2'] =$post['video2'];
					$posts['video3'] =$post['video3'];
					$posts['video4'] =$post['video4'];
					$posts['video5'] =$post['video5'];
					$posts['specification'] =$post['specification'];
					$posts['logo'] = $post['logo'];
					/* Gallery Image */
					$ii = 1;
					if($post['logo'] != ''){
						$posts['gallery_image'][]['image'] =$post['logo'];	
					}					
					while($post1 = mysql_fetch_assoc($result1)) {
						$posts['gallery_image'][]['image'] =$post1['image'];
						$ii++;
					}
					/* Amenity Image */
					$iii = 1;
															
					while($post2 = mysql_fetch_assoc($result2)) {
						$posts['amenity_images'][]['image'] =$post2['image'];
						$iii++;
					}
					
					/* Club House Image */
					$iiii = 1;
					while($post3 = mysql_fetch_assoc($result3)) {
						$posts['club_house_images'][]['image'] =$post3['image'];
						$iiii++;
					}
					/* Floor Plan Image */
					$j = 1;
					while($post4 = mysql_fetch_assoc($result4)) {
						$posts['floor_plan_images'][]['image'] =$post4['image'];
						$j++;
					}
					$i++;
					$projects['projects'][] = $posts;
					$posts = array();
				}
				
			}
			header('Content-type: application/json');
			echo json_encode($projects);
		}

		if($action == "logos" ){
			$field = 'projectlogo1';
			$field2 = 'projectlogo2';
			$result = mysql_query("SELECT `projects`.* FROM `projects` INNER JOIN home_page ON(projects.id = home_page.$field OR projects.id = home_page.$field2)");			
			$posts = array();
			if(mysql_num_rows($result)) {
			$i = 1;
				while($post = mysql_fetch_assoc($result)) {
					if($post['logo'] != ''){
						$posts['image'] =$post['logo'];	
						 /* Gallery Image */
					$query1 = "SELECT * FROM project_images where project_id =".$post['id'] ;
					$result1 = mysql_query($query1,$link) or die('Errant query:  '.$query1);
					
					/* Amenity Image */
					$query2 = "SELECT * FROM amenity_images where project_id =".$post['id'] ;
					$result2 = mysql_query($query2,$link) or die('Errant query:  '.$query2);
					
					/* Club House Image */
					$query3 = "SELECT * FROM club_house_images where project_id =".$post['id'] ;
					$result3 = mysql_query($query3,$link) or die('Errant query:  '.$query3);
					
					/* Floor Plan Image */
					$query4 = "SELECT * FROM floor_plan_images where project_id =".$post['id'] ;
					$result4 = mysql_query($query4,$link) or die('Errant query:  '.$query4);
					
					$posts['projects_name'] =$post['projects_name'];
					$posts['descrptions'] =$post['descrptions'];
					$posts['address'] =$post['address'];
					$posts['city'] =$post['city'];
					$posts['latitude'] =$post['latitude'];
					$posts['longtitude'] =$post['longtitude'];
					$posts['video1'] =$post['video1'];
					$posts['video2'] =$post['video2'];
					$posts['video3'] =$post['video3'];
					$posts['video4'] =$post['video4'];
					$posts['video5'] =$post['video5'];
					$posts['specification'] =$post['specification'];
					
					/* Gallery Image */
					$ii = 1;
					while($post1 = mysql_fetch_assoc($result1)) {
						$posts['gallery_image'][]['image'] =$post1['image'];
						$ii++;
					}
					/* Amenity Image */
					$iii = 1;
															
					while($post2 = mysql_fetch_assoc($result2)) {
						$posts['amenity_images'][]['image'] =$post2['image'];
						$iii++;
					}
					
					/* Club House Image */
					$iiii = 1;
					while($post3 = mysql_fetch_assoc($result3)) {
						$posts['club_house_images'][]['image'] =$post3['image'];
						$iiii++;
					}
					/* Floor Plan Image */
					$j = 1;
					while($post4 = mysql_fetch_assoc($result4)) {
						$posts['floor_plan_images'][]['image'] =$post4['image'];
						$j++;
					}
					$i++;
					}					
					$projects['logo'][] = $posts;
					$posts = array();
				}
				
			}
			header('Content-type: application/json');
			echo json_encode($projects);
		}	
		
		/* disconnect from the db */
		@mysql_close($link);
	}
?>
