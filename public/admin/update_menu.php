<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(isset($_POST['submit'])) {
    if(empty($_POST['d_name']) || empty($_POST['about']) || $_POST['price']=='' || $_POST['res_name']=='') {	
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>All fields must be filled up!</strong>
                  </div>';
    } else {
        $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.', $fname);
        $extension = strtolower(end($extension));  
        $fnew = uniqid().'.'.$extension;
        $store = "Res_img/dishes/".basename($fnew);                     

        if($fname != '') {
            // --- may bagong image ---
            if($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {        
                if($fsize >= 1000000) {
                    $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Max Image Size is 1024kb!</strong> Try different Image.
                              </div>';
                } else {
                    $sql = "UPDATE dishes SET 
                                rs_id='$_POST[res_name]',
                                title='$_POST[d_name]',
                                slogan='$_POST[about]',
                                price='$_POST[price]',
                                img='$fnew'
                            WHERE d_id='$_GET[menu_upd]'";
                    mysqli_query($db, $sql); 
                    move_uploaded_file($temp, $store);
                    $success = '<div class="alert alert-success alert-dismissible fade show">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                  <strong>Record Updated!</strong>
                                </div>';
                }
            }
        } else {
            // --- walang bagong image ---
            $sql = "UPDATE dishes SET 
                        rs_id='$_POST[res_name]',
                        title='$_POST[d_name]',
                        slogan='$_POST[about]',
                        price='$_POST[price]'
                    WHERE d_id='$_GET[menu_upd]'";
            mysqli_query($db, $sql); 
            $success = '<div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <strong>Record Updated!</strong>
                        </div>';
        }
    }
}
?>

<head>
    <meta charset="utf-8">
    <title>Update Menu</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">
    <div id="main-wrapper">
        <div class="page-wrapper">
            <div class="container-fluid">

                <?php echo $error; echo $success; ?>

                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Update Menu</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <?php  
                                    $qml ="SELECT * FROM dishes WHERE d_id='$_GET[menu_upd]'";
                                    $rest=mysqli_query($db, $qml); 
                                    $roww=mysqli_fetch_array($rest);
                                    ?>
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Dish Name</label>
                                                <input type="text" name="d_name" value="<?php echo $roww['title'];?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">About</label>
                                                <input type="text" name="about" value="<?php echo $roww['slogan'];?>" class="form-control form-control-danger">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Price (₱)</label>
                                                <input type="text" name="price" value="<?php echo $roww['price'];?>" class="form-control" placeholder="₱">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" class="form-control form-control-danger">
                                                <br>
                                                <img src="Res_img/dishes/<?php echo $roww['img'];?>" width="100" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Restaurant</label>
                                                <select name="res_name" class="form-control custom-select">
                                                    <option>--Select Restaurant--</option>
                                                    <?php 
                                                    $ssql ="SELECT * FROM restaurant";
                                                    $res=mysqli_query($db, $ssql); 
                                                    while($row=mysqli_fetch_array($res)) {
                                                        $selected = ($row['rs_id'] == $roww['rs_id']) ? "selected" : "";
                                                        echo '<option value="'.$row['rs_id'].'" '.$selected.'>'.$row['title'].'</option>';
                                                    }  
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                    <a href="all_menu.php" class="btn btn-inverse">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php include "include/footer.php" ?>
        </div>
    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
