<?php require('conn.php');
			session_start();	?>
<html>
<head>

<style>
table, th, td {
    border: 2px groove black;
    border-collapse: collapse;
	align:center;
	
}
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
</head>

<?php
	if(isset($_REQUEST['edit'])==true)
	{
		$id=$_REQUEST['edit'];
		$_SESSION['edit_click']=$id;
		header('Location:User_Management.php');
	}
	if(isset($_REQUEST['delete'])==true)
	{
		$id=$_REQUEST['delete'];
		$q="delete from users where userid='$id'";
		$res=mysqli_query($conn, $q);
	}
	if(isset($_REQUEST['newUser'])==true)
	{
		$_SESSION['edit_click']=-1;
		header('Location:User_Management.php');
	}

?>
<body>
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
<form>
<table cellpadding="8">
  <tr>
    <th>ID</th>
    <th>Name</th> 
    <th>Email</th>
	<th>Country</th>
	<th>Created On</th>
	<th>Created By</th>
	<th>Is Admin</th>
	</tr>
	<?php $query="Select * from users";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$user_id=$data['userid'];
		echo "<td>".$user_id."</td>";
		echo "<td>".$data['name']."</td>";
		echo "<td>".$data['email']."</td>";
		$ctry=$data['countryid'];
		$q="Select * from country where countryid='$ctry'";
		$country = mysqli_query($conn, $q);
		$d = mysqli_fetch_assoc($country);	
		echo "<td>".$d['Name']."</td>";
		echo "<td>".$data['createdon']."</td>";
		echo "<td>".$data['createdby']."</td>";	
		if($data['isadmin']==1)
		{
			echo "<td>Yes</td>";	
		}
		else
		{
			echo "<td>No</td>";	
		}
		echo "<td><button type='submit' name='edit' value='$user_id'> Edit </button></td>";
		echo "<td><button type='submit' name='delete' value='$user_id'> DELETE </button></td>";
		echo "</tr>";
		}
	}
	?>

</table>
</form>
<br><br>
<form>
<input type='submit' name='newUser' value = 'Create New User'>
</form>
</body>
</html>
