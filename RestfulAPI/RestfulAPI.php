<?php

include_once 'RestService.php';
include_once 'Postgre.php';

class RestfulAPI extends RestService {

    private $info = array();
    // Define HTTP responses
    protected $APIResponseCode = array(
        0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error'),
        1 => array('HTTP Response' => 200, 'Message' => 'Success'),
        2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required'),
        3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required'),
        4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed'),
        5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request'),
        6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format')
    );

    public function __construct() {
        parent::__construct();
        $this->info['host'] = "localhost";
        $this->info['port'] = "5433";
        $this->info['user'] = "postgres";
        $this->info['password'] = "12345a";
        $this->info['database'] = "SAMAC";
    }

    // ---------- Helper Functions ----------
    protected function deliverResponse($format, $response) {
        // Define HTTP responses
        $httpResponseCode = array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found'
        );

        // Set HTTP Response
        header('HTTP/1.1 ' . $response['status'] . ' ' . $httpResponseCode[$response['status']], true, $response['status']);
        // Process different content types
        if (strcasecmp($format, 'json') == 0) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST');
            // Set HTTP Response Content Type
            header('Content-Type: application/json; charset=utf-8');
            // Format data into a JSON response
            $json_response = json_encode($response);
            // Deliver formatted data
            echo $json_response;
        }
    }

    protected function createConnection() {
        $db = new Postgre($this->info['host'], $this->info['port'], $this->info['user'], $this->info['password'], $this->info['database']);
        $db->connect();

        return $db;
    }

    /* Set default HTTP response */
    protected function createDeaultResponse() {
        $response = array();
        $response['code'] = 0;
        $response['status'] = 400;
        $response['data'] = null;

        return $response;
    }

    protected function getStrValue($value) {
        return isset($value) ? $value : "NULL";
    }

    protected function getBoolValue($value) {
        return isset($value) ? $value : "false";
    }

    protected function getIntValueZero($value) {
        return isset($value) ? $value : 0;
    }

    protected function getIntValueNull($value) {
        return isset($value) ? $value : "NULL";
    }

    // ---------- GET POST ----------
    public function performGet($url, $arguments, $accept) {
        $response = $this->createDeaultResponse();
        $this->callMethod($response, $arguments);
    }

    public function performPost($url, $arguments, $accept) {
        $response = $this->createDeaultResponse();
        $this->callMethod($response, $arguments);
    }

    public function performOptions($url, $arguments, $accept) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
        header('Access-Control-Allow-Methods: GET, POST');
    }

    public function callMethod($response, $arguments) {
        $format = $this->getStrValue($arguments['format']);
        $method = $this->getStrValue($arguments['method']);

        switch (strtolower($method)) {
            case 'welcome':
                $this->welcome($format, $response);
                break;
            case 'getallcities':
                $this->getAllCities($format, $response);
                break;
            case 'formclients':
                $this->formClients($format, $response);
                break;
            case 'formprojectsengineer':
                $this->formProjectsEngineer($format, $response);
                break;
            case 'formtimesheet':
                $this->formTimesheet($format, $response, $arguments);
                break;
            case 'insertintoactivities':
                $this->insertIntoActivities($format, $response, $arguments);
                break;
            case 'getallexhibits':
                $this->getAllExhibits($format, $response);
                break;
            case 'listactivities':
                $this->listActivities($format, $response);
                break;
            case 'listallprojects':
                $this->listAllProjects($format, $response);
                break;
            case 'listclientscontacts':
                $this->listClientsContacts($format, $response);
                break;
            case 'liststaff':
                $this->listStaff($format, $response);
                break;
            case 'listallcompanies':
                $this->listAllCompanies($format, $response);
                break;
            case 'listprojectsbyfirstengineer':
                $this->listProjectsByFirstEngineer($format, $response, $arguments);
                break;
            case 'listprojectsbycurrentengineer':
                $this->listProjectsByCurrentEngineer($format, $response, $arguments);
                break;
            case 'listalltodo':
                $this->listAllTodo($format, $response);
                break;
            case 'login':
                $this->login($format, $response, $arguments);
                break;
            default:
                /* 501 (Not Implemented) for any unknown methods */
                header('Allow: ' . $method . "  " . $format, true, 501);
        }
    }

    // ---------- Web Services ----------
    /* Welcome message */
    function welcome($format, $response) {
        $response['data'] = "Welcome to PHP Web Services!";
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function getAllCities($format, $response) {
        $db = $this->CreateConnection();
        $db->query('SELECT * FROM "Cities" ');

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function formClients($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT DISTINCT
                   "Clients".clientid, 
                   "Clients".company, 
                   "Clients".client
                FROM
                   "Clients" LEFT JOIN "ClientsContacts" ON "Clients".clientid="ClientsContacts".clientid
                ORDER BY
                   "Clients".company';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function formProjectsEngineer($format, $response) {
        $db = $this->CreateConnection();
        $query =
                "SELECT DISTINCT" .
                '   "Projects".projectid,' .
                '   "Projects".name,' .
                '   "Projects".notes,' .
                '   "Staff".staffid AS "firstEngineerID",' .
                '   "Staff".initial3 AS "firstEngineerInitial",' .
                '   Staff_1.staffid AS "currentEngineerID",' .
                '   Staff_1.initial3 AS "currentEngineerInitial",' .
                '   Staff_2.staffid AS "clashCheckStaffID",' .
                '   Staff_2.initial3 AS "clashCheckStaffInitial"  ' . // Use a traling tab to seperate the parameter and the key word from next line
                'FROM' .
                '   (("Projects" LEFT JOIN "Staff" ON "Projects".firstengineer="Staff".staffid) LEFT JOIN "Staff" AS Staff_1 ON' .
                '   "Projects".currentengineer=Staff_1.staffid) LEFT JOIN "Staff" AS Staff_2 ON "Projects".clashcheckstaff=Staff_2.staffid  ' .
                'ORDER BY' .
                '   "Projects".projectid DESC';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function formTimesheet($format, $response, $arguments) {
        $db = $this->CreateConnection();
        $staffrateid = $this->getIntValueZero($arguments["staffrateid"]);
        $query =
                'SELECT DISTINCT' .
                '   "ProjectsCharges".invoice,' .
                '   "ProjectsCharges".chargeid,' .
                '   "ProjectsCharges".projectid,' .
                '   "ProjectsCharges".date,' .
                '   "ProjectsCharges".description,' .
                '   "ProjectsCharges".qty,' .
                '   "ProjectsCharges".charge,' .
                '   "ProjectsCharges".discount,' .
                '   "ProjectsCharges".activityid,' .
                '   "Staff".staffid,' .
                '   "StaffRates".staffrateid,' .
                '   "Staff".name,' .
                '   "Staff".initial3,' .
                '   "StaffRates".amount ' .
                'FROM' .
                '   ("ProjectsCharges" INNER JOIN ("StaffRates" INNER JOIN "Activities" ON "StaffRates".activityid = "Activities".activityid)' .
                '   ON "ProjectsCharges".staffid = "StaffRates".staffid) INNER JOIN "Staff" ON "ProjectsCharges".staffid="Staff".staffid    ' .
                'WHERE' .
                '   NOT "Activities".time AND "StaffRates".staffrateid = ' . $staffrateid . '   ' .
                'ORDER BY' .
                '   "ProjectsCharges".chargeid, "ProjectsCharges".date';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function insertIntoActivities($format, $response, $arguments) {
        $db = $this->CreateConnection();
        $activitiesinvoiceid = $this->getIntValueNull($arguments["activitiesinvoiceid"]);
        $code = $this->getStrValue($arguments["code"]);
        $description = $this->getStrValue($arguments["description"]);
        $chargeable = $this->getBoolValue($arguments["chargeable"]);
        $allowoverride = $this->getBoolValue($arguments["chargeable"]);
        $time = $this->getBoolValue($arguments["chargeable"]);
        $identifier = $this->getStrValue($arguments["chargeable"]);
        $vacation = $this->getBoolValue($arguments["chargeable"]);
        $stats = $this->getBoolValue($arguments["chargeable"]);
        $expense = $this->getIntValueZero($arguments["chargeable"]);
        $retire = $this->getBoolValue($arguments["chargeable"]);
        $check = $this->getBoolValue($arguments["chargeable"]);
        $paidoff = $this->getBoolValue($arguments["chargeable"]);
        $eis = $this->getBoolValue($arguments["chargeable"]);

        $query =
                'INSERT INTO 
                   "Activities" 
                    (
                       "activityid",
                       "activitiesinvoiceid",
                       "code", 
                       "description", 
                       "chargeable", 
                       "allowoverride", 
                       "time", 
                       "identifier",
                       "vacation", 
                       "stats", 
                       "expense", 
                       "retire", 
                       "check", 
                       "paidoff", 
                       "eis"
                    ) 
                SELECT
                    Max("Activities".activityid)+1, ' . $activitiesinvoiceid . ', ' . $code . ', ' . $description . ', ' . $chargeable . ', ' .
                $allowoverride . ', ' . $time . ', ' . $identifier . ', ' . $vacation . ', ' . $stats . ', ' . $expense . ', ' . $retire . ', ' .
                $check . ', ' . $paidoff . ', ' . $eis . ' ' .
                'FROM
                   "Activities"
                 Returning activityid';

        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function getAllExhibits($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT
                    "ClientsContacts".lastname||\', \'||"ClientsContacts".firstname AS Contact,
                    "Projects"."name",
                    "Projects".contactid,
                    "Exhibits".projectid, 
                    "Exhibits".description, 
                    "Exhibits".qty, 
                    "Exhibits".recieved, 
                    "Exhibits".removed, 
                    "Exhibits"."location", 
                    "Exhibits"."2006 Found", 
                    "Exhibits"."Instruction Letter Sent", 
                    "Exhibits"."Discard", 
                    "Exhibits"."Invoice Sent", 
                    "Exhibits"."Payment Received", 
                    "Exhibits"."Volume Est", 
                    "Exhibits"."Storage Fee", 
                    "ProjectsStatus".code, 
                    "Clients".company AS Client
                FROM
                    (("Clients" INNER JOIN "ClientsContacts" ON "Clients".clientid="ClientsContacts".clientid) INNER JOIN 
                    ("Projects" INNER JOIN "ProjectsStatus" ON "Projects".projectstatusid = "ProjectsStatus".projectstatusid) 
                    ON "ClientsContacts".contactid = "Projects".contactid) INNER JOIN "Exhibits" ON "Projects".projectid = "Exhibits".projectid';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listActivities($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT DISTINCT 
                    "Activities".activityid, "Activities".code, "Activities".description, "Activities".retire
                FROM 
                    "Activities"
                WHERE 
                    NOT "Activities".retire
                ORDER BY 
                    "Activities".code;';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listAllProjects($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT DISTINCT 
                    "ClientsContacts".contactid, 
                    "ClientsContacts".clientid, 
                    "Projects".projectid AS File, 
                    "Staff".initial3 AS "firstEngineer",
                    "Staff".staffid AS "firstEngineerId", 
                    Staff_1.initial3 AS "currentEngineer",
                    Staff_1.staffid AS "currentEngineerId",
                    "Projects".name AS Name, 
                    "ClientsContacts".lastname||\', \'||"ClientsContacts".firstname AS Contact, 
                    "Clients".company AS Client, 
                    "ProjectsStatus".code
                FROM 
                    ((("Projects" LEFT JOIN "Staff" ON "Projects".firstengineer = "Staff".staffid) 
                    LEFT JOIN "Staff" AS Staff_1 ON "Projects".currentengineer = Staff_1.staffid) 
                    LEFT JOIN "ProjectsStatus" ON "Projects".projectstatusid = "ProjectsStatus".projectstatusid) 
                    LEFT JOIN ("ClientsContacts" LEFT JOIN "Clients" ON "ClientsContacts".clientid = "Clients".clientid) 
                    ON "Projects".contactid = "ClientsContacts".contactid
                ORDER BY 
                    "Projects".projectid DESC';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listClientsContacts($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT DISTINCT 
                    "Clients".clientid, 
                    "Clients".company, 
                    "ClientsContacts".lastname||\', \'|| "ClientsContacts".firstname AS Contact,
                    "ClientsContacts".address,
                    "ClientsContacts".city
                FROM 
                    "Clients" LEFT JOIN "ClientsContacts" ON "Clients".clientid="ClientsContacts".clientid
                WHERE 
                    "Clients".clientid != 1
                ORDER BY 
                    "Clients".company;';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listStaff($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT DISTINCT 
                    "Staff".staffid, 
                    CASE WHEN "Staff".staffid=1 
                    THEN \'No\' 
                    ELSE "Staff".initial END AS show, 
                    "Staff".name, 
                    "Staff".initial3, 
                    "Staff".name
                FROM 
                    "Staff"
                WHERE 
                    "Staff".active
                ORDER BY 
                    "Staff".name';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listAllCompanies($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT
                    "Clients".clientid, 
                    "Clients".company
                FROM
                    "Clients" 
                WHERE
                    "Clients".client';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listProjectsByFirstEngineer($format, $response, $arguments) {
        $db = $this->CreateConnection();
        $staffid = $this->getIntValueZero($arguments["staffid"]);
        $query =
                'SELECT DISTINCT 
                    "ClientsContacts".contactid, 
                    "ClientsContacts".clientid, 
                    "Projects".projectid AS File, 
                    "Staff".initial3 AS "firstEngineer",
                    "Staff".staffid AS "firstEngineerId", 
                    Staff_1.initial3 AS "currentEngineer",
                    Staff_1.staffid AS "currentEngineerId",
                    "Projects".name AS Name, 
                    "ClientsContacts".lastname||\', \'||"ClientsContacts".firstname AS Contact, 
                    "Clients".company AS Client, 
                    "ProjectsStatus".code
                FROM 
                    ((("Projects" LEFT JOIN "Staff" ON "Projects".firstengineer = "Staff".staffid) 
                    LEFT JOIN "Staff" AS Staff_1 ON "Projects".currentengineer = Staff_1.staffid) 
                    LEFT JOIN "ProjectsStatus" ON "Projects".projectstatusid = "ProjectsStatus".projectstatusid) 
                    LEFT JOIN ("ClientsContacts" LEFT JOIN "Clients" ON "ClientsContacts".clientid = "Clients".clientid) 
                    ON "Projects".contactid = "ClientsContacts".contactid
                WHERE
                    "Staff".staffid=' . $staffid . '  ' .
                'ORDER BY 
                    "Projects".projectid DESC';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listProjectsByCurrentEngineer($format, $response, $arguments) {
        $db = $this->CreateConnection();
        $staffid = $this->getIntValueZero($arguments["staffid"]);
        $query =
                'SELECT DISTINCT 
                    "ClientsContacts".contactid, 
                    "ClientsContacts".clientid, 
                    "Projects".projectid AS File, 
                    "Staff".initial3 AS "firstEngineer",
                    "Staff".staffid AS "firstEngineerId", 
                    Staff_1.initial3 AS "currentEngineer",
                    Staff_1.staffid AS "currentEngineerId",
                    "Projects".name AS Name, 
                    "ClientsContacts".lastname||\', \'||"ClientsContacts".firstname AS Contact, 
                    "Clients".company AS Client, 
                    "ProjectsStatus".code
                FROM 
                    ((("Projects" LEFT JOIN "Staff" ON "Projects".firstengineer = "Staff".staffid) 
                    LEFT JOIN "Staff" AS Staff_1 ON "Projects".currentengineer = Staff_1.staffid) 
                    LEFT JOIN "ProjectsStatus" ON "Projects".projectstatusid = "ProjectsStatus".projectstatusid) 
                    LEFT JOIN ("ClientsContacts" LEFT JOIN "Clients" ON "ClientsContacts".clientid = "Clients".clientid) 
                    ON "Projects".contactid = "ClientsContacts".contactid
                WHERE
                    Staff_1.staffid=' . $staffid . '  ' .
                'ORDER BY 
                    "Projects".projectid DESC';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function listAllTodo($format, $response) {
        $db = $this->CreateConnection();
        $query =
                'SELECT 
                    * 
                FROM
                    "ToDo"';
        $db->query($query);

        $response['data'] = $db->fetchAll();
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

    function login($format, $response, $arguments) {
        $db = $this->CreateConnection();
        $username = $this->getStrValue($arguments["username"]);
        $password = $this->getStrValue($arguments["password"]);
        $query =
                'SELECT 
                    "Staff".staffid, "Staff".initial, "Staff".initial3, "Staff".entitlement, "Staff".god
                FROM
                    "Staff"
                WHERE
                    "Staff".name=\'' . $username . '\' AND "Staff".pw=\'' . $password . '\' AND "Staff".active';
        $db->query($query);

        $response['data'] = $db->fetchAll() ;
        $response['data'] = ($response['data'] == null)? 'FALSE':  $response['data'];
        $response['code'] = 1;
        $response['status'] = $this->APIResponseCode[$response['code']]['HTTP Response'];
        $this->deliverResponse($format, $response);
    }

}

?>
