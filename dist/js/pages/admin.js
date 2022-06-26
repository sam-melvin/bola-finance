let isLive = false;

let api = '';
$(function () {
  

  if (window.location.href.indexOf("test") > -1) {

    api = 'http://test-bolaswerte.bolaswerte.com/api/';
  }
  else {
    api = 'http://bolaswerte.bolaswerte.com/api/';
  }
  
$("#spinner").hide();
var bgclass = "btn btn-app bg-success";
var hideLive = $('#hideLive').val();
console.log("hideLive: " + hideLive);

if(hideLive == 1){
     isLive = true;
     
}

$("#div_loader").hide();
$("#div_investor").hide();
console.log("isLive: " + isLive);

if(isLive){
    $('#liveStatus').val('Online');
    $("#source_link").attr("disabled", "disabled");
    $("#livebtn").attr('class', 'btn btn-app bg-success');
    $('#livebtn').html('<i class="fas fa-stop"></i> Stop');
    $('#liveVid').show();
    

}
else{
    $('#liveStatus').val('Offline');
    $("#source_link").removeAttr("disabled");
    $("#livebtn").attr('class', 'btn btn-app');
    $('#livebtn').html('<i class="fas fa-play"></i> Live');
    $('#liveVid').hide();
}



})




//   $("input[data-bootstrap-switch]").on('change.bootstrapSwitch', function(e) {
//     console.log(e.target.checked);
//     if(e.target.checked) {
//         console.log("On");
//         isLive = true;
//         $("#livebtn").attr('class', 'btn btn-app bg-success');

//     }
//     else {
//         console.log("Off");
//         isLive = false;
//         $("#livebtn").attr('class', 'btn btn-app');

//     }
// })


$('#livebtn').on('click', function() {
    console.log("naclick");
    console.log(isLive);
    if(!isLive){
        
        confirmLive(1);
        // $("#livebtn").attr('class', 'btn btn-app bg-success');
        // $('#livebtn').html('<i class="fas fa-stop"></i> Stop');
    }
    else{
        
        confirmLive(0);
        // $("#livebtn").attr('class', 'btn btn-app ');
        // $('#livebtn').html('<i class="fas fa-play"></i> Live');
    }
        
});

var confirmLive = async function(status) {
    var source_link = $('#source_link').val();
    let titletext = '';
    let confirmText = '';
    if(source_link == ''){
        Swal.fire(
            'Error!',
            'Please provice Source Link',
            'error'
          )
    }
    else {
        if(status == 0){
            titletext = 'Do you want to stop live now?';
            confirmText = 'Stop now';
            source_link = '';
        }
        else {
            titletext = 'Do you want to go live now?';
            confirmText = 'Go Live!';
        }

        Swal.fire({
            title: titletext,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: confirmText,
            denyButtonText: `Cancel`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
               goLive(status,source_link);
            } else if (result.isDenied) {
              Swal.fire('Changes are not saved', '', 'info')
            }
          })
    }
   
};


var goLive = async function(status,source_link) {
    $.ajax({
        type:"post",
        dataType: "json",
        data:{
            url_src: source_link,
            live: status,
        },
        url:"http://bolaswerte.bolaswerte.com/api/goLive/",
        success:function(res)
        {
            const textres = res;
            console.log('res: ' + textres);
            Swal.fire(
                'Saved!',
                '',
                'success'
              )
              
              
              setTimeout(function(){ location.replace('live.php'); }, 3000);
        },
        error : function(result, statut, error){ // Handle errors
            console.log('result: ' + result.responseText);
            // let myJson = JSON.stringify(result);
            // console.log('result: ' + myJson);
          }

    });

};


$('#reguserAdminbtn').on('click', function() {
    var uname = $('#uname').val();
    var apass = $('#apass').val();
    var cpass = $('#cpass').val();
    var fname = $('#fname').val();
    var aemail = $('#aemail').val();
    var phone_no = $('#phone_no').val();
    var code = $('#code').val();
    var gcash_no = $('#gcash_no').val();
    var selectType = $('#selectType').val();
    var seletProvince = $('#seletProvince').val();
    var comm_perc = $('#comm_perc').val();
    console.log("uname: " + uname);
    console.log("apass: " + apass);

    if(uname == '' || apass == '' || fname == '' || aemail == '' || phone_no == '' || selectType == '' ) {
        Swal.fire(
            'Some fields are empty!',
            'Please complete all the information.',
            'error'
          )
    }
    else {

        if(apass == cpass) {
            Swal.fire({
                title: 'Do you want to save user?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                denyButtonText: `Cancel`,
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    registerAdmin(uname,apass,fname,aemail,phone_no,gcash_no,seletProvince,code,selectType,comm_perc);
                } else if (result.isDenied) {
                  Swal.fire('Changes are not saved', '', 'info')
                }
              })
           
        }
        else {
            Swal.fire(
                'Password not match!',
                'confirm you password',
                'error'
              )
        }
       
    }
    

}); 



  let prov = 0;
  let seq = 0;


  // $('#drawDate').on('change', function() {
  //   console.log("update");
  //   let drawId = $('#drawAllSlot').val();
  //   // getAllTotalAmountBets(drawId);
  //  });

  
$('#loadDate').on('click', function() {
  // let drawId = $('#drawDate').val();
  var dateId = $('#drawDate').val();
console.log('change' + dateId);
loadDatedDraws(dateId);
});


var loadDatedDraws = function (dateId) {

  $.ajax({
    type:"post",
    dataType: "json",
    data:{
        draw_date: dateId
        
    },
    url:"getSelDraw.php",
    success:function(res)
    {
        const textres = res;
        console.log('res: ' + textres.data);
        
        $('#drawData').html(textres.data);

        //   setTimeout(function(){ location.replace('admin_users.php'); }, 3000);// 2seconds
    },
    error : function(result, statut, error){ // Handle errors
        console.log('result: ' + result.responseText);
        // let myJson = JSON.stringify(result);
        // console.log('result: ' + myJson);
      }
 });

};

$('#selectType').change(function() {
    var selectType = $('#selectType').val();
    getProvince();
    // getCode();
    if(selectType == 3){
        $("#div_loader").show();
        $("#gcashLabel").show();
        $("#gcash_no").show();
    }
    else if(selectType == 4){
        $("#div_investor").show();
        $("#gcashLabel").hide();
        $("#gcash_no").hide();
    }
    else {
        $("#div_loader").hide();
        $("#div_investor").hide();
    }
    // do stuff here;
  });

  var getProvince = function() {
    $('#bet_table').html('');
    if(prov == 0){
        $.ajax({
        type:'post',
        url: 'getprovince.php',
        data : {},
        success : function(data){
            console.log("data province: " + data);
            $('#seletProvince').html(data);
        }
        
    })
    prov = 1;
    }
    
};

let code = '';

var getCode =  function(refer,datas,isApproved) {
    // $('#bet_table').html('');
    
    let pass = generateRandomPass();
    
    if(seq == 0){
        $.ajax({
        type:'post',
        url: 'loader_seq.php',
        data : {},
        success : function(data){
            console.log("loader data: " + data);
            // $("#code").val("BSL-"+data);
            // $("#code").val("BSL-"+data);
             let code = "BSL-"+data;
             sendEmail(pass,code,refer,datas,isApproved);
            
        }
        
    })
    seq = 1;
    }

};

$('#live_switch').change(function() {
    console.log("data: ");
    if(this.checked) {
         
        // var returnVal = confirm("Are you sure?");
        // $(this).prop("checked", returnVal);
    }
    // $('#textbox1').val(this.checked);        
});


$('#btnSigninAdmin').on('click', function() {
    var user_name = $('#user_name').val();
    var man_pass = $('#man_pass').val();
    var weHaveSuccess = false;
    var emptFields = false;

    if(user_name == "" || man_pass == "")
        emptFields = true;

      $.ajax({
          type: "POST",
          url: "signin.php",
          dataType:"text",
          data: {
            user_name: user_name,
              man_pass: man_pass
          },
          cache: false,
          success: function(dataResult){
              console.log('dataResult: ' + dataResult);
                  if(dataResult === 'success')
                  {
                    console.log('pasok: ');
                   
                    
                      weHaveSuccess = true;
                      location.replace("./");
                      
                      
                  }
                  else {
                      weHaveSuccess = false;
                  }

          },
          error: function(xhr, status, error){
              alert("Error!" + xhr.status);
          },
          complete: function(){
            if(!weHaveSuccess){
                $('#signinAdmin').find('input:password').val('');
                Swal.fire(
                  'Invalid email/password.',
                  '',
                  'error'
                )
                
            }

            if(emptFields){
                Swal.fire(
                  'Some fields are empty.',
                  '',
                  'error'
                )
            }
        },
      });
  });


var confirmApproveApplication = function(datas,isApproved) {
  Swal.fire({
    title: 'Enter referrence Number',
    input: 'text',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Submit',
    showLoaderOnConfirm: true,
    preConfirm: (refer) => {
      if(refer != '') {
        approvedApplication(refer,datas,isApproved)
      }
      else {
        Swal.fire('Empty Field! process not saved.', '', 'error')
      }
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    
  })

};
  

  var approvedApplication = async function(refer,datas,isApproved) {
    
    console.log('data ids:' + datas);
    console.log('data isApproved:' + isApproved);
    let stats = 'DECLINE';
    if(isApproved)
    stats = 'Approve';
  
      Swal.fire({
        title: 'Do you want to '+ stats +' the Application?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'Proceed',
        denyButtonText: `Cancel`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            if(isApproved)
            getCode(refer,datas,isApproved);
            else
            saveDataApp('','',datas,isApproved);
            
            
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })
    
    };
  
  
    var saveDataApp = async function(pass,code,refer,datas,isApproved) {
        
    console.log('code: ' + code);
      let status = 'declined';
      if(isApproved)
        status = 'approved'
      
      // let sdatas = JSON.stringify(datas); 
      console.log('status: ' + status);
      console.log('pass: ' + pass);
      $.ajax({
        type:"post",
        dataType: "json",
        data:{
          ids: datas.ids,
          code: code,
          password: pass,
          username: datas.username,
          email: datas.lemail,
          phone_no: datas.phone,
          gcash_no: datas.gcash,
          amount_deposit: datas.amount,
          ref_no: refer,
          full_name: datas.fname,
          assign_location: datas.province,
          status: status
        },
        url:"http://bolaswerte.bolaswerte.com/api/loaderApplication/",
        success:function(res)
        {
            Swal.fire('Saved!', '', 'success')
          setTimeout(function(){ location.reload(); }, 2000);// 2seconds
            const myJson = res;
            const textres = res.data;
            console.log('res: ' + myJson);
            
            
        },
        error : function(result, statut, error){ // Handle errors
          console.log('result: ' + result.responseText);
          // let myJson = JSON.stringify(result);
          // console.log('result: ' + myJson);
        },
        complete: function() {
            $("#spinner").hide();
            //A function to be called when the request finishes 
            // (after success and error callbacks are executed). 
        }
        
     });
  
        
  };


  var sendEmail = async function(pass,code,refer,datas,isApproved) {
    $("#spinner").show();
    console.log('code: ' + code);
      let bodymsg = '';
      if(isApproved) {
        bodymsg = "Congratulations <strong>" + datas.fname + "</strong>, your application to be a loader has been approved. You credentials to login listed below. <br/>" +
        "<i>Congratulations, ang iyong application bilang maging loader ay pumasa. Ang mga detalye para ikaw ay makapaglogin ay nakalista sa baba. </i><br/>" +
        "Login Site: admin.bolaswerte.com <br/>" +
        "Email: " + datas.lemail + "<br/>" + 
        "Username: " + datas.username + "<br/>" + 
        "Password: " + pass + "<br/>" +
        "<p><strong>Note:</strong>Since the password is auto generate, We advice to change your password after you login. Thank you. <br/>" + 
        "<p><i><strong>Note:</strong>Dahil ang password ay kusang ginawa ng system, ang aming payo ay palitan agad ang iyong password pagkatapos mag login. Maraming Salamat. <br/>" +

        "<p>Para sa iba pang klaripikasyon at kahit anu man tungkol sa bolaswerte tumawag lamang sa aming hotline: .<strong>7777-123456</strong>";
      }
      else {
        bodymsg = "We would like to inform you that your application to be a loader has been denied. You can try again and fill up the informations accurately. Thank you. </i>";
      }
      
      // let sdatas = JSON.stringify(datas); 


      
    let subject = "Account Verification";

      $.ajax({
        type:"post",
        dataType: "json",
        data:{
          fname: datas.fname,
          email: datas.lemail,
          bodymsg: bodymsg,
          subject: subject
          
        },
        url:"sent_mail.php",
        success:function(res)
        {
            saveDataApp(pass,code,refer,datas,isApproved);
          
            const myJson = res;
            console.log('res: ' + myJson);
           
        },
        error : function(result, statut, error){ // Handle errors
          console.log('result: ' + result.responseText);
          // let myJson = JSON.stringify(result);
          // console.log('result: ' + myJson);
        }
        
     });
  
        
  };




  var generateRandomPass = function() {
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 8;
    var password = "";

    for (var i = 0; i <= passwordLength; i++) {
        var randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber +1);
       }

    return password;
  }


  $('#selProvince').change(function() {
    var province = $('#selProvince').val();
    
    $.ajax({
      type:'get',
      url: 'getAdminLoader.php',
      data : {province: province},
      success : function(data){
          console.log("data: " + data);
          $('#selReceiver').html(data);
          
      }
      
      })
    // do stuff here;
  });


  $('#selReceiver').change(function() {
    var reciever = $('#selReceiver').val();
    
    $.ajax({
      type:'post',
      url: 'getWalletBalance.php',
      data : {ids: reciever},
      success : function(data){
          console.log("balance: " + data);
          // $('#selReceiver').html(data);
          $('#loader_bal').val(data);
          
      }
      
      })
    // do stuff here;
  });

//   var getProvince = function() {
     
//     // $('#bet_table').html('');
//     if(prov == 0){
        
//     prov = 1;
//     }
    
// };


var confirmSendLoad = function() {
  
// var cds = JSON.stringify(cd);
// console.log('cds : ' + cds );

  Swal.fire({
    title: 'Do you want to send money?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Proceed',
    denyButtonText: `Cancel`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
        sendMoney();
    } else if (result.isDenied) {
      Swal.fire('Changes are not saved', '', 'info')
    }
  })
}

var sendMoney = function() {
 
  console.log('save');
  let loader_bal = $('#loader_bal').val();
  let cur_balance = $('#cur_balance').val();
  let receiver = $('#selReceiver').val();
  
  let amount = $("#amount").inputmask('unmaskedvalue');
  let code = $('#selReceiver').find(':selected').data('code');
  let adminId = $('#adminId').val();
  let ref_no = $('#ref_no').val();
console.log("code: " + code);
  $.ajax({
    type:"post",
    dataType: "json",
    data:{
      code:code,
      financer_id: adminId,
      admin_id: receiver,
      ref_no: ref_no,
      amount: amount,
      loader_bal: loader_bal,
      cur_balance: cur_balance,
      from: 'direct'
      
    },
    url: api + "sendMoney/",
    success:function(res)
    {
        Swal.fire('Saved!', '', 'success')
      setTimeout(function(){ location.reload(); }, 3000);// 2seconds
        const myJson = res;
        const textres = res.data;
        console.log('res: ' + myJson);
        
        
    },
    error : function(result, statut, error){ // Handle errors
      console.log('result: ' + result.responseText);
      // let myJson = JSON.stringify(result);
      // console.log('result: ' + myJson);
    },
    complete: function() {
        $("#spinner").hide();
        //A function to be called when the request finishes 
        // (after success and error callbacks are executed). 
    }
    
 });
}


var confirmApprovedSendLoad = function(datas,isApproved) {
  
  // var cds = JSON.stringify(cd);
  // console.log('cds : ' + cds );
    Swal.fire({
      title: 'Do you want to send money?',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'Proceed',
      denyButtonText: `Cancel`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
          ApprovedsendMoney(datas,isApproved);
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }

var ApprovedsendMoney = function(datas,isApproved) {
 
  console.log('save');
  let cur_balance = $('#cur_balance').val();
console.log("code: " + code);
  $.ajax({
    type:"post",
    dataType: "json",
    data:{
      ids: datas.ids,
      code:datas.code,
      financer_id: datas.admin_id,
      admin_id: datas.receiver,
      ref_no: datas.ref_no,
      amount: datas.amount,
      loader_bal: 0,
      cur_balance: cur_balance,
      from: 'approved'
      
    },
    url: api + "sendMoney/",
    success:function(res)
    {
        Swal.fire('Saved!', '', 'success')
      setTimeout(function(){ location.reload(); }, 3000);// 2seconds
        const myJson = res;
        const textres = res.data;
        console.log('res: ' + myJson);
        
        
    },
    error : function(result, statut, error){ // Handle errors
      console.log('result: ' + result.responseText);
      // let myJson = JSON.stringify(result);
      // console.log('result: ' + myJson);
    },
    complete: function() {
        $("#spinner").hide();
        //A function to be called when the request finishes 
        // (after success and error callbacks are executed). 
    }
    
 });
}

$("#addFundsbtn").click(function(){
  let amountBal = $("#amount_bal").inputmask('unmaskedvalue');
  let remarks = $('#remarks').val();
  
  if(amountBal == '' || remarks == '' || ref_no == '') {
    Swal.fire(
        'Some fields are empty!',
        'Please complete all the information.',
        'warning'
      )
  }
  else {
    Swal.fire({
      title: 'Adding funds confirmation?',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'Proceed',
      denyButtonText: `Cancel`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
          addFunds(amountBal,remarks);
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  }
  
});  


var addFunds = function (amountBal,remarks) {

  let adminId = $('#addadminId').val();
  $.ajax({
    type:"post",
    dataType: "json",
    data:{
      admin_id: adminId,
      financer_id: adminId,
      amount: amountBal,
      notes: remarks
      
    },
    url: api + "addFunds/",
    success:function(res)
    {
      Swal.fire(
        'Funds Added!',
        '',
        'success'
      )
      setTimeout(function(){ location.reload(); }, 3000);// 2seconds
        const myJson = res;
        const textres = res.data;
        console.log('res: ' + myJson);
        
        
    },
    error : function(result, statut, error){ // Handle errors
      console.log('result: ' + result.responseText);
      // let myJson = JSON.stringify(result);
      // console.log('result: ' + myJson);
    },
    complete: function() {
        $("#spinner").hide();
        //A function to be called when the request finishes 
        // (after success and error callbacks are executed). 
    }
    
 });


  
}





