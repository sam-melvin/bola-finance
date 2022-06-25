/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

/* global moment:false, Chart:false, Sparkline:false */
let api = '';
$(function () {
 
  'use strict'
  // $('#drawNumber').attr("disabled", true);
  // $('#drawDate').attr("disabled", true);
  // $('#drawTime').attr("disabled", true);
 
  if (window.location.href.indexOf("test") > -1) {

    api = 'http://test-bolaswerte.bolaswerte.com/api/';
  }
  else {
    api = 'http://bolaswerte.bolaswerte.com/api/';
  }


  $("#winnerData").html("<tr><td colspan='6'><h2 align='center'>No Winners Yet</h2></td></tr>");
  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
  })
  $('.connectedSortable .card-header').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
  })

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges: {
      Today: [moment(), moment()],
      Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function (start, end) {
    // eslint-disable-next-line no-alert
    alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()

  // jvectormap data
  var visitorsData = {
    US: 398, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000 // Russia
  }
  // World map by jvectormap
  $('#world-map').vectorMap({
    map: 'usa_en',
    backgroundColor: 'transparent',
    regionStyle: {
      initial: {
        fill: 'rgba(255, 255, 255, 0.7)',
        'fill-opacity': 1,
        stroke: 'rgba(0,0,0,.2)',
        'stroke-width': 1,
        'stroke-opacity': 1
      }
    },
    series: {
      regions: [{
        values: visitorsData,
        scale: ['#ffffff', '#0154ad'],
        normalizeFunction: 'polynomial'
      }]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] !== 'undefined') {
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors')
      }
    }
  })

  // Sparkline charts
  var sparkline1 = new Sparkline($('#sparkline-1')[0], { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' })
  var sparkline2 = new Sparkline($('#sparkline-2')[0], { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' })
  var sparkline3 = new Sparkline($('#sparkline-3')[0], { width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9' })

  sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021])
  sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921])
  sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21])

  // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

  /* Chart.js Charts */
  // Sales chart
  var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Digital Goods',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label: 'Electronics',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: false,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: [65, 59, 80, 81, 56, 55, 40]
      }
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        }
      }],
      yAxes: [{
        gridLines: {
          display: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesChartData,
    options: salesChartOptions
  })

  // Donut Chart
  var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
  var pieData = {
    labels: [
      'Instore Sales',
      'Download Sales',
      'Mail-Order Sales'
    ],
    datasets: [
      {
        data: [30, 12, 20],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12']
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    },
    maintainAspectRatio: false,
    responsive: true
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

  // Sales graph chart
  var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
    labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
    datasets: [
      {
        label: 'Digital Goods',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#efefef',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#efefef',
        pointBackgroundColor: '#efefef',
        data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#efefef'
        },
        gridLines: {
          display: false,
          color: '#efefef',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 5000,
          fontColor: '#efefef'
        },
        gridLines: {
          display: true,
          color: '#efefef',
          drawBorder: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
  })


  // $("#drawNumber").prop('disabled', true);       

})

// var Toast = Swal.mixin({
//   toast: true,
//   position: 'top',
//   showConfirmButton: false,
//   timer: 3000
// });

var approvedRequest = async function(ids,datas,isApproved) {
  console.log('data ids:' + ids);
  console.log('data isApproved:' + isApproved);
  
  let stats = 'DECLINE';
  if(isApproved)
  stats = 'SENT';
if(datas.balance < datas.cash && isApproved == true){
  Swal.fire('Not enought Balance!', '', 'warning')
}
else {
  Swal.fire({
    title: 'Do you want to '+ stats +' the load?',
    showDenyButton: false,
    showCancelButton: true,
    confirmButtonText: 'Proceed',
    denyButtonText: `Cancel`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      saveData(ids,datas,isApproved);
    } else if (result.isDenied) {
      Swal.fire('Changes are not saved', '', 'info')
    }
  })

}
    
  };


  var saveData = async function(ids,datas,isApproved) {
    
    let status = 'declined';
    if(isApproved)
      status = 'sent'
    
    // let sdatas = JSON.stringify(datas); 
    console.log('status: ' + status);
    $.ajax({
      type:"post",
      dataType: "json",
      data:{
        ids: ids,
        loader_id: datas.admin_id,
        code: datas.code,
        user_id: datas.user_id,
        cash: datas.cash,
        ref_no: datas.ref_no,
        cash_in_type: datas.cash_in_type,
        status: status
      },
      url: api + "userCashInReq/",
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
      }
      
   });



      
};



var approvedWithDrawRequest = async function(ids,datas,isApproved) {
  console.log('data ids:' + ids);
  console.log('data isApproved:' + isApproved);
  
    Swal.fire({
      title: 'Do you want to save?',
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: 'Proceed',
      denyButtonText: `Cancel`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        saveWithdraw(ids,datas,isApproved);
      } else if (result.isDenied) {
        Swal.fire('Changes are not saved', '', 'info')
      }
    })
  
  };

  var saveWithdraw = async function(ids,datas,isApproved) {
    
    let status = 'declined';
    if(isApproved)
      status = 'sent';
    
    // let sdatas = JSON.stringify(datas); 
    console.log('datas: ' + datas.cash);
    $.ajax({
      type:"post",
      dataType: "json",
      data:{
        ids: ids,
        updator_id: datas.admin_id,
        user_id: datas.user_id,
        account_name: datas.account_name,
        account_number: datas.account_number,
        cash: datas.cash,
        cash_out_type: datas.cash_out_type,
        status: status
      },
      url:"http://bolaswerte.bolaswerte.com/api/withDraw/",
      success:function(res)
      {
        Swal.fire('Saved!', '', 'success')
        setTimeout(function(){ location.reload(); }, 2000);// 2seconds
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

var testApi = async function(){
  console.log('pasok api');
  // const userAction = async () => {
  //   const response = await fetch('http://bolaswerte.bolaswerte.com/api/getPreviousResult');
  //   const myJson = await response.json(); //extract JSON from the http response
  //   console.log('data myJson:' + myJson);
  //   // do something with myJson

  //   return myJson;
var userId = 21;
    $.ajax({
      type:"GET",
      dataType: "json",
      data:{},
      url:"http://bolaswerte.bolaswerte.com/api/getUserTotalCash/21",
      success:function(res)
      {
          alert('Get Success');
          const myJson = res.data;
          const textres = res.data;
          console.log('res: ' + myJson);
          console.log('res: ' + textres.total_cash);
      }
   });



  
 
};

$('#btnSigninAdmin').on('click', function() {
  console.log("pasok");
  var uname = $('#uname').val();
  var upass = $('#upass').val();
  var weHaveSuccess = false;
  var emptFields = false;

  if(uname == "" || upass == "")
      emptFields = true;

    $.ajax({
        type: "POST",
        url: "login_user.php",
        dataType:"text",
        data: {
          uname: uname,
          upass: upass
        },
        cache: false,
        success: function(dataResult){
                console.log("dataResult:" + dataResult);
                if(dataResult === "success")
                {
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

$('#btnWinSubmit').on('click', function() {
  console.log("winner");
  var win_nums = $('#winningNumbers').val();
  var draw_no = $('#drawNumber').val();
  var admin_pass = $('#admin_pass').val();
  var admin_id = $('#admin_id').val();

  Swal.fire({
    title: 'Enter admin password to confirm',
    input: 'password',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Confirm',
    showLoaderOnConfirm: true,
    preConfirm: (login) => {
      if(admin_pass === login){
        

        postWinningNumbers(win_nums,draw_no,admin_id);
      }
      else {
        Swal.fire(
          'Incorrect Password',
          '',
          'error'
        )
      }
      
    },
    allowOutsideClick: () => !Swal.isLoading()
  }).then((result) => {
    
  })
  

}); 

var winners = [];

$('#loadWinnersBtn').on('click', function() {
  var win_nums = $('#winningNumbers').val();
  var draw_no = $('#drawNumber').val();
  // let sdatas = JSON.stringify(datas); 
  console.log('win_nums: ' + win_nums);
 if(win_nums != ''){
      $.ajax({
        type:"post",
        dataType: "json",
        data:{
          win_nums: win_nums,
          draw_no: draw_no
        },
        url:"backend/Winners_draw.php",
        success:function(res)
        {
          // const resjson = JSON.stringify(res);
          console.log('res: ' + res);
          winners = res;
          var tr = '';
          var total_amount = 0;
          var total_prize_amount = 0;
          if(res != ''){
            Object.entries(res).forEach(([key, value]) => {
              console.log(key, value) // "someKey" "some value", "hello" "world", "js javascript foreach object"
              
              for (var prop in value) {
                      // skip loop if the property is from prototype
                tr += "<tr>";
                      // your code
                      // console.log(prop + " = " + value[prop]);
                      if(value[prop].category  == '3ds')
                          tr += "<td> <span class='badge badge-success'>" + value[prop].category + "<span></td>";
                      else if(value[prop].category  == '3dr')
                          tr += "<td> <span class='badge badge-secondary'>" + value[prop].category + "<span></td>";    
                      else if(value[prop].category  == '2d')
                          tr += "<td> <span class='badge badge-warning'>" + value[prop].category + "<span></td>";
                      else
                        tr += "<td> <span class='badge badge-danger'>" + value[prop].category + "<span></td>";  
      
                tr += "<td>" + value[prop].user_id + "</td>" +
                      "<td>" + value[prop].bet_id + "</td>" +
                      "<td>" + value[prop].digit + "</td>" +
                      "<td>" + value[prop].draw_id + "</td>" +
                      "<td>" + value[prop].amount + "</td>" +
                      "<td>" + value[prop].prize_amount + "</td>";
                
                tr += "</tr>";
                total_amount += parseFloat(value[prop].amount);
                total_prize_amount += parseFloat(value[prop].prize_amount);
                }
              
            })
            tr += "<tr><td colspan='5'><strong>TOTAL: </strong></td>" + 
                      "<td><strong>" + total_amount.toFixed(2) + "</strong></td>" +
                      "<td><strong>" + total_prize_amount.toFixed(2) +"</strong></td></tr>";
      
            $("#winnerData").html(tr);

            // getTotalAmountBets(win_nums,draw_no);
          }
          else {
            $("#winnerData").html("<tr><td colspan='6'><h2 align='center'>No Winners</h2></td></tr>");
          }
          
          // $("#winnerData").html("<tr><td colspan='6'>" +
          // "<h2 align='center'>No Winners Yet</h2></td></tr>");
          
        },
        error : function(result, statut, error){ // Handle errors
          console.log('result: ' + result.responseText);
          // let myJson = JSON.stringify(result);
          // console.log('result: ' + myJson);
        }
        
    });
 }
 else {
  Swal.fire('No Winning Numbers Inputted!', '', 'error')
 }
  

}); 

var postWinningNumbers = async function(win_nums, draw_no,admin_id) {
  
  // let sdatas = JSON.stringify(datas); 
  // console.log('winners: ' + winners);
  console.log('admin_id: ' + admin_id);
  
  $.ajax({
    type:"post",
    dataType: "json",
    data:{
      admin_id: admin_id,
      win_nums: win_nums,
      draw_no: draw_no,
      winners: JSON.stringify(winners)
    },
    url:"http://bolaswerte.bolaswerte.com/api/generateTodaysDraw/",
    success:function(res)
    {
      console.log('win id: ' + res.data);
      let winid = res.data;
      getTotalAmountBets(win_nums,draw_no,winid);
     
    },
    error : function(result, statut, error){ // Handle errors
      console.log('result: ' + result.responseText);
      // let myJson = JSON.stringify(result);
      // console.log('result: ' + myJson);
    }
    
 });

};


var getTotalAmountBets =  function(win_nums,draw_id,winid) {
  // $('#bet_table').html('');
 
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
             getStatistics(res,win_nums,draw_id,winid);
            // console.log('percentage: ' + perc + '%');
          
          
      },
     
     
  })

};


var getStatistics =  function(total_bets,win_num,draw_no,winid) {
  var admin_bal = $('#admin_bal').val();
  var loader_bal = $('#loader_bal').val();
  var bettor_bal = $('#bettor_bal').val();
  var game_bal = $('#game_bal').val();

  console.log('win_nums: ' + win_num);
  console.log('draw_id: ' + draw_no);
  $.ajax({
  type:'post',
  url: 'backend/primary.php',
  data : {
    drawNum: draw_no
  },
  success : function(res){
      // console.log("total: " + res);

        let digits = win_num;
        let draw_id = draw_no;
        let total_person_earning  = 0;
        let total_residual_earning  = 0;
        let total_straight = 0;
        let total_rumble = 0;
        let total_twoD = 0;
        let total_oneD = 0;
        let total_straight_prize = 0;
        let total_rumble_prize = 0;
        let total_twoD_prize = 0;
        let total_oneD_prize = 0;
        let total_payouts = 0;
        let subtotal = 0;
        let total_earnings = 0;
        let loader = 0;
        let investor = 0;
        if(res){
              let jsonres = JSON.parse(res);
              Object.entries(jsonres).forEach(([key, value]) => {

                if(win_num == value.digit) {
                  total_person_earning = value.total_person_earning;
                  total_residual_earning = value.total_residual_earning;
                 
                  total_straight = value.total_amount;
                  total_rumble = value.total_ramble_bet;
                  total_twoD = value.total_twoD_bet;
                  total_oneD = value.total_oneD_bet;
  
                  total_straight_prize = parseFloat(total_straight) * 500;
                  total_rumble_prize = parseFloat(total_rumble) * 80;
                  total_twoD_prize = parseFloat(total_twoD) * 50;
                  total_oneD_prize = parseFloat(total_oneD) * 5;

                  total_payouts = total_straight_prize + total_rumble_prize + total_twoD_prize + total_oneD_prize;

                  subtotal = parseFloat(total_bets) - parseFloat(total_payouts);
                  // let total_payouts = parseFloat(value.total_payout) + parseFloat(value.total_ramble) + parseFloat(value.total_twoD) + parseFloat(value.total_oneD);
                  loader = parseFloat(subtotal) * 0.1;
                  investor = parseFloat(subtotal) * 0.1;
                  let deduc = loader + investor + parseFloat(total_person_earning) + parseFloat(total_residual_earning);
                  total_earnings = parseFloat(subtotal) - deduc;
                  console.log("total_bets: " + total_bets);
                  console.log("total_payouts: " + total_payouts);
                  console.log("subtotal: " + subtotal);
                  console.log("total_person_earning: " + total_person_earning);
                  console.log("total_residual_earning: " + total_residual_earning);
                  console.log("loader: " + loader);
                  console.log("investor: " + investor);
                  console.log("total_earnings: " + total_earnings);

              
                }
                

              })

              let tally = {
                win_id: winid,
                digits: digits,
                draw_id: draw_id,
                admin_bal: admin_bal,
                loader_bal: loader_bal,
                bettor_bal: bettor_bal,
                game_bal: game_bal,
                total_person_earning: total_person_earning,
                total_residual_earning: total_residual_earning,
                total_straight: total_straight,
                total_rumble: total_rumble,
                total_twoD: total_twoD,
                total_oneD: total_oneD,
                total_straight_prize: total_straight_prize,
                total_rumble_prize: total_rumble_prize,
                total_twoD_prize: total_twoD_prize,
                total_oneD_prize: total_oneD_prize,
                total_bets: total_bets,
                total_payouts: total_payouts,
                subtotal: subtotal,
                loader:loader,
                investor: investor,
                total_earnings: total_earnings


              };
              saveTally(tally);
              // console.log("total_earnings: " + total_earnings);
              // console.log("total_earnings: " + total_earnings);
        }
      
  },
 
 
})

};


var saveTally =  async function(tally) {

        $.ajax({
        type:'post',
        data : {
          win_id: tally.win_id,
          digits: tally.digits,
          draw_id: tally.draw_id,
          admin_balance: tally.admin_bal,
          loaders_balance: tally.loader_bal,
          bettors_balance: tally.bettor_bal,
          game_balance: tally.game_bal,
          personal_earnings: tally.total_person_earning,
          residual_earnings: tally.total_residual_earning,
          straight_bets: tally.total_straight,
          rumble_bets: tally.total_rumble,
          twod_bets: tally.total_twoD,
          oned_bets: tally.total_oneD,
          straight_total: tally.total_straight_prize,
          rumble_total: tally.total_rumble_prize,
          twod_total: tally.total_twoD_prize,
          oned_total: tally.total_oneD_prize,
          total_bets: tally.total_bets,
          total_payouts: tally.total_payouts,
          sub_total: tally.subtotal,
          loader: tally.loader,
          investor: tally.investor,
          total_earnings: tally.total_earnings
        },
        url: 'http://bolaswerte.bolaswerte.com/api/generateTallyReport',
        success : function(res){
          Swal.fire(
            'Winning Numbers Posted',
            'This numbers posted!',
            'success'
          )

           setTimeout(function(){ location.reload(); }, 4000);// 2seconds
      
    
            
        },
        error : function(result, statut, error){ // Handle errors
          console.log('result: ' + result.responseText);
          'Error Occured',
          '',
          'error'
        }
       
       
    })
  
    // return perc;
   
  
 
};