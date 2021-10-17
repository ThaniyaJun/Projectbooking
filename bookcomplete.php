<?php
session_start() ;
include('./conDB/config.php');
    // 2. query ข้อมูลจากตาราง users+booking:
    // $query = "SELECT * FROM booking 
    // WHERE status = 'ยืนยัน';
//   WHERE status='ยืนยัน';
$query = "SELECT  users.user_id, users.user_name,users.user_no, 
users.user_tell, users.user_email, users.facebook,
users.lne_id,booking.id,booking.purpose,booking.booking_start_date,booking.status,booking.booking_type,booking.problem
FROM users 
INNER JOIN booking ON users.user_id = booking.user_id 
WHERE booking.status = 'ยืนยัน' " 
or die("Error:" . mysqli_error($con));;
    // 3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result 
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
 

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
    <link rel="stylesheet" href="./lib/jquery.fancybox.css" type="text/css" media="screen" />

    <!-- fullcalendar -->
    <link href='./fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='./fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <!-- jQuery -->
    <script src="./lib/jquery/dist/jquery.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src='./lib/moment.min.js'></script>
    <script src='./fullcalendar/fullcalendar.min.js'></script>
    <script src='./lib/lang/th.js'></script>
    <script src="./lib/jquery.fancybox.pack.js"></script>

    <script type="text/javascript">
    jQuery(document).ready(function() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventLimit: true,
            defaultDate: new Date(),
            timezone: 'Asia/Bangkok',
            events: {
                url: './dataEvents.php',
            },
            loading: function(bool) {
                $('#loading').toggle(bool);
            },

            eventClick: function(event) {
                if (event.url) {
                    $.fancybox({
                        'href': event.url,
                        'type': 'iframe',
                        'autoScale': false,
                        'openEffect': 'elastic',
                        'openSpeed': 'fast',
                        'closeEffect': 'elastic',
                        'closeSpeed': 'fast',
                        'closeBtn': true,
                        onClosed: function() {
                            parent.location.reload(true);
                        },
                        helpers: {
                            thumbs: {
                                width: 50,
                                height: 50
                            },

                            overlay: {
                                css: {
                                    'background': 'rgba(49, 176, 213, 0.7)'
                                }
                            }
                        }
                    });
                    return false;
                }
            },
        });
    });
    </script>


</head>

<body id="page-top">

    <?php include('navadmin.php') ?>

    <!-- <button class="btn btn-danger dropdown-toggle" style=" border-radius:90px;" type="button" 
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> $row["status"]</button>

    <div class="dropdown-menu">

      <button class="dropdown-item"  value="Y">จัดส่งแล้ว</button>
    </div> -->
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
                    <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
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
                    </li> -->

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
                            <a class="dropdown-item text-center small text-gray-500" href="#">แสดงข้อมูลทั้งหมด</a>
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
                            <a class="dropdown-item" href="loginadmin.php" data-toggle="modal"
                                data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                ออกจากระบบ
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                <!-- DataTales Example -->

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">สรุปรายชื่อการจอง</h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="">
                                <thead>
                                    <tr>
                                        <th>วันที่การจอง</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>รหัสนักศึกษา</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>อีเมล</th>
                                        <th>Facebook</th>
                                        <th>Line</th>
                                        <th>อาการ</th>
                                        <th>ลักษณะปัญหา</th>
                                        <th>ขอพบอาจารย์ที่ปรึกษา</th>
                                        <!-- <th>ตรวจสอบ</th> -->
                                        <!-- <th>สถานะ</th> -->
                                    </tr>
                                </thead>
                                <div>



                                    <?php  
                                
                                    while ( $row = mysqli_fetch_array($result)) {

                                    echo "<tbody>";
                                        echo "<tr>";
                                        echo "<td>" . $row["booking_start_date"] . "</td> ";
                                        echo "<td>" . $row["user_name"] . "</td> ";
                                        echo "<td>" . $row["user_no"] . "</td> ";
                                        echo "<td>" . $row["user_tell"] . "</td> ";
                                        echo "<td>" . $row["user_email"] . "</td> ";
                                        echo "<td>" . $row["facebook"] . "</td> ";
                                        echo "<td>" . $row["lne_id"] . "</td> ";
                                        echo "<td>" . $row["purpose"] . "</td> ";
                                        echo "<td>" . $row["problem"] . "</td> ";
                                        echo "<td>" . $row["booking_type"] . "</td> ";

                                    echo "</tbody>";

                                    }  
                                    
                                    ?>

                            </table>

                            <?php
                             mysqli_close($con);
                            ?>

                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
           
        <center><a href="pdf1.php" class="btn btn-primary">ดาวน์โหลด (pdf)</a></center>


        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>มหาวิทยาลัยสงขลานครินทร์ วิทยาเขตตรัง</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

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
                    <a class="btn btn-primary" href="loginadmin.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
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