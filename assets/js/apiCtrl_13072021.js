angular.module('app', ['ngMaterial'])
.run(function($rootScope) {
    $rootScope.url = window.location.host; // bootstrap3 theme. Can be also 'bs2', 'default'
    console.log($rootScope.url);
})
.filter("asDate", function () {
    return function (input) {
        return new Date(input);
    }
})
.service('popup', function($mdDialog) {
    this.view = function (message) {
        $mdDialog.show(
            $mdDialog.alert()
              .parent(angular.element(document.querySelector('#popupContainer')))
              .clickOutsideToClose(true)
              .title('This is an alert title')
              .textContent(message)
              .ariaLabel('Alert')
              .ok('OK')
              //.targetEvent(ev)
        );
    }
})
.controller('disbursementCtrl', function($scope,$rootScope,$http,$location,popup,$mdDialog){
	$scope.disburse = function(){
		console.log($scope.u);
	}
})
.controller('zoneCtrl', function($scope,$rootScope,$http,$location,popup,$mdDialog){
	$scope.changeZone = function(zone){
		$http({
  		url: "/huda_uat/user/zoneUpdate",
  		method: "POST",
  		data: 'zone_name='+zone+'&zone_id='+zone+'&csrf_test_name='+$("input:hidden[name='csrf_test_name']").val(),
  		headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8;'}
                }).then(function(resp) {
                                $rootScope.load=0;
                                  console.log(resp.data);
                                  if (resp.data.StatusCode == 'NP000') {
                                  	console.log("Session Set");
                                  	 window.location.reload(); 
                                  }else {
                                  	$scope.message = "incorrect Password";
                                  }
                              }
                                  , function(err) {
                                       $rootScope.load=0;
  				console.error('ERR', err);
                                    alert("It Seems Connectivity Issue");
  				})
	}
})
.controller('customerCtrl', function($scope,$rootScope,$http,$location,popup,$mdDialog){
  function disbursement($scope, $mdDialog) {
    $scope.hide = function() {
      $mdDialog.hide();
    };

    $scope.cancel = function() {
      $mdDialog.cancel();
    };

    $scope.disburse = function() {   
    $scope.otp = 0;
      //$mdDialog.hide(disburse);
      console.log()
      console.log($scope.u);
      $http({
  		url: "/huda_uat/user/verifyUser",
  		method: "POST",
  		data: 'tPassword='+$scope.u.tPassword+'&csrf_test_name='+$("input:hidden[name='csrf_test_name']").val(),
  		headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8;'}
                }).then(function(resp) {
                                $rootScope.load=0;
                                  console.log(resp.data);
                                  if (resp.data.StatusCode == 'NP000') {
                                     if(localStorage.getItem('type') == "reject"){
                                     		$scope.reasonBox = 1;
                                	  //document.getElementById("reReject").type = "submit"; 
                                	}
                                     if(localStorage.getItem('type') == "release"){
                                	  //document.getElementById("reRelease").type = "submit";
                                	  	$scope.reasonBox = 0; 
                                	}	
                                  	$scope.otp = 1;
                                  }else {
                                  	$scope.message = "incorrect Password";
                                  }
                              }
                                  , function(err) {
                                       $rootScope.load=0;
  				console.error('ERR', err);
                                    alert("It Seems Connectivity Issue");
  				})
    };

    $scope.resendOtp = function() {   
      $http({
  		url: "/huda_uat/user/sendOtp",
  		method: "POST",
  		data: 'to='+1+'&csrf_test_name='+$("input:hidden[name='csrf_test_name']").val(),
  		headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8;'}
                }).then(function(resp) {
                                $rootScope.load=0;
                                  console.log(resp.data);
                                  if (resp.data.StatusCode == 'NP000') {
                                  	$scope.otp = 1;
                                  	$scope.message1 = "New OTP sent on your registered mobile number";
                                  }else {
                                  	$scope.message1 = "incorrect Password";
                                  }
                              }
                                  , function(err) {
                                       $rootScope.load=0;
  				console.error('ERR', err);
                                    alert("It Seems Connectivity Issue");
  				})
    };
    
    $scope.verify = function() {
      //$mdDialog.hide(disburse);
      console.log($scope.u);
      $http({
  		url: "/huda_uat/user/verifyOTP",
  		method: "POST",
  		data: 'otp='+$scope.u.otp+'&csrf_test_name='+$("input:hidden[name='csrf_test_name']").val(),
  		headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8;'}
                }).then(function(resp) {
                                $rootScope.load=0;
                                  console.log(resp.data);
                                  if (resp.data.StatusCode == 'NP000') {
                                  var role = localStorage.getItem('role');
                                  var reason = document.getElementById('reason_popup').value;
                                  console.log(reason);
                                  if(localStorage.getItem('type') == "reject" && localStorage.getItem('recType') == "record"){
                                     document.getElementById('reason_record').value = reason;
                                     document.getElementById('btn-action').value = 'reject';
                                  }
                                  if(localStorage.getItem('type') == "reject" && localStorage.getItem('recType') == "file" && role != 'auth'){
                                     document.getElementById('reason_file').value = reason;
                                     document.getElementById('btn-action_file').value = 'reject';
                                  }
                                  if(localStorage.getItem('type') == "reject" && localStorage.getItem('recType') == "file" && role == 'auth'){
                                     document.getElementById('reason_file_auth').value = reason;
                                     document.getElementById('btn-action_file_auth').value = 'reject';
                                  }
                                  document.releaseForm.submit();
                                  }else {
                                      //alert("Incorrect OTP");
                                  	$scope.message1 = "incorrect OTP";
                                  }
                              }
                                  , function(err) {
                                       $rootScope.load=0;
  				console.error('ERR', err);
                                    alert("Problem Verifying OTP");
  				})
    };
    
    $scope.moveImmediately = function(){
        if(localStorage.getItem('recType') == 'file'){
            document.getElementById('btn-action_file_auth').value = 'immediate';
        }
        else if(localStorage.getItem('recType') == 'record'){
            document.getElementById('btn-action').value = 'immediate';
        }
        document.releaseForm.submit();
    }
  }
function titleCase(str) {
  return str.split(' ').map(function(val){ 
    return val.charAt(0).toUpperCase() + val.substr(1).toLowerCase();
  }).join(' ');
}

$('.checkbox1').change(function() {
            $rootScope.checked =  $('input:checkbox:checked').length;
            console.log($rootScope.checked);
            //alert($rootScope.checked);
            // if($rootScope.checked >= 1){
            //  $(':input[type="button"]').prop('disabled', false);
            // }else{
            //     $(':input[type="button"]').prop('disabled', true);z
            // }
            if($rootScope.checked >= 1){
              //alert('if')
              //$('button.btn').removeAttr("disabled");
            }
            else{
              //alert('else')
             // $('button.btn').prop("disabled", true);
            }
    });
$('.checkboxAll').change(function() {
            $rootScope.checked =  $('input:checkbox:checked').length;
            console.log($rootScope.checked);
            if($rootScope.checked >= 1){
            // $(':input[type="button"]').prop('disabled', false);
            }else{
                //$(':input[type="button"]').prop('disabled', true);
            }
    });    

$scope.confirmRelease = function(ev,type,recType,role){
function replaceAll(input, replace, replacewith) {
    return input.split(replace).join(replacewith);
}
    var sum = 0;
$('#example tr').filter(':has(:checkbox:checked)').find('.netAmount').each(function() {
    $tr = $(this);
    $.each( $tr, function( key, value ) {
    console.log(parseFloat(replaceAll(value.innerHTML,',','')));
            sum += parseFloat(replaceAll(value.innerHTML,',',''));
	});
});


var checked_rec = $('input:checkbox.checkbox1:checked').length;
// alert(checked_rec);
//$rootScope.checked = checked_rec;
//console.log($rootScope.checked);

localStorage.setItem('type',type);
localStorage.setItem('recType',recType);
localStorage.setItem('role',role);
var ttt = type;
var type1 = '';
if(type == 'reject'){
$scope.tType = 0;
var type1 = 'reject';
}else if(type == 'authorization'){
$scope.tType = 1;
var type1 = 'authoriz'; 
}else{
$scope.tType = 1;
type1 = 'releas';
}

	if(checked_rec >= 1){
    $mdDialog.show({
      controller: disbursement,
      template: '<md-dialog aria-label="Mango (Fruit)">'+
  '<form ng-cloak>'+
    '<md-toolbar>'+
      '<div class="md-toolbar-tools">'+
        '<h2>'+ titleCase(type) +' Confirmation</h2>'+
        '<span flex></span>'+
        '<md-button class="md-icon-button" ng-click="cancel()">'+
          '<md-icon aria-label="Close dialog"></md-icon>'+
        '</md-button>'+
      '</div>'+
    '</md-toolbar>'+
    '<div ng-show="!otp">'+
    '<md-dialog-content>'+
      
     ' <div class="md-dialog-content">'+
      '  <h4>You are ' + titleCase(type == 'release' ? 'releas' : type1) + 'ing ' + checked_rec + ' ' +  recType +'(s) worth Rs. '+ parseFloat(sum).toFixed(2) + '</h4>'+
       ' <p ng-bind="message" style="color:red">'+
        '</p>'+
        '<div layout="row">'+
        '<md-input-container flex="100">'+
          '<label>Enter Transaction Password</label>'+
          '<input required name="clientName" type="password" ng-model="u.tPassword">'+
          '<div ng-messages="projectForm.clientName.$error">'+
           ' <div ng-message="required">This is required.</div>'+
          '</div>'+
        '</md-input-container>'+
     '</div>'+ 
     '</div>'+
     
        '</md-dialog-content>'+
        '<!--<div class="md-dialog-content">'+
        '<p> Please select atleast one record or file </p>'+
        '</div>'+
        '</md-dialog-content>-->'+
        
        '<md-dialog-actions layout="row">'+
        '<md-button  md-autofocus ng-click="cancel()">'+
       ' Cancel'+
      '</md-button>'+
      '<md-button  md-autofocus  ng-click="disburse()">'+
       ' Submit'+
      '</md-button>'+
    '</md-dialog-actions>'+
    '</div>'+
    
    '<div ng-show="otp">'+
    '<md-dialog-content>'+
     ' <div class="md-dialog-content">'+
      '  <h4>Verify Using OTP</h4>'+
       ' <p style="color:red" ng-bind="message1"> '+
       
        '</p>'+
        '<div layout="row">'+
        '<md-input-container flex="100">'+
          '<label>Enter OTP</label>'+
          '<input required name="clientName" type="password" ng-model="u.otp">'+
          '<div ng-messages="projectForm.clientName.$error">'+
           ' <div ng-message="required">This is required.</div>'+
          '</div></div>'+
         
        '</md-input-container>'+
        '<div layout="row" ng-show="reasonBox">'+ 
        '<md-input-container flex="100">'+
          '<label>Enter Rejection Reason</label>'+
          '<input required  id="reason_popup" type="textbox" ng-model="u.reason">'+
          '<div ng-messages="projectForm.reason.$error">'+
           ' <div ng-message="required">This is required.</div>'+
          '</div>'+
        '</md-input-container>'+
        '</div>'+
     '</div>'+ 
        '</md-dialog-content>'+
        '<md-dialog-actions layout="row">'+
        '<md-button  md-autofocus ng-click="cancel()">'+
       ' Cancel'+
      '</md-button>'+
      '<md-button  md-autofocus ng-disabled="!u.otp" ng-click="verify()">'+
       ' Submit'+
      '</md-button>'+
      '<a href="" ng-click="resendOtp()"> Resend OTP </a>'+
    '</md-dialog-actions>'+
    '</div>'+
    
  '</form>'+
'</md-dialog>',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:true,
      fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
    })
    .then(function(answer) {
      $scope.status = 'You said the information was "' + answer + '".';
    }, function() {
      $scope.status = 'You cancelled the dialog.';
    });
  }else{
    alert('Please select atleast one record.');
  }
};

$scope.getAuditTrail = function(ev,record_id) {  
    //var postData = $.param({csrf_token: $("input:hidden[name='csrf_test_name']").val()});
      $http({
  		url: "/huda_uat/user/getAuditData",
  		method: "POST",
  		data: 'record_id='+record_id+'&csrf_test_name='+$("input:hidden[name='csrf_test_name']").val(),
  		headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8;'}
                }).then(function(resp) {
                                $rootScope.load=0;
                                  console.log(resp.data);
                                  if (resp.data.StatusCode == 'NP000') {
                                  jQuery.noConflict(); 
                                  	$('#auditModal').modal('show');
                                        $rootScope.audits= resp.data.data;
                                  }else {
                                  	$scope.message = "incorrect Password";
                                  }
                              }
                                  , function(err) {
                                       $rootScope.load=0;
  				console.error('ERR', err);
                                    alert("It Seems Connectivity Issue");
  				})
    };
    function DialogController($scope, $mdDialog) {
    $scope.hide = function() {
      $mdDialog.hide();
    };

    $scope.cancel = function() {
      $mdDialog.cancel();
    };

    $scope.answer = function(answer) {
      $mdDialog.hide(answer);
    };
  }
    

  $scope.confirmImmediate = function(ev,type,recType,role){
      localStorage.setItem('type',type);
localStorage.setItem('recType',recType);
localStorage.setItem('role',role);
 
    function replaceAll(input, replace, replacewith) {
        return input.split(replace).join(replacewith);
    }
    var sum = 0;
$('#example tr').filter(':has(:checkbox:checked)').find('.netAmount').each(function() {
    $tr = $(this);
    $.each( $tr, function( key, value ) {
    console.log(parseFloat(replaceAll(value.innerHTML,',','')));
            sum += parseFloat(replaceAll(value.innerHTML,',',''));
	});
});


var checked_rec = $('input:checkbox.checkbox1:checked').length;

if(checked_rec >= 1){
	$mdDialog.show({
      controller: disbursement,
      template: '<md-dialog aria-label="Mango (Fruit)">'+
  '<form ng-cloak>'+
    '<md-toolbar>'+
      '<div class="md-toolbar-tools">'+
        '<h2>'+ titleCase(type) +' Confirmation</h2>'+
        '<span flex></span>'+
        '<md-button class="md-icon-button" ng-click="cancel()">'+
          '<md-icon aria-label="Close dialog"></md-icon>'+
        '</md-button>'+
      '</div>'+
    '</md-toolbar>'+
    '<div ng-show="!otp">'+
    '<md-dialog-content>'+
      
     ' <div class="md-dialog-content">'+
      '  <h4>You are sending' + checked_rec + ' ' +  recType +'(s) worth Rs. '+ parseFloat(sum).toFixed(2) + ' immediately to Authoriser/LAO' +'</h4>'+
       ' <p ng-bind="message" style="color:red">'+
        '</p>'+
        /*'<div layout="row">'+
        '<md-input-container flex="100">'+
          '<label>Enter Transaction Password</label>'+
          '<input required name="clientName" type="password" ng-model="u.tPassword">'+
          '<div ng-messages="projectForm.clientName.$error">'+
           ' <div ng-message="required">This is required.</div>'+
          '</div>'+
        '</md-input-container>'+
     '</div>'+ */
     '</div>'+
     
        '</md-dialog-content>'+
        '<!--<div class="md-dialog-content">'+
        '<p> Please select atleast one record or file </p>'+
        '</div>'+
        '</md-dialog-content>-->'+
        
        '<md-dialog-actions layout="row">'+
        '<md-button  md-autofocus ng-click="cancel()">'+
       ' Cancel'+
      '</md-button>'+
      '<md-button  md-autofocus  ng-click="moveImmediately()">'+
       ' Submit'+
      '</md-button>'+
    '</md-dialog-actions>'+
    '</div>'+
    
  '</form>'+
'</md-dialog>',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:true,
      fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
    })
    .then(function(answer) {
        alert("Yes");
      $scope.status = 'You said the information was "' + answer + '".';
    }, function() {
      $scope.status = 'You cancelled the dialog.';
    });
    }else{
    alert('Please select atleast one record.');
  }
};
 
 

  
});