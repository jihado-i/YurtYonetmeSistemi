<?php
    session_start();
    include('../includes/dbconn.php');
    include('../includes/check-login.php');
    check_login();
    //code for registration
    if(isset($_POST['submit'])){
        $roomno=$_POST['room'];
        $seater=$_POST['seater'];
        $feespm=$_POST['fpm'];
        $foodstatus=$_POST['foodstatus'];
        $stayfrom=$_POST['stayf'];
        $duration=$_POST['duration'];
        $course=$_POST['course'];
        $regno=$_POST['regno'];
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        $gender=$_POST['gender'];
        $contactno=$_POST['contact'];
        $emailid=$_POST['email'];
        $emcntno=$_POST['econtact'];
        $gurname=$_POST['gname'];
        $gurrelation=$_POST['grelation'];
        $gurcntno=$_POST['gcontact'];
        $caddress=$_POST['address'];
        $ccity=$_POST['city'];
        $cpincode=$_POST['pincode'];
        $paddress=$_POST['paddress'];
        $pcity=$_POST['pcity'];
        $ppincode=$_POST['ppincode'];
        $query="INSERT into  registration(roomno,seater,feespm,foodstatus,stayfrom,duration,course,regno,firstName,middleName,lastName,gender,contactno,emailid,egycontactno,guardianName,guardianRelation,guardianContactno,corresAddress,corresCIty,corresPincode,pmntAddress,pmntCity,pmntPincode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc=$stmt->bind_param('iiiisissssssisissississi',$roomno,$seater,$feespm,$foodstatus,$stayfrom,$duration,$course,$regno,$fname,$mname,$lname,$gender,$contactno,$emailid,$emcntno,$gurname,$gurrelation,$gurcntno,$caddress,$ccity,$cpincode,$paddress,$pcity,$ppincode);
        $stmt->execute();
        echo"<script>alert(' Rezervasyon başarılı bir şekild oldu  ');</script>";
    }
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title> Oda Rezervasyon  </title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">

    <script>
    function getSeater(val) {
        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'roomid='+val,
        success: function(data){
        //alert(data);
        $('#seater').val(data);
        }
        });

        $.ajax({
        type: "POST",
        url: "get-seater.php",
        data:'rid='+val,
        success: function(data){
        //alert(data);
        $('#fpm').val(data);
        }
        });
    }
    </script>
    
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Öğrenciye oda ayırtın  </h4>
                        <div class="d-flex align-items-center">
                            <!-- <nav aria-label="breadcrumb">
                                
                            </nav> -->
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

            <form method="POST">
                
                <?php
                    $stmt=$mysqli->prepare("SELECT emailid FROM registration WHERE emailid=? ");
                    $stmt->bind_param('s',$uid);
                    $stmt->execute();
                    $stmt -> bind_result($email);
                    $rs=$stmt->fetch();
                    $stmt->close();

                    if($rs){ ?>
                    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                                <strong>mesaj: </strong> önceden oda ayırttınız
                    </div>
                    <?php }
                    else{
						echo "";
					}			
				?>	


                <!-- <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Hostel Bookings</h4>
                    </div> -->

                
                <div class="row">


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Oda numarası </h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" name="room" id="room" onChange="getSeater(this.value);" onBlur="checkAvailability()" required id="inlineFormCustomSelect">
                                            <option selected>Seç...</option>
                                            <?php $query ="SELECT * FROM rooms";
                                            $stmt2 = $mysqli->prepare($query);
                                            $stmt2->execute();
                                            $res=$stmt2->get_result();
                                            while($row=$res->fetch_object())
                                            {
                                            ?>
                                            <option value="<?php echo $row->room_no;?>"> <?php echo $row->room_no;?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="room-availability-status" style="font-size:12px;"></span>
                                    </div>
                              
                            </div>
                        </div>
                    </div>
                
 
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Rezervasyon tarihi </h4>
                                    <div class="form-group">
                                        <input type="date" name="stayf" id="stayf" class="form-control" required>
                                    </div>
                                
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Odadaki kişi sayısı</h4>
                                    <div class="form-group">
                                        <input type="text"   id="seater" name="seater" placeholder="Odadaki kişi sayısı yazın " required class="form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Toplam ikamet süresi</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="duration" name="duration">
                                        <option selected>Seç...</option>
                                            <option value="1">Bir Ay</option>
                                            <option value="2">2 Ay</option>
                                            <option value="3">3 Ay </option>
                                            <option value="4">4 Ay</option>
                                            <option value="5">5 Ay</option>
                                            <option value="6">6 AY</option>
                                            <option value="7">7 AY</option>
                                            <option value="8">8 AY </option>
                                            <option value="9">9 Ay </option>
                                            <option value="10">10 AY</option>
                                            <option value="11">11 Ay </option>
                                            <option value="12">1 yıl </option>
                                        </select>
                                    </div>
                              
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                        <div class="card-body">
                                <h4 class="card-title"> Yemek durumu </h4>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" value="1" name="foodstatus"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1"> Ayda 500 ₺ eklenecek <code>Gerekli </code></label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" value="0" name="foodstatus"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio2">Gerekli değil </label>
                                </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Aylık toplam ücretler  </h4>
                                    <div class="form-group">
                                        <input type="text" name="fpm" id="fpm" placeholder=" Aylık toplam ücretleriniz " class="form-control" readonly >
                                    </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Belirtilen bekleme süresi için  toplam</h4>
                                    <div class="form-group">
                                        <input type="text" name="ta"  id="ta" placeholder="Belirtilen bekleme süresi için toplam .." required class="form-control">
                                    </div>
                            </div>
                        </div>
                    </div>
                
                </div>

                <h4 class="card-title mt-5">Öğrenci kişisel bilgileri</h4>

                <div class="row">

                
                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> Öğrenci numarası </h4>
                                        <div class="form-group">
                                            <input type="text" name="regno" id="regno" placeholder="Öğrenci numarası yaz" class="form-control" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ad</h4>
                                    <div class="form-group">
                                        <input type="text" name="fname" id="fname" placeholder="Ad" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Baba ismi</h4>
                                    <div class="form-group">
                                        <input type="text" name="mname" id="mname" placeholder="Baba ismi girin" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Soyadı</h4>
                                    <div class="form-group">
                                        <input type="text" name="lname" id="lname" placeholder="Soyadı" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Email</h4>
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" placeholder=" Email" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Cinsiyet</h4>
                                    <div class="form-group">
                                    <select name="gender" class="form-control" required="required">
                                    <option value="">Seç</option>
                                        <option value="Erkek">Erkek</option>
                                        <option value="Kız">Kız</option>
                                    </select>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Tel numarası</h4>
                                    <div class="form-group">
                                        <input type="number" name="contact" id="contact" placeholder="Telefon numarası yaz" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Acil irtibat numarası</h4>
                                    <div class="form-group">
                                        <input type="number" name="econtact" id="econtact" placeholder=" Acil irtibat numarasını yazınız  " class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> Eğitim seviyesi</h4>
                                    <div class="form-group mb-4">
                                        <select class="custom-select mr-sm-2" id="course" name="course">
                                            <option selected> Eğitim seviyesi girin..</option>
                                            <?php $query ="SELECT * FROM courses";
                                                $stmt2 = $mysqli->prepare($query);
                                                $stmt2->execute();
                                                $res=$stmt2->get_result();
                                                while($row=$res->fetch_object())
                                                {
                                            ?>
                                            <option value="<?php echo $row->course_fn;?>"><?php echo $row->course_fn;?>&nbsp;&nbsp;(<?php echo $row->course_sn;?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                              
                            </div>
                        </div>
                    </div>
                              
                </div>

                <h4 class="card-title mt-5"> Ebeveyn bilgileri </h4>

                    <div class="row">
                    
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ebeveyn adı  </h4>
                                        <div class="form-group">
                                            <input type="text" name="gname" id="gname" class="form-control" placeholder="Ebeveyn adını yaz" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Neyiniz olur</h4>
                                        <div class="form-group">
                                            <input type="text" name="grelation" id="grelation" required class="form-control" placeholder="Neyiniz olur ">
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Tel numarası</h4>
                                        <div class="form-group">
                                            <input type="text" name="gcontact" id="gcontact" required class="form-control" placeholder=" Tel numarası giriniz">
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>

                    <h4 class="card-title mt-5">güncel adres bilgisi</h4>

                    <div class="row">
                    
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> Öğrencinin ikamet adresi </h4>
                                        <div class="form-group">
                                            <input type="text" name="address" id="address" class="form-control" placeholder="Öğrencinin ikamet adresi yazınız" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Şehir</h4>
                                        <div class="form-group">
                                            <input type="text" name="city" id="city" class="form-control" placeholder=" Şehir " required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> Posta kodu </h4>
                                        <div class="form-group">
                                            <input type="text" name="pincode" id="pincode" class="form-control" placeholder=" Posta kodu" required>
                                        </div>
                                </div>
                            </div>
                        </div>

                    
                    </div>


                    <h4 class="card-title mt-5">kalıcı adres bilgisi</h4>

                    <div class="row">
                    
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-subtitle"><code>  Farklı bir kalıcı adresiniz varsa bu kutuyu yok sayın </code> </h6>
                                    <fieldset class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="adcheck"> Kalıcı adresim yukarıdaki ile aynı!!
                                        </label>
                                    </fieldset>
                                   
                                </div>
                            </div>
                        </div>
                        
                    
                    </div>

                    
                    <h5 class="card-title mt-5">Lütfen "Yalnızca" farklı bir kalıcı adresiniz varsa formu doldurun   !</h5>


                    <div class="row">

                    
                    <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Adres</h4>
                                        <div class="form-group">
                                            <input type="text" name="paddress" id="paddress" class="form-control" placeholder="Adres" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Şehir</h4>
                                        <div class="form-group">
                                            <input type="text" name="pcity" id="pcity" class="form-control" placeholder="Şehir" required>
                                        </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> Email</h4>
                                        <div class="form-group">
                                            <input type="text" name="ppincode" id="ppincode" class="form-control" placeholder=" Email" required>
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                    
                    </div>


                    <div class="form-actions">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success">kaydol</button>
                            <button type="reset" class="btn btn-dark">İptal</button>
                        </div>
                    </div>

                
                </form>

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include '../includes/footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

    <!-- Custom Ft. Script Lines -->
<script type="text/javascript">
	$(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#paddress').val( $('#address').val() );
                $('#pcity').val( $('#city').val() );
                $('#ppincode').val( $('#pincode').val() );
            } 
            
        });
    });
    </script>
    
    <script>
        function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
        url: "check-availability.php",
        data:'roomno='+$("#room").val(),
        type: "POST",
        success:function(data){
            $("#room-availability-status").html(data);
            $("#loaderIcon").hide();
        },
            error:function (){}
            });
        }
    </script>


    <script type="text/javascript">

    $(document).ready(function() {
        $('#duration').keyup(function(){
            var fetch_dbid = $(this).val();
            $.ajax({
            type:'POST',
            url :"ins-amt.php?action=userid",
            data :{userinfo:fetch_dbid},
            success:function(data){
            $('.result').val(data);
            }
            });
            

    })});
    </script>

</body>

</html>