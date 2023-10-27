
<?php  

// Connect to the Database 
include('config.php');

$insert = false;
$update = false;
$empty = false;
$delete = false;
$already_card = false;


if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `crd` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['snoEdit'])){
      // Update the record
        $sno = $_POST["snoEdit"];
        $name = $_POST["nameEdit"];
        $company = $_POST["companyEdit"];
        $id = $_POST["idEdit"];
        $nsticker = $_POST["nstickerEdit"];
        $ct = $_POST["ctEdit"];
        $nplate = $_POST["nplateEdit"];
        $vc = $_POST["vcEdit"];
        $vm = $_POST["vmEdit"];
        $drp = $_POST["drpEdit"];
        $drlexp_date = $_POST["drlexpEdit"];
        $exp_date = $_POST["expEdit"];

      // Sql query to be executed
      $sql = "UPDATE `crd` SET `name` = '$name' , `company` = '$company' ,`id` = '$id' , `nsticker` = '$nsticker' , `ct` = '$ct', `nplate` = '$nplate', `vc` = '$vc', `vm` = '$vm', `drp` = '$drp', `drlexp_date` = '$drlexp_date', `exp_date` = '$exp_date' WHERE `crd`.`sno` = $sno";
      $result = mysqli_query($conn, $sql);
      if($result){
        $update = true;
    }
    else{
        echo "The Record Update Unsuccessfully";
    }
}
else{
  $name = $_POST["name"];
  $id = $_POST["id"];
  $company = $_POST["company"];
  $nsticker = $_POST["nsticker"];
  $ct = $_POST["ct"];
  $nplate = $_POST["nplate"];
  $vc = $_POST["vc"];
  $vm = $_POST["vm"];
  $drp = $_POST["drp"];
  $drlexp_date = $_POST["drlexp_date"];
  $exp_date = $_POST["exp_date"];

    if($name == '' || $id == ''){
        $empty = true;
    }
    else{
        //Check that Card N°. is Already Registered or Not.
        $querry = mysqli_query($conn, "SELECT * FROM crd WHERE id= '$id' ");
        if(mysqli_num_rows($querry)>0)
        {
             $already_card = true;
        }
        else{

          // image upload 
          $uploaddir = 'assets/uploads/';
          $uploadfile = $uploaddir . basename($_FILES['image']['name']);

      
          if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
              
          } else {
              echo "Possible File Uploaded Attack!\n";
          }

  // Sql query to be executed
  $sql = "INSERT INTO `crd`(`name`, `id`, `company`, `nsticker`, `ct`, `nplate`, `vc`, `vm`, `drp`, `drlexp_date`, `exp_date`, `image`) VALUES ('$name','$id','$company','$nsticker','$ct','$nplate','$vc','$vm','$drp','$drlexp_date','$exp_date','$uploadfile')"; 

  // $sql = "INSERT INTO `cards` (`name`, `id_no`) VALUES ('$name', '$id_no')";
  $result = mysqli_query($conn, $sql);



   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The Record Not Inserted Successfully --> ". mysqli_error($conn);
  } 
}
}
}

 }
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- QR Code Generator -->

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" type="image/png" href="images/favicon.png"/>
  <title>Add New Sticker | HSSE-MS</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
</head>
<style>
body
    {
      font-family:'arial';
      background-image: url("./assets/images/ksp1.jpg");
      background-color: grey;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
   .navbar-brand
    {
        height:58px;
        width:150px;
    }
    img
    {
     max-width: 100%;
     max-height: 100%;
    }

    .myTable
    {
      position: center;
    }

    label
    {
      color:goldenrod;
    }
   </style>
<body>
 
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit This Car Sticker</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="name">Driver Full Name</label>
              <input type="text" class="form-control" id="nameEdit" name="nameEdit">
            </div>

            <div class="form-group">
              <label for="id">ID/ IQAMA N°</label>
              <input type="text" class="form-control" id="idEdit" name="idEdit">
            </div>

            <div class="form-group col-md-2">
        <label for="inputType">Company Name</label>
        <select name="companyEdit" class="form-control" value="<?php echo $company;?>">
          <option selected>Select Company</option>
          <option value="MBL">MBL</option>
          <option value="MBL-CD">MBL-CD</option>
          <option value="MBL-FG1">MBL-FG1</option>
          <option value="MBL-FG2">MBL-FG2</option>
          <option value="Al Mahdoud">Al Mahdoud</option>
          <option value="Signals-Control">Signals-Control</option>
          <option value="Huta">Huta</option>
          <option value="MGL">MGL</option>
          <option value="Kone">Kone</option>
          <option value="ICAD">ICAD</option>
          <option value="First-Fix">First-Fix</option>
          <option value="AIC">AIC</option>
          <option value="Scaffolding">Scaffolding</option>
          <option value="Fire-Proofing">Fire-Proofing</option>
          <option value="Cranes">Cranes</option>
          <option value="Wsp">WSP</option>
          <option value="Al-Aliaa">Al-Aliaa</option>
        </select>
      </div>

            <div class="form-group">
              <label for="nsticker">Sticker N°</label>
              <input class="form-control" id="nstickerEdit" name="nstickerEdit" rows="3"></input>
            </div>

            <div class="form-group">
              <label for="cartype">Car Type</label>
        <select name="ctEdit" class="form-control" value="<?php echo $ct;?>">
          <option selected>Select Car Type ..</option>
          <option value="	SUV	">	SUV	</option>
          <option value="	Station Wagon ">	Station Wagon	</option>
          <option value="	Mini-Van ">	Mini-Van	</option>
          <option value="	Sedan ">	Sedan	</option>
          <option value="	Sports Car ">	Sports Car	</option>
          <option value="	Van ">	Van	</option>
          <option value="	Bus ">	Bus	</option>
          <option value="	Pick-Up ">	Pick-Up	</option>
          <option value="	Truck ">	Truck	</option>
          <option value="	Mini-Truck ">	Mini-Truck	</option>
          <option value="	Big-Truck ">	Big-Truck	</option>
          <option value="	Camper-Van ">	Camper-Van	</option>
          <option value="	Coaster ">	Coaster	</option>
        </select>
            </div>

            <div class="form-group">
              <label for="nplate">Plate N°</label>
              <input type="text" class="form-control" id="nplateEdit" name="nplateEdit">
            </div>

            <div class="form-group">
              <label for="carcolor">Vehicule Color</label>
              <select name="vcEdit" class="form-control" value="<?php echo $vc;?>">
                <option selected>Select Car Color ..</option>
                <option value="	Green - أخضر">	Green - أخضر	</option>
                <option value="	Orange - برتقالي ">	Orange - برتقالي	</option>
                <option value="	Blue - أزرق	">	Blue - أزرق	</option>
                <option value="	Yellow - أصفر	">	Yellow - أصفر	</option>
                <option value="	Red - أحمر ">	Red - أحمر </option>
                <option value=" Black - أسود"> Black - أسود </option>
                <option value="	White - أبيض ">	White - أبيض </option>
                <option value="Grey - رمادي"> Grey - رمادي </option>
                <option value="	Brown - بني	 ">	Brown - بني	</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="carmodel">Vehicule Model</label>
              <input class="form-control" id="vmEdit" name="vmEdit" rows="3"></input>
            </div>

            <div class="form-group">
              <label for="mdriver">Driver Phone N°</label>
              <input class="form-control" id="drpEdit" name="drpEdit" rows="3"></input>
            </div>

            <div class="form-group">
              <label for="expdl">Driving Licence Expire Date</label>
              <input type="date" class="form-control" id="drlexpEdit" name="drlexpEdit">
              
            </div>
            <div class="form-group">
              <label for="expi">Insurrance Expire Date</label>
              <input type="date" class="form-control" id="exp_dateEdit" name="exp_dateEdit">
            </div>

        <div class="form-group">
          <label for="photo">Picture</label>
          <input type="file" name="image" />
        </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- Navigation bar start  -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-image: linear-gradient(to left , rgb(65, 105, 225), rgb(129, 133, 137));">
  <a class="navbar-brand" href="#"><img src="assets/images/MBL.png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost/Card/">Home<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a href="download.php"> Don</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="navbar-brand" href="http://localhost/Card/"><img src="assets/images/KSPP.PNG" alt=""></a>
    </form>
  </div>
</nav>
<!-- Navigation bar end  -->

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>Sticker Inserted Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>Sticker Deleted Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>Sticker Updated Successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
   <?php
  if($empty){
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Error!</strong> The Fields Cannot Be Empty! Please Insert Values.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
     <?php
  if($already_card){
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Error!</strong> This Sticker Already Exist.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  							<?php
							$name = "CHABANA Mohamed Amin";
              $id = "ID/ IQAMA Number";
							$company = "MBL";
							$nsticker = "Sticker Number";
              $ct = "Sedan";
              $nplate = "1234 | أ ب ت";
              $vc = "Grey - رمادي";
              $vm = "Volkswagen Gulf";
              $drp = "0 51 234 5678";
							$drlexp_date = "10/10/2023";
              $exp_date = "01/01/2023";
							$qr = "";

							if (isset($_POST["btnsubmit"])) {
									$name = $_POST["name"];
                  $id = $_POST["id"];
                  $company = $_POST["company"];
									$sticker = $_POST["nsticker"];
									$ct = $_POST["ct"];
									$nplate = $_POST["nplate"];
                  $vc = $_POST["vc"];
									$vm = $_POST["vm"];
									$drp = $_POST["drp"];
                  $drlexp_date = $_POST["drlexp_date"];
                  $exp_date = $_POST["exp_date"];
                  

									/*echo "<pre>";
                                    var_dump($_POST);
                                    echo "</pre>";*/
							}
							?>

  <div class="container my-4">
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  <i class="fa fa-plus"></i> Add New Car Sticker
  </button>
  
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body">

    <form method="POST" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="name">Driver Full Name</label>
        <input type="text" name="name" class="form-control" id="name" value="<?php echo $name;?>">
      </div>
      <div class="form-group col-md-4">
        <label for="id">ID/ IQAMA N°</label>
        <input type="text" name="id" class="form-control" id="id" value="<?php echo $id;?>">
      </div>
      <div class="form-group col-md-2">
        <label for="inputCompany">Company Name</label>
        <select name="company" class="form-control" value="<?php echo $company;?>">
          <option selected>Select Company ..</option>
          <option value="MBL">MBL</option>
          <option value="MBL-CD">MBL-CD</option>
          <option value="MBL-FG1">MBL-FG1</option>
          <option value="MBL-FG2">MBL-FG2</option>
          <option value="Al Mahdoud">Al Mahdoud</option>
          <option value="Signals-Control">Signals-Control</option>
          <option value="Huta">Huta</option>
          <option value="MGL">MGL</option>
          <option value="Kone">Kone</option>
          <option value="ICAD">ICAD</option>
          <option value="First-Fix">First-Fix</option>
          <option value="AIC">AIC</option>
          <option value="Scaffolding">Scaffolding</option>
          <option value="Fire-Proofing">Fire-Proofing</option>
          <option value="Cranes">Cranes</option>
          <option value="Wsp">WSP</option>
          <option value="Al-Aliaa">Al-Aliaa</option>
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="nticker">Sticker N°</label>
        <input type="text" name="nsticker" class="form-control" id="nsticker" value="<?php echo $nsticker;?>">
      </div>
      <div class="form-group col-md-4">
        <label for="ct">Car Type</label>
        <select name="ct" class="form-control" value="<?php echo $ct;?>">
          <option selected>Select Car Type ..</option>
          <option value="	SUV	">	SUV	</option>
          <option value="	Station Wagon ">	Station Wagon	</option>
          <option value="	Mini-Van ">	Mini-Van	</option>
          <option value="	Sedan ">	Sedan	</option>
          <option value="	Sports Car ">	Sports Car	</option>
          <option value="	Van ">	Van	</option>
          <option value="	Bus ">	Bus	</option>
          <option value="	Pick-Up ">	Pick-Up	</option>
          <option value="	Truck ">	Truck	</option>
          <option value="	Mini-Truck ">	Mini-Truck	</option>
          <option value="	Big-Truck ">	Big-Truck	</option>
          <option value="	Camper-Van ">	Camper-Van	</option>
          <option value="	Coaster ">	Coaster	</option>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label for="nplate">Plate N°</label>
        <input type="text" name="nplate" class="form-control" id="nplate" value="<?php echo $nplate;?>">
      </div>

      <div class="form-group col-md-4">
        <label for="vc">Vehicule Color</label>
        <select name="vc" class="form-control" value="<?php echo $vc;?>">
          <option selected>Select Car Color ..</option>
          <option value="	Green - أخضر">	Green - أخضر	</option>
          <option value="	Orange - برتقالي ">	Orange - برتقالي	</option>
          <option value="	Blue - أزرق	">	Blue - أزرق	</option>
          <option value="	Yellow - أصفر	">	Yellow - أصفر	</option>
          <option value="	Red - أحمر ">	Red - أحمر </option>
          <option value=" Black - أسود"> Black - أسود </option>
          <option value="	White - أبيض ">	White - أبيض </option>
          <option value="Grey - رمادي"> Grey - رمادي </option>
          <option value="	Brown - بني	 ">	Brown - بني	</option>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label for="vm">Vehicule Model</label>
        <input type="text" name="vm" class="form-control" id="vm" value="<?php echo $vm;?>">
      </div>

      <div class="form-group col-md-4">
        <label for="drp">Driver Phone N°</label>
        <input type="text" name="drp" class="form-control" id="drp" value="<?php echo $drp;?>">
      </div>
    </div>
    <div class="form-row">
    </div>
      
      <div class="form-row">
      <div class="form-group col-md-2">
        <label for="drlexp_date">Driving Licence Expire Date</label>
        <input type="date" name="drlexp_date" class="form-control" value="<?php echo $drlexp_date;?>">
      </div>

      <div class="form-group col-md-2">
        <label for="exp_date">Insurrance Paper Expire Date</label>
        <input type="date" name="exp_date" class="form-control" value="<?php echo $exp_date;?>">
      </div>
        <div class="form-group col-md-4">
          <label for="photo">Car Picture<br><br></label>
          <input type="file" name="image" value="<?php echo $image;?>"/>
        </div>
        <div class="form-group col-md-3">

        <?php
 									include "phpqrcode/qrlib.php";
 									$PNG_TEMP_DIR = 'tmp/';
 									if (!file_exists($PNG_TEMP_DIR))
									    mkdir($PNG_TEMP_DIR);

									$filename = $PNG_TEMP_DIR . 'QR_Code.png';
                  $qrimage = time().".png";

									if (isset($_POST["btnsubmit"])) {
                  
                  $codeString .= 'Driver Full Name :' . $_POST["name"] . "\n";
                  $codeString .= 'Sticker N° :' . $_POST["nsticker"] . "\n";
									$codeString .= 'Company :' . $_POST["company"] . "\n";
               		$codeString .= 'Driver Phone N° :' . $_POST["drp"] . "\n". "\n";
                  $codeString .= '  SAFETY EVERYONES RESPONSIBILITY'. "\n";

									$filename = $PNG_TEMP_DIR . $_POST["nsticker"] . md5($codeString) . '.png';
                  $qrimage = time().".png";

									QRcode::png($codeString, $filename);

									echo '<img src="' . $PNG_TEMP_DIR . basename($filename) . '" name="qr"/><hr/>';
								}
								?>
        </div>
      </div>
      <button type="submit" name="btnsubmit" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Car Sticker</button>
    </form>
  </div>
</div>

  <div class="container my-4">

    <table style="background-color:#FFFFE0;position:center;font-size:9px;table-layout:fixed;width: 140%;color:black;"class="table" id="myTable">
      <thead>
        <tr style="" class="bg-dark text-white">
          <th scope="col">Serial N°</th>
          <th scope="col">Sticker N°</th>
          <th scope="col">Driver Full Name</th>
          <th scope="col">ID/ IQAMA N°</th>
          <th scope="col">Company Name</th>
          <th scope="col">Car Type</th>
          <th scope="col">Plate N°</th>
          <th scope="col">Vehicule Color</th>
          <th scope="col">Vehicule Model</th>
          <th scope="col">Driver Phone N°</th>
          <th scope="col">Driving Licence Exp</th>
          <th scope="col">Insurrance Exp</th>
          <th scope="col">Operation</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `crd` order by 1 DESC";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['nsticker'] . "</td>
            <td>". $row['name'] . "</td>
            <td>". $row['id'] . "</td>
            <td>". $row['company'] . "</td>
            <td>". $row['ct'] . "</td>
            <td>". $row['nplate'] . "</td>
            <td>". $row['vc'] . "</td>
            <td>". $row['vm'] . "</td>
            <td>". $row['drp'] . "</td>
            <td>". $row['drlexp_date'] . "</td>
            <td>". $row['exp_date'] . "</td>
            <td>  <button class='delete btn btn-sm btn-danger' id=d".$row['sno'].">Del</button>  </td>
          </tr>";
        } 
          ?>
      </tbody>
                  <!-- <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> -->
    </table>
  </div>
  <hr>
  <a href="https://www.vision2030.gov.sa/v2030/v2030-projects/king-salman-park/" type="button" class="btn btn-primary btn-lg btn-block" target="_blank">Visit The Project Website</a>				  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
          Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
        console.log("edit");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        id_no = tr.getElementsByTagName("td")[1].innerText;
        console.log(name, id);
        nameEdit.value = name;
        id_noEdit.value = id;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit");
        sno = e.target.id.substr(1);

        if (confirm("Are You Sure You Want To Delete This Employee !"))
        {
            console.log("Yes");
            window.location = `index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else
        {
          console.log("No");
        }
      })
    })
  </script>
  <?php include 'footer.php';?>
</body>
</html>