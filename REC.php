<?php 
 if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
  
    }
if ( !function_exists( 'wp_insert_post' ) ) { 
    require_once ABSPATH . WPINC . '/post.php';require_once('/wp-load.php'); 
}
	/*
	Plugin Name: RECHARGE
	Version: 1.0
	Plugin URI: http://mobilerechargeapi.in/
	Author: susheelhbti
	Author URI: http://sakshamapp.com/
	Description:  This is a mobile recharge plugin with this you can recharge your prepaid mobile.To get started activate it.When activated you can see a recharge menu page inside settings menu in your admin screen .
	*/

// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages1');
// action function for above hook
function mt_add_pages1() {
    // Add a new submenu under Settings:
    add_options_page(__('Recharge','menu-test'), __('Recharge','menu-test'), 'manage_options', 'recharge', 'recharge_page');
    add_options_page(__('Response','menu-test'), __('Response','menu-test'), 'manage_options', 'response', 'response_page');
}
/* recharge_page1() displays the page content for the Recharge */
function recharge_page() { 
  echo '
<!DOCTYPE html>
<html>
    <head> 
        <title>Welcome ...</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body ng-app="mApp" ng-controller="mCtrl">     
   <div class="col-md-10">
  <form name="myform "action="#" method="POST">
         <table class="table table-bordered ">
           <tr><td>
                   <div class="container">
                   <span><h3>Recharge Your Prepaid Mobile</h3></span>
                 </div><br>
               <div class="form-group"><div class="col-xs-4">
               <label>Mobile Number:</label>
               <input name="recharge_number" id="recharge_number" length="10" pattern="[789][0-9]{9}" ng-change="getOperator()" ng-model="recharge.recharge_number" class="form-control" placeholder="Enter Your Mobile Number" required/>
        </div></div>                                        
<br><br><br>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <label  >Select Operator:</label> 
                                                <select id="mobile_operator" ng-model="recharge.recharge_operator" name="mobile_operator" class="form-control" required >
                                                    <option id="mobile_operator" name="mobile_operator"ng-repeat="operator in myData1"   ng-selected="goperator === operator.id" value="{{operator.id}}">
                                                        {{operator.name}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
<br><br><br>
                                        <div class="form-group">
                                            <div  class="col-sm-4">
                                                <label  >Select circle:</label>
                                               <select id="recharge_circle" ng-model="recharge.recharge_circle" name="recharge_circle" class="form-control" required>
                                                    <option id="recharge_circle" name="recharge_circle" ng-repeat="circle in myData2"  ng-selected="gcircle === circle.id" value="{{circle.id}}">
                                                        {{circle.name}}
                                                    </option>
                                                </select>

                                            </div>
                                        </div>
<br><br><br>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <label  >Amount:</label>	
                                                <input id="amount" ng-model="recharge.amount" name="amount" class="form-control" placeholder="Enter Recharge Amount" required/>

                                            </div>
                                        </div>
<br><br><br><br>
                                       <div class="form-group">
                                            <div class="  col-sm-4">
                                                <button ng-click="submitRechargeForm()" class="btn btn-success btn-lg" name="submit">Proceed To Recharge</button><br><br><br>
                                            </div>
                                          </div>
                               </td></tr>        </table>
                                    </form>
                               </div>                         
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-sanitize.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css" type="text/css"/>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>
<script>
var app = angular.module("mApp", ["angular-loading-bar", "ngAnimate", "ngSanitize"]).config(["cfpLoadingBarProvider", function (cfpLoadingBarProvider) {
        cfpLoadingBarProvider.parentSelector = "#loading-bar-container";
    }])
       .controller("mCtrl", function ($scope, $http) {
	  var operators = [
	   {"name":"AIRCEL" ,"id":"AIR" },
	   {"name":"AIRTEL" ,"id":"A"},
	   {"name":"BSNL" ,"id":"BR"},
	// {"name":"BSNL  STV" ,"id":"BR"},
	 //{"name":"BSNL  TOPUP" ,"id":"BT"}, 
	// {"name":"BSNL RECHARGE" ,"id":"BS"}, 
	   {"name":"DOCOMO" ,"id":"D"},
	   {"name":"IDEA" ,"id":"I"}, 
           {"name":"MTNL " ,"id":"MTR"},
	 //{"name":"MTNL " ,"id":"MTT"},
	   {"name":"MTS" ,"id":"M"}, 
	   {"name":"VIDEOCON" ,"id":"VD"}, 
	   {"name":"RELIANCE" ,"id":"RC"}, 
	// {"name":"RELIANCE  GSM" ,"id":"RG"}, 
	   {"name":"TATA INDICOM" ,"id":"T"}, 
	   {"name":"UNINOR" ,"id":"U"}, 
	   {"name":"VIRGIN" ,"id":"VC"}, 
	   {"name":"VODAFONE" ,"id":"V"} 
						  
    ];
	
	  var circles = [
	 {"name":"Andhra Pradesh" ,"id":"13"} ,
	 {"name":"Assam" ,"id":"24" } ,
	 {"name":"Bihar & Jharkhand" ,"id":"17"} ,
	 {"name":"Chennai" ,"id":"7"} ,
	 {"name":"Delhi NCR" ,"id":"5"} ,
	 {"name":"Gujarat" ,"id":"12"} ,
	 {"name":"Haryana" ,"id":"20"} ,
	 {"name":"Himachal Pradesh" ,"id":"21"} ,
	 {"name":"Jammu & Kashmir" ,"id":"25"} ,
	 {"name":"Karnataka" ,"id":"9"} ,
	 {"name":"Kerala" ,"id":"14"} ,
	 {"name":"Kolkata" ,"id":"6"} ,
	 {"name":"Maharashtra & Goa (except Mumbai)" ,"id":"4"} ,
	 {"name":"Madhya Pradesh & Chhattisgarh" ,"id":"16"} ,
	 {"name":"Mumbai" ,"id":"3"} ,
	 {"name":"North East" ,"id":"26"} ,
	 {"name":"Orissa" ,"id":"23"} ,
	  {"name":"Punjab" ,"id":"1"} ,
	   {"name":"Rajasthan" ,"id":"18"} ,
	    {"name":"Tamil Nadu" ,"id":"8"} ,
		 {"name":"UP EAST" ,"id":"10"} ,
		  {"name":"UP WEST" ,"id":"11"} ,
		  {"name":"West Bengal" ,"id":"2"} ,
    ];
            $scope.myData1 = operators;
            $scope.myData2 = circles;
            $scope.getOperator = function () {
            if ($scope.recharge.recharge_number.length == 10){
  $http.get("http://35.185.5.93:8080/Offers/Operator?mobile=" + $scope.recharge.recharge_number)
                            .then(function (response) {                    
                                 $scope.goperator=response.data.Operator_code;
                                 $scope.gcircle=response.data.Circle_code;
                            });
                }
            };
       });
            </script>
    </body>
</html>
';
}/* End function */
if(isset($_POST['submit'])){
recharge_page2(); 
}
function recharge_page2() {
           global $wpdb;global $wp_version;
           global $current_user;
           if (isset($_POST['submit'])) {
           $mob=$_POST['recharge_number'];
           $opt= $_POST['mobile_operator'];
           $circle= $_POST['recharge_circle'];
           $amount=$_POST['amount'];

           $current_user = wp_get_current_user();
           $wpdb->query("INSERT INTO wpb9_recharge(number,opt,circle,amount,user,email)
	             VALUES('$mob', '$opt', '$circle', '$amount','$current_user->user_login','$current_user->user_email')");
            $lastid = $wpdb->insert_id; 
  $r = $wpdb->get_results("SELECT opt,circle FROM wpb9_recharge WHERE id=$lastid");
  foreach($r as $o){
}
$response = wp_remote_get('http://admin.papafast.com/Rechargeoffer?Operator='.$o->opt.'&Circle='.$o->circle);
     $args = array(
    'ID' => '', 
    'post_author' => 1, 
    'post_content' => $response["body"], 
    'post_title' => 'Offer', 
    'post_status' => 'draft', 
    'post_type' => 'post', 
);
$post_id = wp_insert_post($args);
}
wp_redirect('http://35.185.5.93:8080/adminpapafast/payment.jsp?mobile='.$mob.'&amount='.$amount.'&operator='.$opt.'&recharge_circle='.$circle.'&id='.$lastid.'&url=http://mobilerechargeapi.in/blog/wp-admin/options-general.php?page=response');exit;
 }
function response_page() { 
global $wpdb;
$message = $_GET['message'];
$status = $_GET['Status'];
$id = $_GET['id'];
$txid=$_GET['txid'];
                                          
echo $message;                         echo '<br/>';
echo $status;                          echo '<br/>';
echo $id;                              echo '<br/>';
echo $txid;                            echo '<br/>';
$wpdb->show_errors();

if(isset($message)){
$wpdb->query("UPDATE wpb9_recharge SET status='$status',message='$message',txid='$txid' WHERE id='$id'");
wp_redirect('http://35.185.5.93:8080/adminpapafast/Status?username=masteradmin&password=1234&txid='.$txid.'');
$status = $_GET['status'];
$txid = $_GET['txid'];
$wpdb->query("UPDATE wpb9_recharge SET status='$status',txid='$txid' WHERE id='$id'");
     }//End If
}    /*  End function */
?>                                                                   


	
	









