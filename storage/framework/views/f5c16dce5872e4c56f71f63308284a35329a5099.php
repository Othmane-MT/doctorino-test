<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="author" content="Digit93Team" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <link
            rel="icon"
            type="image/png"
            href="<?php echo e(asset('img/favicon.png')); ?>"
        />
        <title>Doctorino - <?php echo $__env->yieldContent('title'); ?></title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        />
      
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

        <!-- Custom styles for this template-->
        <script>
            $(document).on("click", "#create-appointment-btn", function(event) {
                event.preventDefault();
                let href = $(this).attr("data-attr");
                $.ajax({
                    url: href,
                    beforeSend: function() {
                        $("#loader").show();
                    },
                    // return the result
                    success: function(result) {
                        $("#exampleModal").modal("show");
                        // $('#mediumBody').html(result).show();
                    },
                    complete: function() {
                        $("#loader").hide();
                    },
                    error: function(jqXHR, testStatus, error) {
                        console.log(error);
                        alert("Page " + href + " cannot open. Error:" + error);
                        $("#loader").hide();
                    },
                    timeout: 8000
                });
            });
        </script>
   
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet" />
        <script src="<?php echo e(asset('js/main.js')); ?>"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
                const SITEURL="/appointment/api"
                        axios.get(SITEURL).then(function(response){
                            var Appointments=response.data.appointments;
                            var Patients=response.data.patients;
                            var eventsArray=[];

                            for(var i =0;i<Object.keys(Appointments).length;i++){
                                var title;

                                var date=Appointments[i].date;
                                date=date.split('-');
                                var year=date[0];
                                var month=date[1];
                                var day=date[2].slice(0,2);
                                var dt=`${year}-${month}-${day}`;

                                for(var j=0;i< Object.keys(Patients).length;j++){
                                    if(Patients[j+1].id==Appointments[i].user_id){
                                        title=Patients[j+1].name;
                                        break;
                                    }
                                };
                                eventsArray.push({
                                    "title":title,
                                    "start":dt+"T"+Appointments[i].time_start+":00",
                                    "end":dt+"T"+Appointments[i].time_end+":00",
                                    "id":Appointments[i].id,
                                });
                                 var dt=new Date();
                                    var year=dt.getFullYear();
                                    var day=dt.getDate();
                                    if(day<10){
                                        day='0'+day;
                                    }
                                    var month=dt.getMonth()+1;
                                    if(month<10){
                                        month='0'+month
                                    }
                                    var currentDate=`${year}-${month}-${day}`;
                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        height: '100%',
                                        expandRows: true,
                                        slotMinTime: '08:00',
                                        slotMaxTime: '20:00',
                                        headerToolbar: {
                                            left: 'prev,next today',
                                            center: 'title',
                                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                                        },
                                        initialView: 'dayGridMonth',
                                        initialDate: currentDate,
                                        navLinks: true, // can click day/week names to navigate views
                                        selectable: true,
                                      
                                        dateClick:function(info){
                                            alert('Clicked On : '+ info.dateStr);
                                        },
                                        
                                        eventClick:function(info){
                                            // to Delete an appointment
                                           window.location.href='/appointment/view/'+info.event.id
                                        },
                                        nowIndicator: true,
                                        dayMaxEvents: true, // allow "more" link when too many events
                                        // events must be fethed from database 
                                        events:eventsArray
                                
                                    });
                                     calendar.render();

                            }

                        }).catch(function(error){
                             console.log(error);
                        });
           

            

           
        });
        </script>
        <style>

            .calendar{
                display: block;
                position: relative;
                height: 100vh;
            }
            #calendar-container {
                position:absolute;
                top: 0px;
                left: 0px;
                right: 0;
                bottom: 0;
             }

            .fc-header-toolbar {
                /*
                the calendar will be butting up against the edges,
                but let's scoot in the header's buttons
                */
                padding-top: 1em;
                padding-left: 1em;
                padding-right: 1em;
            }

        </style>
        <script>
            function displayRes(){
                var input=document.getElementById('search-pat').value;
                var element=document.createElement('a');
                const SITEURL="/patients/api"
                axios.get(SITEURL).then(function(response){
                            console.log('hi')
                        }).catch(function(error){
                             console.log(error);
                        });
            }
        </script>
        <?php echo $__env->yieldContent('header'); ?>
    </head>
    <body id="page-top">
        <div id="app">
            <!-- Page Wrapper -->
            <div id="wrapper">
                <!-- Sidebar -->
                <ul
                    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
                    id="accordionSidebar"
                >
                    <!-- Sidebar - Brand -->
                    <a
                        class="sidebar-brand d-flex align-items-center justify-content-center"
                        href="<?php echo e(route('home')); ?>"
                    >
                        <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="sidebar-brand-text mx-3">
                            Doctorino <sup>1.0</sup>
                        </div>
                    </a>
                    <!-- Divider -->
                    <hr class="sidebar-divider my-0" />
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span><?php echo e(__("sentence.Dashboard")); ?></span></a
                        >
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider" />
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?php echo e(__("sentence.Patients")); ?>

                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a
                            class="nav-link collapsed"
                            href="#"
                            data-toggle="collapse"
                            data-target="#collapsePatient"
                            aria-expanded="true"
                            aria-controls="collapseTwo"
                        >
                            <i class="fas fa-fw fa-users"></i>
                            <span><?php echo e(__("sentence.Patients")); ?></span>
                        </a>
                        <div
                            id="collapsePatient"
                            class="collapse"
                            aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar"
                        >
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('patient.create')); ?>"
                                    ><?php echo e(__("sentence.New Patient")); ?></a
                                >
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('patient.all')); ?>"
                                    ><?php echo e(__("sentence.All Patients")); ?></a
                                >
                            </div>
                        </div>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider" />
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?php echo e(__("sentence.Appointment")); ?>

                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a
                            class="nav-link collapsed"
                            href="#"
                            data-toggle="collapse"
                            data-target="#collapseAppointment"
                            aria-expanded="true"
                            aria-controls="collapseAppointment"
                        >
                            <i class="fas fa-fw fa-calendar-plus"></i>
                            <span><?php echo e(__("sentence.Appointment")); ?></span>
                        </a>
                        <div
                            id="collapseAppointment"
                            class="collapse"
                            aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar"
                        >
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('appointment.create')); ?>"
                                    ><?php echo e(__("sentence.New Appointment")); ?></a
                                >
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('appointment.all')); ?>"
                                    ><?php echo e(__("sentence.All Appointments")); ?></a
                                >
                            </div>
                        </div>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider" />
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?php echo e(__("sentence.Prescriptions")); ?>

                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a
                            class="nav-link collapsed"
                            href="#"
                            data-toggle="collapse"
                            data-target="#collapseTwo"
                            aria-expanded="true"
                            aria-controls="collapseTwo"
                        >
                            <i class="fas fa-fw fa-prescription"></i>
                            <span><?php echo e(__("sentence.Prescriptions")); ?></span>
                        </a>
                        <div
                            id="collapseTwo"
                            class="collapse"
                            aria-labelledby="headingTwo"
                            data-parent="#accordionSidebar"
                        >
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('prescription.create')); ?>"
                                    ><?php echo e(__("sentence.New Prescription")); ?></a
                                >
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('prescription.all')); ?>"
                                    ><?php echo e(__("sentence.All Prescriptions")); ?></a
                                >
                            </div>
                        </div>
                    </li>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="#"
                            data-toggle="collapse"
                            data-target="#collapsePages"
                            aria-expanded="true"
                            aria-controls="collapsePages"
                        >
                            <i class="fas fa-fw fa-syringe"></i>
                            <span><?php echo e(__("sentence.Drugs")); ?></span>
                        </a>
                        <div
                            id="collapsePages"
                            class="collapse"
                            aria-labelledby="headingPages"
                            data-parent="#accordionSidebar"
                        >
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('drug.create')); ?>"
                                    ><?php echo e(__("sentence.Add Drug")); ?></a
                                >
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('drug.all')); ?>"
                                    ><?php echo e(__("sentence.All Drugs")); ?></a
                                >
                            </div>
                        </div>
                    </li>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="#"
                            data-toggle="collapse"
                            data-target="#collapseTests"
                            aria-expanded="true"
                            aria-controls="collapseTests"
                        >
                            <i class="fas fa-fw fa-heartbeat"></i>
                            <span><?php echo e(__("sentence.Tests")); ?></span>
                        </a>
                        <div
                            id="collapseTests"
                            class="collapse"
                            aria-labelledby="headingPages"
                            data-parent="#accordionSidebar"
                        >
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('test.create')); ?>"
                                    ><?php echo e(__("sentence.Add Test")); ?></a
                                >
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('test.all')); ?>"
                                    ><?php echo e(__("sentence.All Tests")); ?></a
                                >
                            </div>
                        </div>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider" />
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?php echo e(__("sentence.Billing")); ?>

                    </div>
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item">
                        <a
                            class="nav-link collapsed"
                            href="#"
                            data-toggle="collapse"
                            data-target="#collapseUtilities"
                            aria-expanded="true"
                            aria-controls="collapseUtilities"
                        >
                            <i class="fas fa-fw fa-dollar-sign"></i>
                            <span><?php echo e(__("sentence.Billing")); ?></span>
                        </a>
                        <div
                            id="collapseUtilities"
                            class="collapse"
                            aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar"
                        >
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('billing.create')); ?>"
                                    ><?php echo e(__("sentence.Create Invoice")); ?></a
                                >
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('billing.all')); ?>"
                                    ><?php echo e(__("sentence.Billing List")); ?></a
                                >
                            </div>
                        </div>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider" />
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?php echo e(__("sentence.Settings")); ?>

                    </div>
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="#"
                            data-toggle="collapse"
                            data-target="#collapseSettings"
                            aria-expanded="true"
                            aria-controls="collapseSettings"
                        >
                            <i class="fas fa-fw fa-cogs"></i>
                            <span><?php echo e(__("sentence.Settings")); ?></span>
                        </a>
                        <div
                            id="collapseSettings"
                            class="collapse"
                            aria-labelledby="headingPages"
                            data-parent="#accordionSidebar"
                        >
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('doctorino_settings.edit')); ?>"
                                    ><?php echo e(__("sentence.Doctorino Settings")); ?></a
                                >
                                <a
                                    class="collapse-item"
                                    href="<?php echo e(route('prescription_settings.edit')); ?>"
                                    ><?php echo e(__("sentence.Prescription Settings")); ?></a
                                >
                            </div>
                        </div>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block" />
                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button
                            class="rounded-circle border-0"
                            id="sidebarToggle"
                        ></button>
                    </div>
                </ul>
                <!-- End of Sidebar -->
                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">
                    <!-- Main Content -->
                    <div id="content">
                        <!-- Topbar -->
                        <nav
                            class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
                        >
                            <!-- Sidebar Toggle (Topbar) -->
                            <button
                                id="sidebarToggleTop"
                                class="btn btn-link d-md-none rounded-circle mr-3"
                            >
                                <i class="fa fa-bars"></i>
                            </button>
                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a
                                        class="nav-link dropdown-toggle"
                                        href="#"
                                        id="userDropdown"
                                        role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small"
                                            ><?php echo e(Auth::user()->name); ?></span
                                        >
                                        <img
                                            class="img-profile rounded-circle"
                                            src="<?php echo e(asset('img/favicon.png')); ?>"
                                        />
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div
                                        class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown"
                                    >
                                        <a
                                            class="dropdown-item"
                                            href="<?php echo e(route('doctorino_settings.edit')); ?>"
                                        >
                                            <i
                                                class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"
                                            ></i>
                                            <?php echo e(__("sentence.Settings")); ?>

                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a
                                            class="dropdown-item"
                                            href="#"
                                            data-toggle="modal"
                                            data-target="#logoutModal"
                                        >
                                            <i
                                                class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                                            ></i>
                                            <?php echo e(__("sentence.Logout")); ?>

                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <!-- End of Topbar -->
                        <!-- Begin Page Content -->
                        <div class="container-fluid">
                            <?php echo $__env->yieldContent('content'); ?>
                            <!-- Page Heading -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- End of Main Content -->
                    <!-- Footer -->

                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div
            class="modal fade"
            id="logoutModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php echo e(__("sentence.Ready to Leave")); ?>

                        </h5>
                        <button
                            class="close"
                            type="button"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo e(__("sentence.Ready to Leave Msg")); ?>

                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            type="button"
                            data-dismiss="modal"
                        >
                            <?php echo e(__("sentence.Cancel")); ?>

                        </button>
                        <a
                            class="btn btn-primary"
                            href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"
                            ><?php echo e(__("sentence.Logout")); ?></a
                        >
                        <form
                            id="logout-form"
                            action="<?php echo e(route('logout')); ?>"
                            method="POST"
                            class="d-none"
                        >
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>



      
       
        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
        <?php echo $__env->yieldContent('footer'); ?>
    </body>
         
</html>
<?php /**PATH C:\Users\DELL\Desktop\doctorino\resources\views/layouts/master.blade.php ENDPATH**/ ?>