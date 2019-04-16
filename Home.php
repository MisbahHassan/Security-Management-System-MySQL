<?php require('conn.php');
			session_start();	?>
<html>
<head>
    <title> Admin </title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

            .topnav a {
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
            }

                .topnav a:hover {
                    background-color: #ddd;
                    color: black;
                }

                .topnav a.active {
                    background-color: #4CAF50;
                    color: white;
                }
    </style>
</head>
<body bgcolor='#FBAE87'>
	<?php if($_SESSION['is_admin']==1){?>
    <div class="topnav">
        <a href="Home.php"> Home </a> </td>
        <a href="UserList.php">User Management</a>
        <a href="RoleList.php">Role Managment</a>
        <a href="PermissionList.php">Permission Management</a>
        <a href="RolePermList.php">Role-Permission Assingment</a>
        <a href="UserRoleList.php">User Role Assignment</a>
		 <a href="Login_History.php">LoginHistory</a>
		 <a href="Logout.php">LogOut</a>
       
    </div>

    <h1> Welcome Admin</h1>
	<?php } else { ?>
	<div class="topnav">
            <a href="Home.php"> Home </a> </td>
            <a href="Login.php">Logout</a>
        </div>
        <h2>Welcome User</h2>
	<?php
		$id=$_SESSION['login_id'];
		$q1="Select * from user_role where userid='$id'";
		$res=mysqli_query($conn,$q1);
		echo"<h3>Roles</h3>";
		while($d=mysqli_fetch_assoc($res))
		{
			$role_id=$d['roleid'];
			$q2="Select * from roles where roleid='$role_id'";
			$res2=mysqli_query($conn,$q2);
			$d1=mysqli_fetch_assoc($res2);
			echo "<ul>";
			echo "<li>"; echo $d1['name'];  echo"</li>";
			echo "</ul>";
			
		}
			$id_=$_SESSION['login_id'];
			$q="Select * from user_role where userid='$id_'";
			$ress=mysqli_query($conn,$q);
			echo"<h3>Permissions</h3>";
			
			while($data=mysqli_fetch_assoc($ress))
			{
			$roleid=$data['roleid'];
			$q3="Select * from role_permission where roleId='$roleid'";		
			$res3=mysqli_query($conn,$q3);
			while($d2=mysqli_fetch_assoc($res3))
			{
			$perm_id=$d2['permissionid'];
			$q4="Select * from permissions where permissionid='$perm_id'";
			$res3=mysqli_query($conn,$q4);
			$d3=mysqli_fetch_assoc($res3);
			echo "<ul>";
			echo "<li>"; echo $d3['name'];  echo"</li>";
			echo "</ul>";
			}
			}
	}		
	?>
</body>
</html>
