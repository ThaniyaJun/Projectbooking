<?php
session_start() ;
//1. เชื่อมต่อ database: 
include('./conDB/config.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
//ตรวจสอบถ้าว่างให้เด้งไปหน้าหลัก
//รับค่าไอดีที่จะแก้ไข
$user_id = mysqli_real_escape_string($con,$_GET['user_id']);
 
//2. query ข้อมูลจากตาราง: 
$sql = "SELECT * FROM users WHERE user_id='$user_id' ";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
extract($row);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ระบบการให้จองคิวให้คำปรึกษาด้านสุขภาพจิต</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php include('navadmin.php') ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <form class="form-inline">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </form>

                <!-- Topbar Search -->


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->

                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">สวัสดี
                            <?= $_SESSION['admin_username'] ?></span>
                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="loginadmin.php" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                ออกจากระบบ
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->
            <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">ข้อมูลผู้ป่วย</h1>
                      
                    </div>

                    <!-- Content Row -->
                    <div class="container p-3">
   
                    <form class="user" action="editprofile_db.php" method="post" name="updateuser" id="updateuser">
                                <div class="form-group">
                                    <input name="Firstname" type="text" id="Firstname"
                                        class="form-control form-control-user"  value="<?=$user_name;?>" 
                                        placeholder="ชื่อ-นามสกุล(ภาษาไทย)" required>
                                </div>
                                <div class="form-group">
                                    <input name="Num" type="text" id="Num" class="form-control form-control-user"
                                    value="<?=$user_no;?>"  placeholder="รหัสนักศึกษา 10 หลัก" >
                                    <!-- disabled="disabled" -->
                                </div>
                                <div>
                                    <select class="form-select" aria-label="Default select example" name="Major"
                                        onchange="check(this);">
                                        <option selected value="search" id="">-เลือกสาขา-</option>
                                        <option value="1">สาขาวิชาการบัญชี</option>
                                        <option value="2">สาขาวิชาระบบสารสนเทศทางการบัญชี</option>
                                        <option value="3">สาขาวิชาการจัดการสารสนเทศและคอมพิวเตอร์</option>
                                        <option value="4">สาขาวิชาการจัดการธุรกิจผ่านสื่ออิเล็กทรอนิกส์</option>
                                        <option value="5">สาขาวิชาการประกันภัยและการจัดการความเสี่ยง</option>
                                        <option value="6">สาขาวิชาการจัดการการท่องเที่ยว</option>
                                        <option value="7">สาขาวิชาการตลาด</option>
                                        <option value="8">สาขาวิชาการจัดการรัฐกิจ</option>
                                        <option value="9">สาขาวิชาภาษาอังกฤษธุรกิจ</option>
                                        <option value="10">สาขาวิชาสถาปัตยกรรม</option>
                                        <option value="11">สาขาวิชาศิลปะการแสดงและการจัดการ</option>
                                    </select>
                                </div><br>
                                <div>
                                    <select class="form-select" aria-label="Default select example" name="Cls" id="Cls"
                                        size="1" onchange="check(this);">
                                        <option selected value="search">-เลือกชั้นปี-</option>
                                        <option value="1">ชั้นปีที่1</option>
                                        <option value="2">ชั้นปีที่2</option>
                                        <option value="3">ชั้นปีที่3</option>
                                        <option value="4">ชั้นปีที่4</option>
                                        <option value="5">ชั้นปีที่5</option>
                                    </select>
                                </div><br>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" name="Tell" type="text" id="Tell"
                                        value="<?=$user_tell;?>" placeholder="เบอร์โทรศัพท์" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user" name="Email" type="text"
                                        value="<?=$user_email;?>" id="Email" placeholder="E-mail (name@example.com)" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input class="form-control form-control-user" name="lne" type="text" id="lne"
                                        value="<?=$lne_id;?>" placeholder="LINE ID / เบอร์โทรศัพท์" required">
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control form-control-user" name="Facebook" type="text"
                                            id="Facebook" "  value="<?=$facebook;?>" placeholder=" ชื่อ Facebook" required>
                                    </div>
                                    <td>&nbsp;</td>


                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <button type="submit" name="update" value="save" 
                                    class="btn btn-success btn-user btn-block"> แก้ไขข้อมูล  </button>
                            </form>

                    <!-- Content Row -->
                    <div class="row">

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
                <!-- Page Heading -->
                <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->


                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตตรัง</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </di>
            <!-- End of Content Wrapper -->
            <!-- Profile -->
            <meta charset="UTF-8">

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบหรือไม่ ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">เลือก "Logout" เพื่อออกจากระบบ </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

</body>

</html>