<?php

session_start();

if(!isset($_SESSION['adminID'])){
    header("Location: ../");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Subhiksha - Admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="./index.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Subhiksha Admin</h3>
            </div>

            <ul class="list-unstyled components">
                <!-- <p>Dummy Heading</p> -->
                <li class="">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Manage Applicants</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#" onclick="approvedApplicants()">Approved Applicants</a>
                        </li>

                        <li>
                            <a href="#" onclick="approvedNominee()">Approved Nominee</a>
                        </li>

                        <li>
                            <a href="#" onclick="pendingApprovals()">Pending  Approvals</a>
                        </li>

                        <li>
                            <a href="#" onclick="pendingNomineeApprovals()">Pending Nominee Approvals</a>
                        </li>
                        <li>
                            <a href="#" onclick="verifiedApplicants()">Verified Applicants</a>
                        </li>

                        <li>
                            <a href="#" onclick="verifiedNominee()">Verified Nominee</a>
                        </li>
                        <li>
                            <a href="#" onclick="UnverifiedApplicants()">Unverified Applicants</a>
                        </li>

                        <li>
                            <a href="#" onclick="UnverifiedNominee()">Unverified Nominee</a>
                        </li>
                        <li>
                            <a href="#" onclick="OldApplicants()">Old Applicants</a>
                        </li>
                        <li>
                            <a href="#" onclick="OldNominee()">Old Nominee</a>
                        </li>

                        <li class="">
                            <a href="#incompleteApplications" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Incomplete Applications</a>
                            <ul class="collapse list-unstyled" id="incompleteApplications">
                                <li>
                                    <a href="#" onclick="personal()">Only Personal Info Available</a>
                                </li>
                                <li>
                                    <a href="#" onclick="personalAadhar()">Only Personal & Aadhar Info Available</a>
                                </li>
                                <li>
                                    <a href="#" onclick="personalAadharReferrer()">Only Personal, Aadhar & Referrer Info Available</a>
                                </li>
                                <li>
                                    <a href="#" onclick="rejectedAadhar()">Rejected Aadhar Photo</a>
                                </li>
                                <li>
                                    <a href="#" onclick="rejectedPaymentPhoto()">Rejected Payment Photo</a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </li>


                <li class="">
                    <a href="#add" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Add</a>
                    <ul class="collapse list-unstyled" id="add">
                        <li>
                            <a href="#" onclick="addVerifier()">Add Verifier</a>
                        </li>
                        <li>
                            <a href="#" onclick="addApprover()">Add Approver</a>
                        </li>
                        <li>
                            <a href="#" onclick="addDistrict()">Add District</a>
                        </li>
                        <!-- <li>
                            <a href="#" onclick="addApplicant()">Add Applicant</a>
                        </li> -->
                    </ul>
                </li>

                <li class="">
                    <a href="#manageHierarchy" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Manage Hierarchy</a>
                    <ul class="collapse list-unstyled" id="manageHierarchy">
                        <li>
                            <a href="#" onclick="addFieldOfficer()">Add Field Officer</a>
                        </li>
                        <li>
                            <a href="#" onclick="manageFarmersUnderFO()">Farmers Under Field Officer</a>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="#Products" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Products</a>
                    <ul class="collapse list-unstyled" id="Products">
                        <li>
                            <a href="#" onclick="viewAvailableProducts()">View Available Products</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" onclick="downloadCSV()" class="download">Download CSV (Users)</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav id="userPanelHeader" class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <!-- <li class="nav-item active">
                                <a class="nav-link" href="#">Home</a>
                            </li> -->
                            <li class="nav-item" style="text-align: right; padding: 5px;">
                                <div class="btn-group dropleft">
								  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    Options
								  </button>
								  <div class="dropdown-menu">
								    <!-- <a class="dropdown-item" href="#" onclick="accountInfo()">Account Info</a> -->
								    <!-- <div class="dropdown-divider"></div> -->
								    <a class="dropdown-item" href="logoutClicked.php">Logout</a>
								  </div>
								</div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

			
            <iframe id="contentFrame" src="./Default" style="flex: 1;" style="height: 80vh" frameborder="0">
        <!-- height="100%" -->
            </iframe>

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
Nominee
        function approvedApplicants(){
            document.getElementById("contentFrame").src = "./ApprovedApplicants/";
        }

        function approvedNominee(){
            document.getElementById("contentFrame").src = "./ApprovedNominee/";
        }

        function pendingApprovals() {
          document.getElementById("contentFrame").src = "./PendingApprovals/";
        }
 
        function pendingNomineeApprovals() {
          document.getElementById("contentFrame").src = "./PendingNomineeApprovals/";
        }

        function verifiedApplicants(){
            document.getElementById("contentFrame").src = "./VerifiedApplicants/";
        }
        function verifiedNominee(){
            document.getElementById("contentFrame").src = "./VerifiedNominee/";
        }
        function UnverifiedApplicants() {
          document.getElementById("contentFrame").src = "./UnverifiedApplicants/";
        }
        function UnverifiedNominee() {
          document.getElementById("contentFrame").src = "./UnverifiedNominee/";
        }
        function OldApplicants() {
          document.getElementById("contentFrame").src = "./OldApplicants/";
        }
        function OldNominee() {
          document.getElementById("contentFrame").src = "./OldNominee/";
        }
        function personal() {
          document.getElementById("contentFrame").src = "./IncompleteApplications/Personal/";
        }

        function personalAadhar(){
            document.getElementById("contentFrame").src = "./IncompleteApplications/PersonalAadhar/";
        }

        function personalAadharReferrer(){
            document.getElementById("contentFrame").src = "./IncompleteApplications/PersonalAadharReferrer/";
        }

        function rejectedAadhar(){
            document.getElementById("contentFrame").src = "./IncompleteApplications/RejectedAadhar/";
        }

        function rejectedPaymentPhoto(){
            document.getElementById("contentFrame").src = "./IncompleteApplications/RejectedPaymentPhoto/";
        }

        function addVerifier(){
            document.getElementById("contentFrame").src = "./AddVerifier/";
        }

        function addApprover(){
            document.getElementById("contentFrame").src = "./AddApprover/";
        }

        function addFieldOfficer(){
            document.getElementById("contentFrame").src = "./AddFieldOfficer/";
        }

        function addDistrict(){
            document.getElementById("contentFrame").src = "./AddDistrict/";
        }
        
        function addApplicant(){
            document.getElementById("contentFrame").src = "./AddApplicant/";
        }

        function manageFarmersUnderFO(){
            document.getElementById("contentFrame").src = "./ManageFarmersUnderFO/";
        }

        function viewAvailableProducts(){
            document.getElementById("contentFrame").src = "./ViewAvailableProducts/";
        }
        

        function downloadCSV(){
            document.getElementById("contentFrame").src = "./ExportCSV/AllUsers/";
        }


        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });

        $('#exampleModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus')
        })
        
    </script>

</body>


</html>