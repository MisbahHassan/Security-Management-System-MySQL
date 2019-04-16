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
		header('Location:Role_Permission_Assignment.php');
	}
	if(isset($_REQUEST['delete'])==true)
	{
		$id=$_REQUEST['delete'];
		$q="delete from role_permission where id='$id'";
		$res=mysqli_query($conn, $q);
	}
	if(isset($_REQUEST['newUser'])==true)
	{
		$_SESSION['edit_click']=-1;
		header('Location:Role_Permission_Assignment.php');
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
    <th>Role</th> 
    <th>Description</th>
	<th>Permission</th>
	<th>Description</th>
	</tr>
	<?php $query="Select * from role_permission";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		$id=$data['id'];
		echo "<td>".$id."</td>";
		
		$role_id=$data['roleId'];
		$q1="Select * from roles where roleId='$role_id'";
		$role = mysqli_query($conn, $q1);
		$d1= mysqli_fetch_assoc($role);		
		echo "<td>".$d1['name']."</td>";
		echo "<td>".$d1['description']."</td>";

		$prem_id=$data['permissionid'];
		$q2="Select * from permissions where permissionid='$prem_id'";
		$prem = mysqli_query($conn, $q2);
		$d2 = mysqli_fetch_assoc($prem);		
		echo "<td>".$d2['name']."</td>";
		echo "<td>".$d2['description']."</td>";

		echo "<td><button type='submit' name='edit' value='$id'> Edit </button></td>";
		echo "<td><button type='submit' name='delete' value='$id'> DELETE </button></td>";
		echo "</tr>";
		}
	}
	?>

</table>
</form>
<br><br>
<form action="Role_Permission_Assignment.php">
<input type='submit' name='newUser' value = 'Create New Role Permission'>
</form>
</body>
</html>
