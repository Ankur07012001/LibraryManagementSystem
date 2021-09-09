<?php
session_id('admin');
session_start();
include("connection.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    <script>


        $(document).ready(function () {
            $('body').each(function (index, element) {
                var exp = new RegExp(String.fromCharCode(8203), "g")
                var editor = $(element);
                var newText = editor.html().replace(exp, '');



                console.log("Old text: " + editor.html());
                editor.html(newText);
                console.log("New text: " + editor.html());


            });


            history.pushState(null, document.title, location.href);



        });



    </script>






    <style>
        .topnav {
            overflow: hidden;
            background-color: #e9e9e9;
        }

        .topnav .search-container {
            padding: 6px;
            float: right;
        }

        .topnav input[type=text] {
            margin-top: 8px;
            margin-bottom: 8px;
            padding-top: 6px;
            padding-bottom: 6px;

            font-size: 17px;
            border: none;
        }



        .topnav .search-container button:hover {
            background: #ccc;
        }

        @media screen and (max-width: 600px) {
            .topnav .search-container {
                float: none;
            }


            .topnav input[type=text] {
                width: 100%;

            }


            .topnav input[type=text] {
                border: 1px solid #ccc;

            }
        }

        .fa-sign-out {
            margin: 0px 5px;
            padding: 5px;
            font-size: 20px;
            width: 30px;
            height: 30px;
            text-align: center;
            text-decoration: none;
            border-radius: 50%;
        }

        .fa-sign-out:hover {
            opacity: .7;
        }




        .user1 {
            margin: 0px;
            padding: 0px;
            font-size: 20px;
            width: 30px;
            height: 30px;
            text-align: center;
            text-decoration: none;
        }
    </style>




</head>

<body>
    ​
    <?php

$res=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_SESSION[login_auser]' && password='$_SESSION[login_apassword]';");
$row= mysqli_fetch_assoc($res);
$count=mysqli_num_rows($res);


  $first=$row['first'];
  $middle=$row['middle'];
  $last=$row['last'];
  $eid=$row['eid'];
  $email=$row['email'];
  $mobileno=$row['mobilenumber'];
  $photo=$row['image'];

?>


    <nav class="navbar navbar-expand-md   navbar-dark bg-dark  " style="padding-top: 0px;padding-bottom:0px;">



        <a href="#" class="navbar-brand"><img src="image\Book.jpg" width="30" height="30"
                class="d-inline-block align-top" alt="">
            LIBRARY</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">



            <ul class="nav navbar-nav">

                <li class="nav-item ">
                    <a class="nav-link " href="homepage.php">Home</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="books.php">Books</a>
                </li>


                <li class="nav-item ">
                    <a class="nav-link" href="bookrequest.php">Requests</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="fine.php">Fine</a>
                </li>

                <li class="nav-item active ">
                    <a class="nav-link" href="student.php">Student</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="feedback.php">Feedback</a>
                </li>

            </ul>


            <ul class="navbar-nav ml-auto nav-flex-icons navbar-right">
                <li class="nav-item avatar">
                    <a class="nav-link p-0" href="profile.php">
                        <img src="image\<?php echo $photo ?>" class="rounded-circle z-depth-0" alt="Profile" height="50" title="Profile"
                            style="padding:5px">
                    </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="logout.php"><span class="fa fa-sign-out"
                            aria-hidden="true"></span>Logout</a></li>
            </ul>



        </div>





        </div>
    </nav>

    <h1 style="text-align:center">Students Detail</h1>

    <div class="container-fluid">

        <div class="topnav">
            <div class="search-container">
                <form method="POST">
                    <input type="text" placeholder="   enter sudent  prn.." name="prn" id="search" size="50" required>
                </form>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered">
                <thead style="background-color:#6d6a6a; color: White;">
                    <tr>
                        <th>ProfileImage</th>
                        <th>FirstName</th>
                        <th>MiddleName</th>
                        <th>Last</th>
                        <th>PRN</th>
                        <th>MobileNo</th>
                        <th>Email</th>
                        <th>UserName</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody id="searchtable">


                    <?php


$res=mysqli_query($db,"SELECT * FROM `student` ORDER BY `student`.`first` ASC ;");

if(mysqli_num_rows($res)==0)
{
  echo "<tr>";
  echo "<td colspan='9'>";  echo "Not any students register "; echo "</td>";
  echo "</tr>";
}
else
{

while($row=mysqli_fetch_assoc($res))
{
  $im=$row['image'];
  echo "<tr>";
  echo "<td>";
  ?>
                    <img src="http:\\localhost\digitallibrary\student\image\<?php echo $im ?>" alt="profile"
                        class="user1">
                    <?php 
  echo "</td>";
  echo "<td>"; echo $row['first']; echo "</td>";
  echo "<td>"; echo $row['middle']; echo "</td>";
  echo "<td>"; echo $row['last']; echo "</td>";
  echo "<td>"; echo $row['prn']; echo "</td>";
  echo "<td>"; echo $row['mobilenumber']; echo "</td>";
  echo "<td>"; echo $row['email']; echo "</td>";
  echo "<td>"; echo $row['username']; echo "</td>";
  echo "<td>"; echo $row['password']; echo "</td>";
  echo "</tr>";

}

}



?>








                </tbody>
            </table>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var search_term = $(this).val();

                $.ajax({
                    url: "livesearchprn.php",
                    type: "POST",
                    data: { searchdata: search_term },
                    success: function (data) {
                        $("#searchtable").html(data);
                    }

                });

            });
        });

    </script>




</body>

</html>
​
​
​