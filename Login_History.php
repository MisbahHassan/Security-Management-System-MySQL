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
    <th>User ID</th> 
	<th>Login</th>
	<th>Login Time</th>
	<th>Machine IP</th>
	</tr>
	<?php
	$query="Select * from login_history";
	$result = mysqli_query($conn, $query);
	$noOfRecords = mysqli_num_rows($result);
	if($noOfRecords>0)
	{
		while($data = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>".$data['id']."</td>";
		$user_id=$data['userid'];
		echo "<td>".$user_id."</td>";		
		echo "<td>".$data['login']."</td>";
		echo "<td>".$data['logintime']."</td>";
		echo "<td>".$data['machineip']."</td>";
		echo "</tr>";
		}
	}
	?>

</table>
</form>
<br><br>

</body>
</html>
