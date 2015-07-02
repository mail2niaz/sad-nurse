<?php 
include "database.php";

$database = new database;

if(function_exists($_GET['action']))
{
	$_GET['action']();
}	


function autherize()
{
	global $database;
	echo json_encode($database->auth());
	//echo json_decode($js);
}

function FetchCriticalCare()
{
	global $database;
	
	echo '{"Medications":null,"Allergies":[{"AllergiesName":"Avocados"},{"AllergiesName":"Season Seeds"},{"AllergiesName":"Tree Nuts"},{"AllergiesName":"Egg"},{"AllergiesName":"Tomatoes"},{"AllergiesName":"Chicken Fowl"},{"AllergiesName":"Peanuts"},{"AllergiesName":"Chesnutt"},{"AllergiesName":"Milk Life Threatening"},{"AllergiesName":"Strawberry"},{"AllergiesName":"Kiwis"},{"AllergiesName":"Soy"},{"AllergiesName":"Bananas"},{"AllergiesName":"Shellfish Life Threatening"},{"AllergiesName":"Wheat"},{"AllergiesName":"Fish"},{"AllergiesName":"Idiopathic"},{"AllergiesName":"Insect Stings"},{"AllergiesName":"Latex"},{"AllergiesName":"Sulfite"},{"AllergiesName":"Aspartame"},{"AllergiesName":"Chocolate"},{"AllergiesName":"MSG"},{"AllergiesName":"Sulfite Food Sensitivity"},{"AllergiesName":"Cheese"},{"AllergiesName":"Milk"},{"AllergiesName":"Shell fish"},{"AllergiesName":"Wine Beer"},{"AllergiesName":"Band-Aids"},{"AllergiesName":"Betadine"},{"AllergiesName":"Topical Antibiotics"},{"AllergiesName":"Fragrances"},{"AllergiesName":"Large Localized Insect"},{"AllergiesName":"Cosmetics"},{"AllergiesName":"Nickel Jewelry"},{"AllergiesName":"Plant"},{"AllergiesName":"Latex Rubber"},{"AllergiesName":"Soap Detergent"},{"AllergiesName":"Cockroach"},{"AllergiesName":"Tree Pollen"},{"AllergiesName":"Smoke"},{"AllergiesName":"Dust Mites"},{"AllergiesName":"DogCat"},{"AllergiesName":"WeedPollen"},{"AllergiesName":"Mold"},{"AllergiesName":"GrassPollen"},{"AllergiesName":"AceInhibitiors"},{"AllergiesName":"Cefaclor"},{"AllergiesName":"Codeine"},{"AllergiesName":"BetaBlocker"},{"AllergiesName":"Insulin"},{"AllergiesName":"IVContrastIodine"},{"AllergiesName":"Ibuprofen"},{"AllergiesName":"Penicillin"},{"AllergiesName":"SulfaDrugs"},{"AllergiesName":"MultipleAntiBiotics"},{"AllergiesName":"Aspirin"},{"AllergiesName":"MultipleChemical"},{"AllergiesName":"Anticonvulsants"}],"Name":"test","DOB":"18/08/1990","ContactNumber":"12345","ContactAddress":"1234test","EC_ContactPerson":null,"EC_ContactNumber":null,"EC_Relationship":null,"EC_Email":null,"EC_Address":null,"ID_PolicyNumber":null,"ID_PolicyType":null,"ID_policyCompany":null,"ID_ExpiryDate":"\/Date(-62135596800000)\/","ID_ContactNumber":null,"ED_Employer":null,"ED_designation":null,"ED_ContactNumber":null,"ED_Email":null,"PD_PhysicianName":null,"PD_ContactNumber":null,"PD_Email":null,"PD_Speciality":null,"VI_BloodGroup":null}';	
	//echo json_decode($js);
}

function PersonalCare()
{
	global $database;
	//echo json_encode($database->PCare());
	//echo "Hi";
	echo '{"Weight":"60","W_DOE":"\/Date(1375761527000)\/","BP":"","BP_DOE":"\/Date(1375162694000)\/","Pulse":"70","P_DOE":"\/Date(1375162707000)\/","BloodSugarLevel":"","MovementActivity":null,"VI_BloodSugar":"80","BP_Systolic":"90","BP_Diastolic":"90"}';
	//echo json_decode($js);
}

function Briefcase()
{
	global $database;
	$database = new database;
	echo json_encode($database->BCase());
	
	
	//echo json_decode($js);
}
?>
