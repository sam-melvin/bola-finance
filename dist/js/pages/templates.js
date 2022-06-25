$(function () {
    console.log('template');
    $("#passMatchErr").hide();
    
    $("#passEmptyErr").hide();
    

    
})

var saveNewPass = async function(ids) {
    console.log('data ids:' + ids);
    let upass = $('#upass').val();
    let rpass = $('#rpass').val();
    $("#div1").addClass("important blue");

    if(upass == '' || rpass == ''){
        $("#upass").addClass("form-control is-invalid");
        $("#rpass").addClass("form-control is-invalid");
        $("#passMatchErr").hide();
        $("#passEmptyErr").show();
    }
    else {
        $("#upass").attr('class', 'form-control');
        $("#rpass").attr('class', 'form-control');
        $("#passEmptyErr").hide();

        if(upass == rpass){
            $("#upass").attr('class', 'form-control');
            $("#rpass").attr('class', 'form-control');
            $("#passMatchErr").hide();
            confirmPass(ids);

        }
        else {
            $("#upass").addClass("form-control is-invalid");
            $("#rpass").addClass("form-control is-invalid");
            $("#passMatchErr").show();


        }
    }

    };

    var confirmPass = async function(ids) {

        console.log("save!");
            Swal.fire({
              title: 'Do you want to save the changes?',
              showDenyButton: false,
              showCancelButton: true,
              confirmButtonText: 'Save',
              denyButtonText: `Don't save`,
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                updateNewPass(ids);
              } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
              }
            })
        };


   var updateNewPass = function(ids) {
    console.log('data ids:' + ids);
    let upass = $('#upass').val();
    $('#up_formdiv').html('');
      $.ajax({
      type:'post',
      url: 'updateadmin.php',
      data : {
            ids:ids,
            pass: upass
        },
            success : function(data){
              console.log('data String:' + data);
              Swal.fire('Saved!', '', 'success')
              setTimeout(function(){ location.replace("func/logout.php"); }, 3000);// 2seconds
            }
      })
   };


var openUpdatePass = async function(ids) {
    console.log('data ids:' + ids);
    $('#up_formdiv').html('');
      $.ajax({
      type:'post',
      url: 'getuser.php',
      data : {ids: ids},
            success : function(data){
              console.log('data String:' + data);
            $('#up_formdiv').html(data);
            }
      })
    };

$('#copybtn').on('click', function() {
  // let copyText = $('#codeCopy').val();
  var copyText = document.getElementById("codeCopy");

  var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
  });

  /* Select the text field */
  // copyText.select();
  // copyText.setSelectionRange(0, 99999); /* For mobile devices */

  // /* Copy the text inside the text field */
  // navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  


  if (navigator.clipboard && window.isSecureContext) {
    // navigator clipboard api method'
    $("#codeCopy").addClass("form-control is-valid");

    Toast.fire({
      icon: 'success',
      title: 'Copied to clipboard.'
    })

    return navigator.clipboard.writeText(copyText.value);
  } else {
      // text area method
      // let copyText = document.createElement("#codeCopy");
      // copyText.value = textToCopy;
      // make the textarea out of viewport
      
      console.log('copy else');
      
      let textArea = document.createElement("textarea");
        textArea.value = copyText.value;
        // make the textarea out of viewport
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        Toast.fire({
          icon: 'success',
          title: 'Copied to clipboard.'
        })

        return new Promise((res, rej) => {
            // here the magic happens
            document.execCommand('copy') ? res() : rej();
            textArea.remove();
            $("#codeCopy").addClass("form-control is-valid");
        });
  }
  
});
   