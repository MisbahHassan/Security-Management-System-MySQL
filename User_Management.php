<?php require('conn.php');
			session_start();	?>
<html>
<head>
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
    background-color:#008CBA;
}
    </style>

	<?php
	if($_SESSION['edit_click']==-1)
	{
		$save_btn=isset($_REQUEST['save']);
		$flag=true;
		$log="";
		$name="";
		$email="";
		$paswd="";
		$ctry="";
		$adm=0;
		$ctry_name="";
		if($save_btn==true)
		{		
			$login=$_REQUEST['login_txt'];
			$password=$_REQUEST['pass_txt'];
			$email=$_REQUEST['email_txt'];
			$name=$_REQUEST['name_txt'];
			$country=$_REQUEST['country'];
			$adminChk=isset($_REQUEST['is_admin']);
			$createBy=$_SESSION['login_id'];
			$createOn=date("Y-m-d h:i:s");
			$q="Select * from users";
			$res = mysqli_query($conn, $q);
			$noOfRecords = mysqli_num_rows($res);
			if($noOfRecords>0)
			{
			while($data = mysqli_fetch_assoc($res)) {
				if($data['login']==$login || $data['email']==$email)
				{
					$flag=false;
				}
				}
			}
			if($flag==false)
			{
				echo "<script>alert('Login or Email already exists');</script>";
			}
			else{
			if($adminChk==true)
			{
				$isadmin=1;
			}
			else
			{
				$isadmin=0;
			}
			$sql="insert into users (login,password,email,name,countryid,isadmin,createdon,createdby) 
			values ('$login','$password','$email','$name','$country','$isadmin','$createOn','$createBy')";
			$result = mysqli_query($conn, $sql);
			header("Location:UserList.php");
			}
		}
	}
	else{
		$id=$_SESSION['edit_click'];
		$sql = "SELECT * FROM users where userid='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$name=$row["name"];
		$email=$row["email"];
		$paswd=$row["password"];
		$log=$row["login"];
		$adm=$row['isadmin'];
		$ctry=$row['countryid'];
		
		if(isset($_REQUEST['save'])==true){
		
			$login=$_REQUEST['login_txt'];
			$password=$_REQUEST['pass_txt'];
			$email=$_REQUEST['email_txt'];
			$name=$_REQUEST['name_txt'];
			$country=$_REQUEST['country'];
			$adminChk=isset($_REQUEST['is_admin']);	
			
			$sql2 = "update users set login = '$login', password = '$password', email = '$email', name = '$name',
			isadmin = '$adminChk', countryid = '$country' where userid = '$id'";
			$result1 = mysqli_query($conn, $sql2);
			
			if($result1)
				header("Location:UserList.php");
			
	}
		
	}
		$clr_btn=isset($_REQUEST['clr']);
		if($clr_btn==true)
		{
			$_REQUEST['login_txt']="" ;
			$_REQUEST['pass_txt']="";
			$_REQUEST['email_txt']="";
			$_REQUEST['name_txt']="";
			$_REQUEST['is_admin']=false;
			header("Refresh:0");
		}
	?>
</head>
<form>
<body bgcolor="lightblue">

    <div class="topnav">
        <a href="Admin.php"> Home </a> </td>
        <a href="UserList.php">User Management</a>
        <a href="RoleList.php">Role Managment</a>
        <a href="PermissionList.php">Permission Management</a>
        <a href="RolePermList.php">Role Permission Assingment</a>
        <a href="UserRoleList.php">User Role Assignment</a>
		 <a href="Login_History.php">LoginHistory</a>
		 <a href="Logout.php">LogOut</a>
    </div>
    <table>
        <h2>User Management</h2>
        <tr><b>Login:</b><br><input type='text' name='login_txt' value="<?php echo $log; ?>" required></tr>
        <br>
        <tr><b> Password: </b><br><input type='password' name='pass_txt' value="<?php echo $paswd; ?>" required></tr>
        <br>
        <tr><b> Name: </b><br><input type='text' name='name_txt' value="<?php echo $name; ?>" required></tr>
        <br>
        <tr><b> Email:</b> <br><input type='email' name='email_txt' value="<?php echo $email; ?>" required></tr>
        <span></span>
        <br>
        <br>
        <tr><b> Country: </b><select name="country" id="country">				
	<?php 
	$sql = "SELECT countryid,Name FROM country";
	$result = mysqli_query($conn, $sql);
	$recordsFound = mysqli_num_rows($result);			
	if ($recordsFound > 0) {
		while($row = mysqli_fetch_assoc($result)) {		
			$id = $row["countryid"];
			$name = $row["Name"];
			if($id==$ctry)
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
		<tr>
		<input type="checkbox" name="is_admin" <?php echo ($adm==1 ? 'checked' : '');?>><b>Is Admin?</b><br>
		</tr>
        <tr>
            <td><input type="submit" class="button"  name="save" value='Save'></td>
            <td><input type="submit" class="button"  name="clr" value='Clear'></td>
        </tr>

    </table>

   </form>
</body>
</html>
