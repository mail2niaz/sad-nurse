<?php
/**
 * Created by PhpStorm.
 * User: logesh
 * Date: 16/6/15
 * Time: 3:56 PM
 */

class PatientService extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Service_model');
    }

    public function login($username,$password){
        $this->Service_model->auth($username,$password);

    }

    public function FetchPersonalCare($pid){
        $this->Service_model->personal($pid);
    }
    public function FetchCriticalCare($pid){
        $this->Service_model->critical($pid);
    }

    /*
    public function gen_zip($pid){
        $response = array();

            $response[] = array(
                'FileName'=>"bg1.png",
                "FilePath"=>"http://demos.constient.com/hijiya/img/breifcase/scan/Doc1.jpg",
                "filedata" => "/img/breifcase/scan/Doc1.jpg",
                "Type" => "scan"
            );
            $response[] = array(
                'FileName'=>"bg2.png",
                "FilePath"=>"http://demos.constient.com/hijiya/img/breifcase/scan/Doc2.jpg",
                "filedata" => "/img/breifcase/scan/Doc2.jpg",
                "Type" => "scan"
            );
        $response[] = array(
            'FileName'=>"bg3.png",
            "FilePath"=>"http://demos.constient.com/hijiya/img/breifcase/scan/Doc3.jpg",
            "filedata" => "/img/breifcase/scan/Doc3.jpg",
            "Type" => "scan"
        );
        $response[] = array(
            'FileName'=>"bg1.png",
            "FilePath"=>"http://demos.constient.com/hijiya/img/breifcase/reports/Doc1.jpg",
            "filedata" => "/img/breifcase/reports/Doc1.jpg",
            "Type" => "scan"
        );
        $response[] = array(
            'FileName'=>"bg2.png",
            "FilePath"=>"http://demos.constient.com/hijiya/img/breifcase/reports/Doc2.jpg",
            "filedata" => "/img/breifcase/reports/Doc2.jpg",
            "Type" => "scan"
        );
        $response[] = array(
            'FileName'=>"bg1.png",
            "FilePath"=>"http://demos.constient.com/hijiya/img/breifcase/other/Doc1.jpg",
            "filedata" => "/img/breifcase/other/Doc1.jpg",
            "Type" => "scan"
        );
        $response[] = array(
            'FileName'=>"bg2.png",
            "FilePath"=>"http://demos.constient.com/hijiya/img/breifcase/other/Doc2.jpg",
            "filedata" => "/img/breifcase/other/Doc2.jpg",
            "Type" => "scan"
        );



        echo json_encode($response);
    }
    */
    public function gen_zip($pid){
        // Get real path for our folder


        // Zip archive will be created only after closing object

        header('Content-Type: application/zip');
        header("Content-Disposition: attachment; filename='adcs.zip'");
        header('Content-Length: ' . filesize($zipname));
        header("Location: patient/img/breifcase.zip");
    }

    /*
    public function import_CriticalCare(){
        $json='{"Medications":null,"Allergies":[{"AllergiesName":"Avocados"},{"AllergiesName":"Season Seeds"},{"AllergiesName":"Tree Nuts"},{"AllergiesName":"Egg"},{"AllergiesName":"Tomatoes"},{"AllergiesName":"Chicken Fowl"},{"AllergiesName":"Peanuts"},{"AllergiesName":"Chesnutt"},{"AllergiesName":"Milk Life Threatening"},{"AllergiesName":"Strawberry"},{"AllergiesName":"Kiwis"},{"AllergiesName":"Soy"},{"AllergiesName":"Bananas"},{"AllergiesName":"Shellfish Life Threatening"},{"AllergiesName":"Wheat"},{"AllergiesName":"Fish"},{"AllergiesName":"Idiopathic"},{"AllergiesName":"Insect Stings"},{"AllergiesName":"Latex"},{"AllergiesName":"Sulfite"},{"AllergiesName":"Aspartame"},{"AllergiesName":"Chocolate"},{"AllergiesName":"MSG"},{"AllergiesName":"Sulfite Food Sensitivity"},{"AllergiesName":"Cheese"},{"AllergiesName":"Milk"},{"AllergiesName":"Shell fish"},{"AllergiesName":"Wine Beer"},{"AllergiesName":"Band-Aids"},{"AllergiesName":"Betadine"},{"AllergiesName":"Topical Antibiotics"},{"AllergiesName":"Fragrances"},{"AllergiesName":"Large Localized Insect"},{"AllergiesName":"Cosmetics"},{"AllergiesName":"Nickel Jewelry"},{"AllergiesName":"Plant"},{"AllergiesName":"Latex Rubber"},{"AllergiesName":"Soap Detergent"},{"AllergiesName":"Cockroach"},{"AllergiesName":"Tree Pollen"},{"AllergiesName":"Smoke"},{"AllergiesName":"Dust Mites"},{"AllergiesName":"DogCat"},{"AllergiesName":"WeedPollen"},{"AllergiesName":"Mold"},{"AllergiesName":"GrassPollen"},{"AllergiesName":"AceInhibitiors"},{"AllergiesName":"Cefaclor"},{"AllergiesName":"Codeine"},{"AllergiesName":"BetaBlocker"},{"AllergiesName":"Insulin"},{"AllergiesName":"IVContrastIodine"},{"AllergiesName":"Ibuprofen"},{"AllergiesName":"Penicillin"},{"AllergiesName":"SulfaDrugs"},{"AllergiesName":"MultipleAntiBiotics"},{"AllergiesName":"Aspirin"},{"AllergiesName":"MultipleChemical"},{"AllergiesName":"Anticonvulsants"}],"Name":"test","DOB":"18/08/1990","ContactNumber":"12345","ContactAddress":"1234test","EC_ContactPerson":null,"EC_ContactNumber":null,"EC_Relationship":null,"EC_Email":null,"EC_Address":null,"ID_PolicyNumber":null,"ID_PolicyType":null,"ID_policyCompany":null,"ID_ExpiryDate":"\/Date(-62135596800000)\/","ID_ContactNumber":null,"ED_Employer":null,"ED_designation":null,"ED_ContactNumber":null,"ED_Email":null,"PD_PhysicianName":null,"PD_ContactNumber":null,"PD_Email":null,"PD_Speciality":null,"VI_BloodGroup":null}';
        $personal_care = '{"Weight":"62","Weight_DOE":"01/10/2013","Height":"178","Height_DOE":"01/10/2013","BP":"80/90","BP_DOE":"30/07/2013","Pulse":"70","Pulse_DOE":"30/07/2013","BloodSugarLevel":"86","BloodSugar_DOE":"01/10/2013","Cholesterol":"","Cholesterol_DOE":"","VI_BloodSugar":"86","BP_Systolic":"80","BP_Diastolic":"90"}';
        $data = json_decode($json);
        $pdata = json_decode($personal_care);

        $array = (array) $data;
        $parray = (array) $pdata;
        $allergy = $this->objtoArray($array['Allergies']);
        unset($array['Allergies']);
        unset($array['Medications']);
        unset($array['Name']);
        unset($array['DOB']);
        unset($array['ContactNumber']);
        unset($array['ContactAddress']);
        $patient = $this->db->get('patients');
        $this->db->insert_batch('Allergies', $allergy);
        foreach($patient->result_array() as $result)
        {
            $pid = $result['pid'];
            $array['pid'] = $pid;
            $parray['pid'] = $pid;

            $this->db->insert('patients_critical_data',$array);
            $this->db->insert('patients_personal_data',$parray);

        }
    }

    public function objtoArray($obj)
    {
        $resultArray = array();
        foreach ($obj as $key => $value)
        {
            //print_r($value);
            $resultArray[$key] = (array) $value;
        }
        return $resultArray;
    }
    */
}
