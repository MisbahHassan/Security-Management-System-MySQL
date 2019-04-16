<?php require('conn.php');
			session_start();	?>
<html>  
    <head>
<title>Permission Assignment</title>

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
	if($_SESSION['edit_click']==-1)
	{
		$save_btn=isset($_REQUEST['save']);
		if($save_btn==true)
		{		
			$role_id=$_REQUEST['cmbRoles'];		
			$perm_id=$_REQUEST['cmbPermissions'];
			$sql="insert into role_permission (roleId,permissionid) values ('$role_id','$perm_id')";
			$result = mysqli_query($conn, $sql);
			header("Location:RolePermList.php");
		}
		$clr_btn=isset($_REQUEST['clr']);
		if($clr_btn==true)
		{
			$_REQUEST['cmbRoles']="" ;
			$_REQUEST['cmbPermissions']="";
		}
	}
	else
	{
		$id=$_SESSION['edit_click'];
		$sql = "SELECT * FROM role_permission where id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$p_id=$row["permissionid"];
		$r_id=$row["roleId"];
		
		
		if(isset($_REQUEST['save']))
		{
			$role_id=$_REQUEST['cmbRoles'];		
			$perm_id=$_REQUEST['cmbPermissions'];
			$sql="update role_permission set roleid='$role_id',permissionid= '$perm_id' where id='$id'";
			$result = mysqli_query($conn, $sql);
			header("Location:RolePermList.php");
		}
}
		$clr_btn=isset($_REQUEST['clr']);
		if($clr_btn==true)
		{
			$_REQUEST['cmbRoles']="" ;
			$_REQUEST['cmbPermissions']="";
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
<h2>Permission Assignment</h2>

<tr><b>Role:</b> <select name="cmbRoles">
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
			else{
			echo "<option value='$id'>$name</option>";
			}
		}	
	}				
	?>
</select></tr><br><br>
<tr> <b>Permission:</b><select name="cmbPermissions">
<?php 
		$q1 = "SELECT * FROM permissions";
		$result = mysqli_query($conn, $q1);
		$recordsFound = mysqli_num_rows($result);			
		if ($recordsFound > 0) {
		while($row = mysqli_fetch_assoc($result)) {		
			$id = $row["permissionid"];
			$name = $row["name"];
			if($p_id==$id)
			{
			echo "<option value='$id' selected>$name</option>";
			}
			else{
				echo "<option value='$id'>$name</option>";
			}
		}	
	}				
	?>
</select>
</tr>
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
