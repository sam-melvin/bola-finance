<?php


?>
<style> 
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

  .shareBtn{
  outline: none;
  cursor: pointer;
  font-weight: 500;
  border-radius: 4px;
  border: 2px solid transparent;
  transition: background 0.1s linear, border-color 0.1s linear, color 0.1s linear;
}



.popup :is(header, .icons, .field){
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.popup header{
  padding-bottom: 15px;
  border-bottom: 1px solid #ebedf9;
}
header span{
  font-size: 21px;
  font-weight: 600;
}
header .close, .icons a{
  display: flex;
  align-items: center;
  border-radius: 50%;
  justify-content: center;
  transition: all 0.3s ease-in-out;
}
header .close{
  color: #878787;
  font-size: 17px;
  background: #f2f3fb;
  height: 33px;
  width: 33px;
  cursor: pointer;
}
header .close:hover{
  background: #ebedf9;
}
.popup .content{
  margin: 20px 0;
}
.popup .icons{
  margin: 15px 0 20px 0;
}
.content p{
  font-size: 16px;
}
.content .icons a{
  height: 50px;
  width: 50px;
  font-size: 20px;
  text-decoration: none;
  border: 1px solid transparent;
}
.icons a i{
  transition: transform 0.3s ease-in-out;
}
.icons a:nth-child(1){
  color: #1877F2;
  border-color: #b7d4fb;
}
.icons a:nth-child(1):hover{
  background: #1877F2;
}
.icons a:nth-child(2){
  color: #46C1F6;
  border-color: #b6e7fc;
}
.icons a:nth-child(2):hover{
  background: #46C1F6;
}
.icons a:nth-child(3){
  color: #e1306c;
  border-color: #f5bccf;
}
.icons a:nth-child(3):hover{
  background: #e1306c;
}
.icons a:nth-child(4){
  color: #25D366;
  border-color: #bef4d2;
}
.icons a:nth-child(4):hover{
  background: #25D366;
}
.icons a:nth-child(5){
  color: #0088cc;
  border-color: #b3e6ff;
}
.icons a:nth-child(5):hover{
  background: #0088cc;
}
.icons a:hover{
  color: #fff;
  border-color: transparent;
}
.icons a:hover i{
  transform: scale(1.2);
}
.content .field{
  margin: 12px 0 -5px 0;
  height: 45px;
  border-radius: 4px;
  padding: 0 5px;
  border: 1px solid #e1e1e1;
}
.field.active{
  border-color: #7d2ae8;
}
.field i{
  width: 50px;
  font-size: 18px;
  text-align: center;
}
.field.active i{
  color: #7d2ae8;
}
.field input{
  width: 100%;
  height: 100%;
  border: none;
  outline: none;
  font-size: 15px;
}
.field button{
  color: #fff;
  padding: 5px 18px;
  background: #7d2ae8;
}
.field button:hover{
  background: #8d39fa;
}

</style>
<div class="modal fade" id="modal-password">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body" id="up_formdiv">
                    <!-- dynamic data here -->
                    
                    <div class="form-group">
                        <label for="upass">New Password:</label>
                        <input type="password" class="form-control" id="upass" name="upass"  required placeholder="Password">
                        
                    </div>
                    <div class="form-group">
                        <label for="phone">Confirm Password:</label>
                        
                        <input type="password" class="form-control" id="rpass" name="rpass"  required placeholder="Confirm Password">
                        <label class="col-form-label text-danger" for="inputError" id="passMatchErr"><i class="far fa-times-circle"></i> Password not match!</label>
                      <label class="col-form-label text-danger" for="inputError" id="passEmptyErr"><i class="far fa-times-circle"></i> Some fields is empty!</label>
                    </div>

                    <!-- <div class="form-group">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                      error</label>
                    <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
                    
                  </div> -->
                </div>
                <!-- /.card-body -->

                <!-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveNewPass(<?= $ids ?>)">Save changes</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

</div>
   <div class="modal fade popup" id="modal-share">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Share Code</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body content">
              <!-- general form elements -->
            
                <div class="popup" >
                    <!-- dynamic data here -->

                    <strong>Your Code: </strong>
                    <div class="input-group mb-3">
                      <!-- /btn-group -->
                      <?php if($_SESSION[SESSION_TYPE] == 3) ?>
                      <input type="text" class="form-control" id="codeCopy" readonly value="<?= $loggedUser->code ?>">
                      <div class="input-group-prepend">
                      
                        <button type="button" class="btn btn-primary" id="copybtn">Copy</button>
                      </div>
                    </div>


                    <!-- <div class="field">
                      <i class="url-icon uil uil-link"></i>
                      <input type="text" readonly value="bola_samtester">
                      <button>Copy</button>
                  </div> -->
                  <p>&nbsp;</p>
                    <p>Share this link via</p>
                    <ul class="icons">
                      <a href="#" data-share="facebook" data-width="800" data-height="600" data-title="Bola Swerte" data-quote="Bola Swerte" data-description="Bola Swerte" data-hashtag="#bola" data-url="http://new.bolaswerte.com/" class="shareBtn"><i class="fab fa-facebook-f"></i></a>
                      <a href="#" data-share="messenger" data-width="800" data-height="600" data-title="Bola Swerte" data-quote="Bola Swerte" data-description="Bola Swerte" data-hashtag="#bola" data-url="http://new.bolaswerte.com/" data-redirect="http://new.bolaswerte.com/" class="shareBtn"><i class="fa-brands fa-facebook-messenger"></i></a>
                      <a href="#"  data-share="twitter" data-width="800" data-height="600" data-title="Bola Swerte" data-hashtags="#bola" data-via="Bola Swerte Share" data-url="http://new.bolaswerte.com/" class="shareBtn"><i class="fab fa-twitter"></i></a>
                      <!-- <a href="#" class="shareBtn"><i class="fab fa-instagram"></i></a> -->
                      <a href="#" data-share="whatsapp" data-title="Bola Swerte" data-url="http://new.bolaswerte.com/" class="shareBtn"><i class="fab fa-whatsapp"></i></a>
                      <a href="#" data-share="email" data-title="Bola Swerte" data-url="http://new.bolaswerte.com/" data-subject="Bola Swerte" class="shareBtn"><i class="fa-solid fa-envelope"></i></a>
                     
                    </ul>

                </div>
                <!-- /.card-body -->

                <!-- <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



      