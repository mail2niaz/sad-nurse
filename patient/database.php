<?php
class database
{
	public function __construct()
	{
	}
	
	public function auth()
	{
		$authstring = array('LoginStatus' => 'Success',
					'UserID' => 7,
					'UserTypeID' => 2,
					'DateTime' => '\/Date(1329860514000)\/',
					'TokenID' => 'xxxx',
					'LoginMessage' => 'Login Successfully',
					'ImagePath' => 'http://demos.constient.com/hijiya/uploads/1/',
					'IsActive' => true
					); 
		return $authstring; 
	}
	
	function FetchCCare()
	{
		$critical = array('Medications' => 'testmed',
						  'Allergies' => array('AllergiesName' => 'Avocados',
										 'AllergiesName' => 'Tree Nuts',
										 'AllergiesName' => 'Egg',
										 'AllergiesName' => 'Tomatoes',
										 'AllergiesName' => 'Chicken Fowl',
										 'AllergiesName' => 'Peanuts',
										 'AllergiesName' => 'Chesnutt',
										 'AllergiesName' => 'Milk Life Threatening',
										 'AllergiesName' => 'Strawberry',
										 'AllergiesName' => 'Kiwis',
										 'AllergiesName' => 'Soy',
										 'AllergiesName' => 'Bananas',
										 'AllergiesName' => 'Shellfish Life Threatening',
										 'AllergiesName' => 'Wheat',
										 'AllergiesName' => 'Fish',
										 'AllergiesName' => 'Idiopathic',
										 'AllergiesName' => 'Insect Stings',
										 'AllergiesName' => 'Latex',
										 'AllergiesName' => 'Sulfite',
										 'AllergiesName' => 'Aspartame',
										 'AllergiesName' => 'Chocolate',
										 'AllergiesName' => 'MSG',
										 'AllergiesName' => 'Sulfite Food Sensitivity',
										 'AllergiesName' => 'Cheese',
										 'AllergiesName' => 'Milk',
										 'AllergiesName' => 'Shell fish',
										 'AllergiesName' => 'Wine Beer',
										 'AllergiesName' => 'Band-Aids',
										 'AllergiesName' => 'Betadine',
										 'AllergiesName' => 'Topical Antibiotics',
										 'AllergiesName' => 'Fragrances',
										 'AllergiesName' => 'Large Localized Insect',
										 'AllergiesName' => 'Cosmetics',
										 'AllergiesName' => 'Nickel Jewelry',
										 'AllergiesName' => 'Plant',
										 'AllergiesName' => 'Latex Rubber',
										 'AllergiesName' => 'Soap Detergent',
										 'AllergiesName' => 'Cockroach',
										 'AllergiesName' => 'Tree Pollen',
										 'AllergiesName' => 'Smoke',
										 'AllergiesName' => 'Dust Mites',
										 'AllergiesName' => 'DogCat',
										 'AllergiesName' => 'WeedPollen',
										 'AllergiesName' => 'Mold',
										 'AllergiesName' => 'GrassPollen',
										 'AllergiesName' => 'AceInhibitiors',
										 'AllergiesName' => 'Cefaclor',
										 'AllergiesName' => 'Codeine',
										 'AllergiesName' => 'BetaBlocker',
										 'AllergiesName' => 'Insulin',
										 'AllergiesName' => 'IVContrastIodine',
										 'AllergiesName' => 'Ibuprofen',
										 'AllergiesName' => 'Penicillin',
										 'AllergiesName' => 'SulfaDrugs',
										 'AllergiesName' => 'MultipleAntiBiotics',
										 'AllergiesName' => 'Aspirin',
										 'AllergiesName' => 'MultipleChemical',
										 'AllergiesName' => 'Anticonvulsants',
										 ),
					'Name' => 'Vickie Bg',
					'DOB' => '1990/08/18',
					'ContactNumber' => '978790520',
					'ContactAddress' => 'A6, John St',
					'EC_ContactPerson' => 'Vickey',
					'EC_ContactNumber' => '123560',
					'EC_Relationship' => 'brothrhood',
					'EC_Email' => 'demo@gmail.com',
					'EC_Address' => '12A, Kat St',
					'ID_PolicyNumber' => '1230',
					'ID_PolicyType' => 'Type',
					'ID_policyCompany' => 'test',
					'ID_ExpiryDate' => '\/Date(-62135596800000)\/',
					'ID_ContactNumber' => 'utu',
					'ED_Employer' => 'employee1',
					'ED_designation' => 'Med Rep',
					'ED_ContactNumber' => '5467890',
					'ED_Email' => 'med@hijiya.com',
					'PD_PhysicianName' => 'testPhsych',
					'PD_ContactNumber' => '9456200',
					'PD_Email' => 'testPhsych@gmail.vcom',
					'PD_Speciality' => 'special',
					'VI_BloodGroup' => 'AB+');
		return $critical;
	}
	
	function PCare()
	{
		$personal = array ('weight' => 60,
						   'w_doe' => "\/date(1375761527000)\/",
						   'bp' => "",
						   'bp_doe' => "\/date(1375162694000)\/",
						   'pulse' => 70,
						   'p_doe' => "\/date(1375162707000)\/",
						   'bloodsugarlevel' => "",
						   'movementactivity' => null,
						   'vi_bloodsugar' => 80,
						   'bp_systolic' => 90,
						   'bp_diastolic' => 90);
		return $personal;				   
	}
	
	function BCase()
	{
		$brief[] = array('FileName' =>  'bg1.png',
						 'FilePath' =>  'http://demos.constient.com/hijiya/img/breifcase/scan/Doc1.jpg',
						 'filedata' =>  'img/breifcase/scan/Doc1.jpg',
						 'Type' =>  'scan');
						 
		$brief[] = array('FileName' =>  'bg2.png',
						 'FilePath' =>  'http://demos.constient.com/hijiya/img/breifcase/scan/Doc2.jpg',
						 'filedata' =>  'img/breifcase/scan/Doc2.jpg',
						 'Type' =>  'scan');
		
		$brief[] = array('FileName' =>  'bg3.png',
						 'FilePath' =>  'http://demos.constient.com/hijiya/img/breifcase/scan/Doc3.jpg',
						 'filedata' =>  'img/breifcase/scan/Doc3.jpg',
						 'Type' =>  'scan');
						 
		$brief[] = array('FileName' =>  'bg1.png',
						 'FilePath' =>  'http://demos.constient.com/hijiya/img/breifcase/reports/Doc1.jpg',
						 'filedata' =>  'img/breifcase/reports/Doc1.jpg',
						 'Type' =>  'R');
						 
		$brief[] = array('FileName' =>  'bg2.png',
						 'FilePath' =>  'http://demos.constient.com/hijiya/img/breifcase/reports/Doc2.jpg',
						 'filedata' =>  'img/breifcase/reports/Doc2.jpg',
						 'Type' =>  'R');
						 
		$brief[] = array('FileName' =>  'bg1.png',
						 'FilePath' =>  'http://demos.constient.com/hijiya/img/breifcase/other/Doc1.jpg',
						 'filedata' =>  'img/breifcase/other/Doc1.jpg',
						 'Type' =>  'O');
						 
		$brief[] = array('FileName' =>  'bg2.png',
						 'FilePath' =>  'http://demos.constient.com/hijiya/img/breifcase/other/Doc2.jpg',
						 'filedata' =>  'img/breifcase/other/Doc2.jpg',
						 'Type' =>  'O');				 
		
		return $brief;
	}
} 
?>
