<?php require('conn.php');
			session_start();	?>
<html>
<head>
    <title> User Role Assignment</title>

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

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            background-color: #008CBA;
        }
    </style>

    
</head>
<?php
$user="";
$role="";
if($_SESSION['edit_click']==-1)
{
		$save_btn=isset($_REQUEST['save']);
		$flag=true;
		if($save_btn==true)
		{		
			$user_id=$_REQUEST['user_cmb'];		
			$role_id=$_REQUEST['roles_cmb'];
			$sql="insert into user_role (userid,roleid) values ('$user_id','$role_id')";
			$result = mysqli_query($conn, $sql);
			header("Location:UserRoleList.php");
		}
}
else
{
		$id=$_SESSION['edit_click'];
		$sql = "SELECT * FROM user_role where id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$u_id=$row["userid"];
		$r_id=$row["roleid"];
		
		if(isset($_REQUEST['save']))
		{
			$user_id=$_REQUEST['user_cmb'];		
			$role_id=$_REQUEST['roles_cmb'];
			$sql="update user_role set userid='$user_id',roleid= '$role_id' where id='$id'";
			$result = mysqli_query($conn, $sql);
			header("Location:UserRoleList.php");
		}
}
		$clr_btn=isset($_REQUEST['clr']);
		if($clr_btn==true)
		{
			$_REQUEST['user_cmb']="" ;
			$_REQUEST['roles_cmb']="";
		}
	?>
<body bgcolor="lightblue">
<form>
    <div class="topnav">
        <a href="Home.php"> Home </a> </td>
        <a href="UserList.php">User Management</a>
        <a href="RoleList.php">Role Managment</a>
        <a href="PermissionList.php">Permission Management</a>
        <a href="RolePermList.php">Role Permission Assingment</a>
        <a href="UserRoleList.php">User Role Assignment</a>
		 <a href="Login_History.php">LoginHistory</a>
		 <a href="Logout.php">LogOut</a>
    </div>

    <table>
        <h2>User Role Assignment</h2>
        <tr><b> User: </b><select name="user_cmb">
		<?php
		$q1 = "SELECT * FROM users";
		$result = mysqli_query($conn, $q1);
		$recordsFound = mysqli_num_rows($result);			
		if ($recordsFound > 0) {
		while($row = mysqli_fetch_assoc($result)) {		
			$id_r = $row["userid"];
			$name_r = $row["name"];
			if($u_id==$id_r)
			{
				echo "<option value='$id_r' selected>$name_r</option>";
			}
			else{
			if($row['isadmin']==0)
			{
				echo "<option value='$id_r'>$name_r</option>";
			}
			}
		}	
	}				
	?>
        <br>
        <br>
	</select></tr>
	<br>
    <br>
		 <tr><b> Roles: </b><select name="roles_cmb">
		<?php 
		$q2 = "SELECT * FROM roles";
		$res = mysqli_query($conn, $q2);
		$recordsFound = mysqli_num_rows($res);			
		if ($recordsFound > 0) {
		while($row = mysqli_fetch_assoc($res)) {
			$id = $row["roleid"];
			$name = $row["name"];
			if($r_id==$id)
			{
				echo "<option value='$id' selected>$name</option>";
			}
			else
			{
				echo "<option value='$id'>$name</option>";
			}
			
		}	
	}				
	?>
	</select></tr>
	<br>
    <br>
        <tr>
            <td><input type="submit" class="button" id='save' name='save' value='Save'></td>
            <td><input type="submit" class="button" id='clr' name='clr' value='Clear'></td>
        </tr>

    </table>
    </form>
</body>
</html>
