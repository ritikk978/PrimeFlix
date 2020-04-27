<?php include("includes/header.php");

  require("includes/function.php");
  require("language/language.php");
  
  if(isset($_POST['submit']))
  {
    
      $data = array( 
          'name'  =>  $_POST['plan_name'],
          'price'  =>  $_POST['plan_price'],
          'days'  =>  $_POST['plan_days']
          );    

        $edit_status=Update('plans', $data, "WHERE planid = '".$_POST['plan_id']."'");
      
    $_SESSION['msg']="10";
 
    header( "Location:edit_plan.php");
    exit;
   
  } else if(isset($_GET['planid'])) {
      $plan_qry="SELECT * FROM plans where planid=".$_GET['planid'];
      $plan_result=mysqli_query($mysqli,$plan_qry);
  }

?>

<!--Top Menu-->
<div class="row">
    <a href="add_plan.php"><div class="btn btn-primary btn-round" style="margin: 50px"> Add Plan </div></a>
    
    <a href="edit_plan.php"><div class="btn btn-primary btn-round" style="margin: 50px"> Edit Plan </div></a>
    
    <a href="delete_plan.php"><div class="btn btn-primary btn-round" style="margin: 50px"> Delete Plan </div></a>
    
    <a href="view_plan.php"><div class="btn btn-primary btn-round" style="margin: 50px; display:none"> View Plan </div></a>
</div>

<!--Below Grid-->
<div class="row">
      <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                                <h4 class="card-title">Edit Plan</h4>
                            </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
            </div>
          </div>
          <div class="card-body mrg_bottom"> 
            <form action="" name="add_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
 
              <div class="section">
                <div class="section-body">
                  
                  <?php
                  while($plan_row=mysqli_fetch_array($plan_result))
                  {
              ?> 
              
            <div class="form-group">
                    <label class="col-md-3 control-label">Plan ID :-</label>
                    <div class="col-md-6">
                      <input type="text" name="plan_id" id="plan_id" value="<?php echo $plan_row['planid'];?>" class="form-control" readonly="readonly" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Plan Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="plan_name" id="plan_name" value="<?php echo $plan_row['name'];?>" class="form-control" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Plan Price :-</label>
                    <div class="col-md-6">
                      <input type="number" name="plan_price" id="plan_price" value="<?php echo $plan_row['price'];?>" class="form-control" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Plan Days :-</label>
                    <div class="col-md-6">
                      <input type="number" name="plan_days" id="plan_days" value="<?php echo $plan_row['days'];?>" class="form-control" required>
                    </div>
                  </div>
                  
                  <br>
                  <br>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary btn-round">Edit</button>
                    </div>
                  </div>
                  
                  <?php
                }
              ?>
                        
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <?php include("includes/footer.php");?>  