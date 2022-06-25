
$(function () {

  localStorage.clear();


  $("#loaderStats").hide();

  
})

$("a").not('#logOutLink').click(function () {
  window.onbeforeunload = null;
});

$('#loadData').on('click', function() {
  let drawId = $('#drawSlot').val();
  let percent = $('#percent').val();
  $('#dataTenStats').html('');
  if(drawId == '' || percent == '') {
    Swal.fire(
      'Empty Data',
      'Please provide Complete Data',
      'warning'
    )
    
  }
  else {
    getTotalAmountBets(drawId,percent);
  }
  

});

// $('#drawSlot').on('change', function() {
//    let drawId = $('#drawSlot').val();
//     getTotalAmountBets(drawId);
//   });

  // $('#drawAllSlot').on('change', function() {
  //   let drawId = $('#drawAllSlot').val();
  //   getAllTotalAmountBets(drawId);
  //  });

var getStatistics =  function(total_bets,draw_id,percent) {
    // $('#bet_table').html('');
    
    // let pass = generateRandomPass();
   
  
        $.ajax({
        type:'post',
        url: 'backend/primary.php',
        data : {
          drawNum: draw_id
        },
        beforeSend: function() {
          // setting a timeout
          $("#loaderStats").show();
        },
        success : function(res){
            let jsonres = JSON.parse(res);
            // console.log("stats data: " + res);
           let dateTenStats  = '';
          //  let dateNineStats  = '';
          //  let dateEightStats  = '';
          //  let dateSeventStats  = '';
          //  let dateSixStats  = '';
          //  let dateFiveStats  = '';
          //  let dateFourStats  = '';
          //  let dateThreeStats  = '';
          //  let dateTwoStats  = '';
          //  let dateOneStats  = '';
           let lessZeroStats  = '';
           
           let total_person_earning  = 0;
           let total_residual_earning  = 0;
           
           let total_earnings = 0;
           let total_profit = 0;
           
        //    console.log("stats data: " + res);
        if(total_bets != 0)
            $('#totalBets').html('&#8369; ' + parseFloat(total_bets).toFixed(2));
        else
            $('#totalBets').html('&#8369; ' + 0.00);

            $('#dataTenStats').html(dateTenStats);

              // jsonres.sort((a, b) => {
              //   return b.age - a.age;
              // });
              let stats = [];
              
              Object.entries(jsonres).forEach(([key, value]) => {
                // let jnobets = JSON.stringify(value.nobets);
                // console.log("no bets: " + jnobets);
                // console.log("total residual earn: " + value.total_residual_earning);
                // let percent = getTotalAmountBets(value.total_amount);
                total_person_earning = value.total_person_earning;
                total_residual_earning = value.total_residual_earning;
               
                let statdata = {}; 
                let total_payouts = parseFloat(value.total_payout) + parseFloat(value.total_ramble) + parseFloat(value.total_twoD) + parseFloat(value.total_oneD);
                loader = parseFloat(total_bets) * 0.1;
                investor = parseFloat(total_bets) * 0.1;
                let deduc = loader + investor + parseFloat(total_person_earning) + parseFloat(total_residual_earning);
                total_earnings = parseFloat(total_bets) - deduc;
                total_profit = parseFloat(total_earnings) - parseFloat(total_payouts);
                // console.log("total_earnings: " + total_earnings);
                // console.log("total_ramble_bet: " + value.total_ramble_bet);
                console.log("percentSet: " + percent);
                let perc = ((parseFloat(total_payouts)/parseFloat(total_earnings)) * 100);
               
                localStorage.setItem("total_straightWin"+key, value.total_amount);
                localStorage.setItem("total_rumbleWin"+key, value.total_ramble_bet);
                localStorage.setItem("total_TwoDWin"+key, value.total_twoD_bet);
                localStorage.setItem("total_OneDWin"+key, value.total_oneD_bet);
                localStorage.setItem("total_person_earning"+key, value.total_person_earning);
                localStorage.setItem("total_residual_earning"+key, value.total_residual_earning);
                localStorage.setItem("total_bets"+key,total_bets);

                // console.log('perc: ' + perc.toFixed(2));

                      if(perc <= percent) {
                        
                        
                        statdata.digit = value.digit;
                        statdata.total_earnings = total_earnings;
                        statdata.total_payouts = total_payouts;
                        statdata.total_profit = total_profit;
                        statdata.percentage = perc;
                        statdata.key = key;
                        stats.push(statdata);
                      }
                

              });
              
              
                // $('#dataTenStats').html(dateTenStats);
                // $('#dateSixStats').html(dateSixStats);
                // $('#dateFourStats').html(dateFourStats);
                // $('#dateTwoStats').html(dateTwoStats);
                
                stats.sort((a, b) => {
                  return b.percentage - a.percentage;
                });

                stats.forEach((e) => {
                  // console.log(`${e.firstName} ${e.lastName} ${e.age}`);


                  dateTenStats += '<tr><td><strong> ' + e.digit + '</strong></td>' +
                  '<td> &#8369; ' + parseFloat(e.total_earnings).toFixed(2) + '</td>' +
                  '<td> &#8369; ' + e.total_payouts.toFixed(2) + '</td>';
                  if(e.total_profit < 0) {
                    
                  dateTenStats +='<td class="text-danger"> &#8369; ' + parseFloat(e.total_profit).toFixed(2) + '</td>' +
                  '<td class="text-danger"> <strong>' + e.percentage.toFixed() + '%</strong></td>';
                  }
                  else {

                    if(e.percentage == 0){
                      dateTenStats +='<td class="text-success"> &#8369; ' + parseFloat(e.total_profit).toFixed(2) + '</td>' +
                      '<td class="text-success"> <strong>' + e.percentage.toFixed() + '%</strong></td>';
                    }
                    else {
                      dateTenStats +='<td class="text-primary"> &#8369; ' + parseFloat(e.total_profit).toFixed(2) + '</td>' +
                      '<td class="text-primary"> <strong>' + e.percentage.toFixed() + '%</strong></td>';
                    }
                   
                  }
                  dateTenStats +='<td><a href="primary-tally.php?id='+e.key+'" class="btn btn-primary" id="viewData" >' + 
                  'View</a></td></tr>';
                });
               
                $('#dataTenStats').html(dateTenStats);
                let dataTabs = JSON.stringify(stats);
                console.log(dataTabs);
                
        },
        error: function(xhr) { // if error occured
          alert("Error occured.please try again");
          // $(placeholder).append(xhr.statusText + xhr.responseText);
          $("#loaderStats").hide();
        },
        complete: function() {
           
            $("#loaderStats").hide();
            // sortTable();
            
        }
        
    })
   
   
  
  };
  
  var getTotalAmountBets =  function(draw_id,percent) {
    // $('#bet_table').html('');
    let perc = 0;
        $.ajax({
        type:'post',
        url: 'getTotalBetamount.php',
        data : {
          draw_id: draw_id
        },
        success : function(res){
            console.log("total: " + res);
            var ten = parseFloat(res) * parseFloat(0.1)
              
              // let amnt = 8330.7;
               getStatistics(res,draw_id,percent);
              // console.log('percentage: ' + perc + '%');
            
            
        },
       
       
    })
  
  };

  var gotoDetails =  function(arrayval) {
    // $('#bet_table').html('');
    for (const element of arrayval) {
     console.log(element);
  }

  $("#viewData").on('click', function() {
    let x = $(this).data("transactionid");
    console.log('data: ' + x);
    // $("#pFrom").text($(this).data("name"));
    // $("#pCode").text($(this).data("code"));
    // $("#pid").val($(this).data("transactionid"));
});
    // let perc = 0;
    //     $.ajax({
    //     type:'post',
    //     url: 'getTotalBetamount.php',
    //     data : {
    //       draw_id: draw_id
    //     },
    //     success : function(res){
    //         console.log("total: " + res);
    //         var ten = parseFloat(res) * parseFloat(0.1)
              
    //           // let amnt = 8330.7;
               
           
    //            getStatistics(res,draw_id);
    //           // console.log('percentage: ' + perc + '%');
            
            
    //     },
       
       
    // })
  
    // return perc;
   
  
  };

  var getAllTotalAmountBets =  function(draw_id) {
    // $('#bet_table').html('');
    let perc = 0;
        $.ajax({
        type:'post',
        url: 'getTotalBetamount.php',
        data : {
          draw_id: draw_id
        },
        success : function(res){
            console.log("total: " + res);
            var ten = parseFloat(res) * parseFloat(0.1)
              
              // let amnt = 8330.7;
               
           
              getAllStatistics(res,draw_id);
              // console.log('percentage: ' + perc + '%');
            
            
        },
       
       
    })
  
    // return perc;
   
  
  };


  var getAllgetTotalPersonEarnings =  function(draw_id) {
    // $('#bet_table').html('');
    let perc = 0;
        $.ajax({
        type:'post',
        url: 'getTotalPersonEarnings.php',
        data : {
          draw_id: draw_id
        },
        success : function(res){
            console.log("total: " + res);
            var ten = parseFloat(res) * parseFloat(0.1)
              
              // let amnt = 8330.7;
               
           
              getAllStatistics(res,draw_id);
              // console.log('percentage: ' + perc + '%');
            
            
        },
       
       
    })
  
    // return perc;
   
  
  };

  var getAllStatistics =  function(total_bets,draw_id) {
    // $('#bet_table').html('');
    
    // let pass = generateRandomPass();
   
    let dateTenStats  = '';
        $.ajax({
        type:'post',
        url: 'backend/primary.php',
        data : {
          drawNum: draw_id
        },
        success : function(res){
            
            // console.log("stats data: " + res);
           
        //    console.log("stats data: " + res);
        if(total_bets != 0)
            $('#totalAllBets').html('&#8369; ' + parseFloat(total_bets).toFixed(2));
        else 
            $('#totalAllBets').html('&#8369; ' + 0.00);
        if(res){
            let jsonres = JSON.parse(res);
            Object.entries(jsonres).forEach(([key, value]) => {
    
                // let percent = getTotalAmountBets(value.total_amount);
                let total_payouts = parseFloat(value.total_payout) + parseFloat(value.total_ramble) + parseFloat(value.total_twoD) + parseFloat(value.total_oneD);
                
                let perc = ((parseFloat(total_payouts)/parseFloat(total_bets)) * 100);
                console.log('total_person_earning: ' + value.total_person_earning)
                // console.log('Digits: ' + value.digit);
                // console.log('Percentage: ' + perc.toFixed(2) + '%');(total_bets < total_payouts) ? "Gain Profit" : "Loss";
                let remarks = (total_payouts > total_bets) ? "Loss" : "Gain Profit";
                let remarksColor = (total_payouts > total_bets) ? "text-danger" : "text-success";
                dateTenStats += '<tr><td><strong> ' + value.digit + '</strong></td>' +
                '<td> &#8369; ' + parseFloat(total_bets).toFixed(2) + '</td>' +
                '<td> &#8369; ' + total_payouts.toFixed(2) + '</td>' +
                '<td class="text-primary"> <strong>' + perc.toFixed() + '</strong></td>' +
                '<td class="'+ remarksColor +'"> <strong>' + remarks  + '</strong></td></tr>';
                
                });
        }
        
            $('#dataAllTenStats').html(dateTenStats);
                
        }
        
    })
   
   
  
  };


  var sortTable = function() {
    console.log('sort table');
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("statsTable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
      // Start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /* Loop through all table rows (except the
      first, which contains table headers): */
      for (i = 1; i < (rows.length - 1); i++) {
        // Start by saying there should be no switching:
        shouldSwitch = false;
        /* Get the two elements you want to compare,
        one from current row and one from the next: */
        x = rows[i].getElementsByTagName("TD")[3];
        y = rows[i + 1].getElementsByTagName("TD")[3];
        // Check if the two rows should switch place:
        // if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          let parsex = parseInt(x.innerHTML);
          let parsey = parseInt(y.innerHTML);
        if (parsex > parsey) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
      if (shouldSwitch) {
        /* If a switch has been marked, make the switch
        and mark that a switch has been done: */
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }
  };


  
  // $(window).unload(function(){
    
  //   });

  // $(window).on('beforeunload', function(){
  //   console.log("Goodbye!");
  //   return "Good bye";
  // });​

    window.onbeforeunload = function(event) {
      var message = 'Please click on \'Save\' button to leave this page.';
      console.log("Goodbye!");
      if(typeof event == 'undefined'){
        event = window.event;
      }
      if(event){
        event.returnValue = message;
      }
      
      return message;
  };

//   window.addEventListener('beforeunload', function (e) {
//     console.log("Goodbye!");
//     e.preventDefault();
//     e.returnValue = '';
// });
  