$(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const keyid = urlParams.get('id');
    // localStorage.getItem("lastname");
    console.log('keyid: ' + keyid );

    let total_straight = localStorage.getItem("total_straightWin"+keyid);
    let total_rumble = localStorage.getItem("total_rumbleWin"+keyid);
    let total_twoD = localStorage.getItem("total_TwoDWin"+keyid);
    let total_oneD = localStorage.getItem("total_OneDWin"+keyid);
    let total_bets = localStorage.getItem("total_bets"+keyid);
    let total_person_earning = localStorage.getItem("total_person_earning"+keyid);
    let total_residual_earning = localStorage.getItem("total_residual_earning"+keyid);
    console.log('total_straight: ' + total_straight);
    $('#total_straight').html('&#8369; ' + parseFloat(total_straight).toFixed(2));
    $('#total_rumble').html('&#8369; ' + parseFloat(total_rumble).toFixed(2));
    $('#total_twoD').html('&#8369; ' + parseFloat(total_twoD).toFixed(2));
    $('#total_oneD').html('&#8369; ' + parseFloat(total_oneD).toFixed(2));
    $('#totalBets').html('&#8369; ' + parseFloat(total_bets).toFixed(2));
    // $('#total_3dStraight').html('&#8369; ' + total_straight);

    let straightPrize = parseFloat(total_straight) * 500;
    let rumblePrize = parseFloat(total_rumble) * 80;
    let twoDPrize = parseFloat(total_twoD) * 50;
    let oneDPrize = parseFloat(total_oneD) * 5;

    $('#straightPrize').html('&#8369; ' + straightPrize.toFixed(2));
    $('#rumblePrize').html('&#8369; ' + rumblePrize.toFixed(2));
    $('#twoDPrize').html('&#8369; ' + twoDPrize.toFixed(2));
    $('#oneDPrize').html('&#8369; ' + oneDPrize.toFixed(2));

    
    let subtotal = straightPrize + rumblePrize + twoDPrize + oneDPrize;
    let earnings = parseFloat(total_bets) - parseFloat(subtotal);
    let investPerc = earnings * 0.1;
    let loaderPerc = earnings * 0.1;
    $('#subtotal').html('<strong>&#8369; ' + subtotal.toFixed(2) + '</strong>');
    $('#total_payout').html('&#8369; ' + subtotal.toFixed(2) + '');
    $('#earnings').html('&#8369; ' + earnings.toFixed(2) + '');

    $('#pers_earning').html('&#8369; ' + parseFloat(total_person_earning).toFixed(2));
    $('#resid_earning').html('&#8369; ' + parseFloat(total_residual_earning).toFixed(2));
    $('#invest_perc').html('&#8369; ' + investPerc.toFixed(2));
    $('#loader_perc').html('&#8369; ' + loaderPerc.toFixed(2));
    let total_earnings = earnings - investPerc - loaderPerc - parseFloat(total_person_earning) - parseFloat(total_residual_earning);
    $('#total_earn').html('&#8369; ' + total_earnings.toFixed(2));
  })