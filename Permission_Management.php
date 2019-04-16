<?php require('conn.php');
			session_start();	?>
<html>  
    <head>
<title> Permission Management</title>
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
	$p="";
	$des="";
		$save_btn=isset($_REQUEST['save']);
		if($save_btn==true)
		{		
			$per=$_REQUEST['per_txt'];
			$descrp=$_REQUEST['des_txt'];
			$createBy=$_SESSION['login_id'];
			$createOn=date("Y-m-d h:i:s");
			$sql="insert into permissions (name,description,createdon,createdby) values ('$per','$descrp','$createOn','$createBy')";
			$result = mysqli_query($conn, $sql);
			header("Location:PermissionList.php");
		}
		$clr_btn=isset($_REQUEST['clr']);
		if($clr_btn==true)
		{
			$_REQUEST['per_txt']="" ;
			$_REQUEST['des_txt']="";
		}
}
		else
		{
			$id=$_SESSION['edit_click'];
			$sql1 = "SELECT * FROM permissions where permissionid='$id'";
			$results = mysqli_query($conn, $sql1);
			$rows = mysqli_fetch_assoc($results);
			$p=$rows["name"];
			$des=$rows["description"];
			if(isset($_REQUEST['save'])==true){
				$p=$_REQUEST['per_txt'];	
				$des=$_REQUEST['des_txt'];
			$sql = "update permissions set name = '$p', description = '$des' where permissionid = '".$id."'";
			$result = mysqli_query($conn, $sql);
			if($result)
				header("Location:PermissionList.php");
			}
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
<h2>Permission Management</h2>
<tr><b>Permission Name: </b><br><input type='text' name='per_txt' value="<?php echo $p; ?>" required></tr><br>
<tr><b> Description:</b> <br><input type='text' name='des_txt' value="<?php echo $des; ?>" required></tr><br>

<tr>
            <td><input type="submit" class="button" name='save' id='save' value='Save'></td>
            <td><input type="submit" class="button" name='clr' id='clr' value='Clear'></td>
        </tr>

</table>
</form>
</body>
</html>
