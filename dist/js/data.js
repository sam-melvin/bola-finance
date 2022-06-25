$(function () {



    var openModal = function(val) {
                    console.log("val" + val);
                    let ids = val;
                    $('#bet_table').html('');
                    $.ajax({
                    type:'post',
                    url: 'getbets.php',
                    data : {ids: ids},
                    success : function(data){
                        $('#bet_table').html(data);
                    }

                    })
                };
                openModal();

                var openModalD2 = function(val) {
                    console.log("val" + val);
                    let ids = val;
                    $('#bet2_table').html('');
                    $.ajax({
                    type:'post',
                    url: 'getdigits2.php',
                    data : {ids: ids},
                    success : function(data){
                        $('#bet2_table').html(data);
                    }

                    })
                };
                openModalD2();


                var openModalD1 = function(val) {
                    console.log("val" + val);
                    let ids = val;
                    $('#bet1_table').html('');
                    $.ajax({
                    type:'post',
                    url: 'getdigit1.php',
                    data : {ids: ids},
                    success : function(data){
                        $('#bet1_table').html(data);
                    }

                    })
                };
                openModalD1();

});