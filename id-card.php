<?php 

        $notfound = false;
        include 'config.php';
        $html = '';
        if(isset($_POST['search'])){

             $id_no = $_POST['id_no'];

             $sql = "Select * from cards where id_no='$id_no' ";

             $result = mysqli_query($conn, $sql);
 
 
             if(mysqli_num_rows($result)>0){
             $html="<div class='card' style='width:350px; padding:0;' >";
     
               $html.="";
                         while($row=mysqli_fetch_assoc($result)){

                             $sno = $row["sno"];
                            $name = $row["name"];
                            $typec = $row["typec"];
                            $id_no = $row["id_no"];
                            $grade = $row['grade'];
                            $joining_date = $row['joining_date'];
                            $address = $row['address'];
                            $email = $row['email'];
                            $exp_date = $row['exp_date'];
                            $phone = $row['phone'];
                            $address = $row['address'];
                            $image = $row['image'];
                            $qr = $row['qr'];
                            $date = date('M d, Y', strtotime($row['date']));
                          
                             
                             $html.="
                             <!-- First Card -->
                        <center>
                            <div class='container0' id='container0'>
                                 <div class='padding' id='card'>
                                    <div class='font'>
                                        <div class='top'>
                                            <!-- this is for character image -->
                                            <img src='$image' alt=''>                    
                                        </div>

                                        <div class='typec'>
                                            <p><b>$typec</b></p>
                                        </div>

                                        <div class='ename'>
                                            <p class='p1'><b>$name</b></p>
                                            <p class='p2'>$grade</p>
                                        </div>
                                            <p class='id_n'><b>$id_no</b></p>
                                                <div class='qr'>
                                                    <img src='$qr' alt=''>
                                                </div>
                                                    <div class='Address'><b>N°:0000$sno</b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </center>


                                        ";         
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <link rel="stylesheet" href="css/dashboard.css">
    
    <link rel="icon" type="image/png" href="images/favicon.png"/>

    <title>HSSEMS | Car Sticker Generator</title>
       <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">

<script>
        function printDiv() {
            var divContents = document.getElementById("card").innerHTML;
            var a = window.open('', '', 'height: 375px , width: 225px');
            a.document.write(divContents);
            a.document.close();
            a.print();
        }
    </script>

<style>
body{
   font-family:'arial';
   background-image: url("./assets/images/background.png");
   background-color: #cccccc;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
   }

/*First Cont*/

.container0{

    display: flex;
    align-items: center;
    justify-content: space-around;
    flex-wrap: wrap;
    box-sizing: border-box;
    flex-direction: row;
}

.font{
    height: 375px;
    width: 225px;
    position: relative;
    border-radius: 10px;
    background-image: url(assets/images/bg100.jpg);
    background-size: 225px 375px;
    background-repeat: no-repeat;
}

.companyname
{
    color: white;
    padding: 10px;
    font-size: 25px;
}

.top img
{
    height: 130px;
    width: 130px;
    background-color: #e6ebe0;
    border-radius: 65px;
    position: absolute;
    top: 64px;
    left: 43px;
    object-fit: content;
    border: 3px solid rgba(255, 255, 255, .2);
}

.qr 
{
    position: absolute;
    top: 280px;
    left:70px;
}

.qr img{
    height : 75px;
    width : 75px;

}

.ename
{
    padding : 207px 0 0 0;
    align-items:center;
    color: black;
    font-size: 30px;
    text-align: center;
    font-family: 'Times New Roman', Times, serif;
}
.p1
{
    font-size:20px;
    line-height:1em;
}

.p2
{
 color:grey;
 font-size:18px;
 font-style:Sans-Serif;
}

.edetails
{
    position: absolute;
    top: 300px;
    left:22px;
    text-transform: capitalize;
    font-size: 11px;
    text-emphasis: spacing;
}

.Address
{
    position: absolute;
    top: 356px;
    left:74px;
    text-transform: capitalize;
    font-size: 14px;
    text-emphasis: spacing;
}

.id_n
{
    transform:rotate(-90deg);
    position: absolute;
    top: 320px;
    left:22px;
    text-transform: capitalize;
    font-size: 14px;
    text-emphasis: spacing;
}

.typec
{
    transform:rotate(-90deg);
    position:absolute;
    top : 180px;
    right: -35px;
    font-size : 14px;
    text-emphasis: spacing;
}

.type
{
    position:absolute;
}

.lavkush img
{
  border-radius: 8px;
  border: 2px solid blue;
}
span
{
    font-family: 'Orbitron', sans-serif;
    font-size:16px;
}
hr.new2 {
  border-top: 1px dashed black;
  width:350px;
  text-align:left;
  align-items:left;
}
 /* second id card  */
 p{
     font-size: 13px;
     margin-top: -5px;
 }
 .container {
    width: 50vh;
    height: 80vh;
    margin: auto;
    background-color: white;
    background-image: url(assets/images/bg10.jpg);
    height: 530px;
    width: 350px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    box-shadow: 0 1px 10px rgb(146 161 176 / 50%);
    overflow: hidden;
    border-radius: 10px;
}

.header h1 {
    color: rgb(27, 27, 49);
    text-align: center;
}

.header p {
    color: rgb(157, 51, 0);
    text-align: right;
    margin-right: 22px;
    margin-top: -10px;
}

.container-2 {
    /* border: 2px solid red; */
    width: 80vh;
    height: 15vh;
    margin: 0px auto;
    margin-top: 100px;
    display: flex;
}

.box-1 {
    border: 2px solid Black;
    width: 120px;
    height: 120px;
    margin: 6px 10px 20px 80px;
    border-radius : 78px 78px 78px 78px;
}

.box-1 img {
    width: 110px;
    height: 110px;
    margin : 5px 1px 3px 1px;
    border-radius : 50px 50px 50px 50px;
}

.box-2 {
    /* border: 2px solid purple; */
    width: 33vh;
    height: 8vh;
    text-align: center;
    margin : 170px 0 0 -170px;
    font-family: 'Poppins', sans-serif;
}

.box-2 h2 {
    font-size: 1.3rem;
    margin-top: -5px;
    color: rgb(27, 27, 49);
}

.box-2 p {
    font-size: 0.7rem;
    margin-top: -5px;
    color: rgb(179, 116, 0);
}

.box-3 {
    /* border: 2px solid rgb(21, 255, 0); */
    width: 8vh;
    height: 8vh;
    margin: 8px 0px 8px 30px;
}

.box-3 img {
    width: 8vh;
}



.container-3 {
    /* border: 2px solid rgb(111, 2, 161); */
    width: 73vh;
    height: 12vh;
    margin: -10px;
    margin-top: 10px;
    display: flex;
    font-family: 'Shippori Antique B1', sans-serif;
    font-size: 0.7rem;
}

.info-1 {
    /* border: 1px solid rgb(255, 38, 0); */
    width: 17vh;
    height: 12vh;
}

.id {
    /* border: 1px solid rgb(2, 92, 17); */
    width: 17vh;
    height: 5vh;
}

.id h4 {
    color: rgb(179, 116, 0);
    font-size:15px;
}

.joining_date {
    /* border: 1px solid rgb(0, 46, 105); */
    width: 17vh;
    height: 5vh;
    margin: 8px 0px 0px 0px;
}

.joining_date h4 {
    color: rgb(179, 116, 0);
    font-size:15px;
}

.info-2 {
    /* border: 1px solid rgb(4, 0, 59); */
    width: 17vh;
    height: 12vh;
}

.join-date {
    /* border: 1px solid rgb(2, 92, 17); */
    width: 17vh;
    height: 5vh;
}

.join-date h4 {
    color: rgb(179, 116, 0);
    font-size:15px;
}

.nav-link{
    justify-content: center;
    display:flex;
}

.expire-date {
    /* border: 1px solid rgb(0, 46, 105); */
    width: 17vh;
    height: 5vh;
    margin: 8px 0px 0px 0px;
}

.expire-date h4 {
    color: rgb(179, 116, 0);
    font-size:15px;
}

.info-3 {
    /* border: 1px solid rgb(255, 38, 0); */
    width: 17vh;
    height: 12vh;
}

.email {
    /* border: 1px solid rgb(2, 92, 17); */
    width: 22vh;
    height: 5vh;
}

.email h4 {
    color: rgb(179, 116, 0);
    font-size:15px;
}

.phone {
    /* border: 1px solid rgb(0, 46, 105); */
    width: 17vh;
    height: 5vh;
    margin: 8px 0px 0px 0px;
}

.info-4 {
    /* border: 2px solid rgb(255, 38, 0); */
    width: 22vh;
    height: 12vh;
    margin: 0px 0px 0px 0px;
    font-size:15px;
}

.phone h4 {
    color: rgb(179, 116, 0);
    font-size:15px;
}

.sign {
    /* border: 1px solid rgb(0, 46, 105); */
    width: 17vh;
    height: 5vh;
    margin: 41px 0px 0px 20px;
    text-align: center;
}
.navbar-brand
{
    height:78px;
    width:150px;
}
img {
 max-width: 100%;
 max-height: 100%;
}
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
  </head>
  <body>

 <!-- Navigation bar start  -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-image: linear-gradient(to right, rgb(0,300,255), rgb(93,4,217));">
  <a class="navbar-brand" href="https://www.vision2030.gov.sa/v2030/v2030-projects/king-salman-park/"><img src="assets/images/KSPLOGO.png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<!-- Navigation bar end  -->

  <br>

<div class="row" style="margin: 0px 20px 5px 20px">
  <div class="col-sm-4">
    <div class="card jumbotron">
      <div class="card-body">
        <form class="form" method="POST" action="id-card.php">.
        <label for="exampleInputEmail1">Employee ID Number</label>
        <input class="form-control mr-sm-2" type="search" placeholder="Enter ID N°" name="id_no">
        <small id="emailHelp" class="form-text text-muted">Every Car's should have unique ID Number !</small>
        <br>
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="search">Generate</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
      <div class="card">
          <div class="card-header" >
            <b>The ID Card</b>
          </div>
                <div class="type-card" hidden>
                    Change Card Type
                    <div class="button-area">
                        <button onClick="MBL()">MBL</button>
                        <button onClick="Sub()">SubContract</button>
                    </div>
                </div>
        <div class="card-body" id="mycard">
          <?php echo $html ?>
        </div>
        <div class="col-sm-4" hidden>
            <div class="card-body0" id="mycard0">
                <?php echo $html ?>
            </div>
        </div>
        <br><button id="demo" class="downloadtable btn btn-primary" onclick="downloadtable()">Download ID Card</button>
        <script>
            var img = document.getElementById("container0");
            function MBL()
            {
                img.src='assets/images/bg100.jpg';
            }

            function Sub()
            {
                img.src='assets/images/bg10.jpg';
            }
        </script>
     </div>
  </div>
<hr>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>

    function downloadtable() {

        var node = document.getElementById('mycard');

        domtoimage.toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                downloadURI(dataUrl, "staff-id-card.png")
            })
            .catch(function (error) {
                console.error('Ops, Something Went Wrong', error);
            });

    }



    function downloadURI(uri, name) {
        var link = document.createElement("a");
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        delete link;
    }



</script>
  </body>
</html>