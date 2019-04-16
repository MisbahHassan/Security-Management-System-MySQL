
<html>
    <head>
        <title> Login Form </title>
        <?php require('conn.php');
        session_start();
        ?>
<?php
        $error = "";
        if (isset($_REQUEST['btn1']) == true) {
		
            $login = $_REQUEST["txt1"];
            $password = $_REQUEST["txt2"];
            $sql = "SELECT * FROM users where login='" . $login . "' AND password='" . $password . "'";
            $result = mysqli_query($conn, $sql);
		
            $noOfRecords = mysqli_num_rows($result);
            if ($noOfRecords > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
					$ulogin = $_REQUEST["txt1"];
					$logintime = date("Y-m-d h:i:s");
					$ip = $_SERVER['REMOTE_ADDR'];
					$u_id=$data['userid'];
					$sql1="insert into login_history (userid,login,logintime,machineip) values ('".$u_id."','".$ulogin."','".$logintime."','".$ip."')";
					$result2 = mysqli_query($conn, $sql1);
                    $isAdmin = $data['isadmin'];
                    if ($isAdmin == 1) {
						$_SESSION['login_id'] = $data['userid'];
                        $_SESSION['is_admin'] = 1;
						header("Location:Home.php");
                    } else {
                        $_SESSION['login_id'] = $data['userid'];
                        $_SESSION['is_admin'] = 0;
						
                       header("Location:Home.php");
                    }
                }
            } else {
                $error = "Wrong Email or Password";
            }
        }
        ?>
        <style>

            body {
                font: 13px/20px 'Lucida Grande', Tahoma, Verdana, sans-serif;
                color: #404040;
                background: #FBAE87;
            }

            .container {
                margin: 80px auto;
                width: 640px;
            }

            .login {
                position: relative;
                margin: 0 auto;
                padding: 20px 20px 20px;
                width: 310px;
                background: white;
                border-radius: 7px;


                &:before {
                    content: '';
                    position: absolute;
                    top: -8px; right: -8px; bottom: -8px; left: -8px;
                    z-index: -1;
                    background: rgba(black, .08);
                    border-radius: 4px;
                }

                h1 {
                    margin: -20px -20px 21px;
                    line-height: 40px;
                    font-size: 15px;
                    font-weight: bold;
                    color: #555;
                    text-align: center;
                    text-shadow: 0 1px white;
                    background: #f3f3f3;
                    border-bottom: 1px solid #cfcfcf;
                    border-radius: 3px 3px 0 0;
                    @include linear-gradient(top, whiteffd, #eef2f5);
                    @include box-shadow(0 1px #f5f5f5);
                }

                p { margin: 20px 0 0; }
                p:first-child { margin-top: 0; }

                input[type=text], input[type=password] { width: 278px; }

                p.remember_me {
                    float: left;
                    line-height: 31px;

                    label {
                        font-size: 12px;
                        color: #777;
                        cursor: pointer;
                    }

                    input {
                        position: relative;
                        bottom: 1px;
                        margin-right: 4px;
                        vertical-align: middle;
                    }
                }

                p.submit { text-align: right; }
            }

            .login-help {
                margin: 20px 0;
                font-size: 11px;
                color: white;
                text-align: center;
                text-shadow: 0 1px #2a85a1;

                a {
                    color: #cce7fa;
                    text-decoration: none;

                    &:hover { text-decoration: underline; }
                }
            }

            :-moz-placeholder {
                color: #c9c9c9 !important;
                font-size: 13px;
            }

            ::-webkit-input-placeholder {
                color: #ccc;
                font-size: 13px;
            }

            input {
                font-family: 'Lucida Grande', Tahoma, Verdana, sans-serif;
                font-size: 14px;
            }

            input[type=text], input[type=password] {
                margin: 5px;
                padding: 0 10px;
                width: 200px;
                height: 34px;
                color: #404040;
                background: white;
                border: 1px solid;
                border-color: #c4c4c4 #d1d1d1 #d4d4d4;
                border-radius: 2px;
                outline: 5px solid #eff4f7;
                -moz-outline-radius: 3px; // Can we get this on WebKit please?
                @include box-shadow(inset 0 1px 3px rgba(black, .12));

                &:focus {
                    border-color: #7dc9e2;
                    outline-color: #dceefc;
                    outline-offset: 0; // WebKit sets this to -1 by default
                }
            }

            input[type=submit] {
                padding: 0 18px;
                height: 29px;
                font-size: 12px;
                font-weight: bold;
                color: #527881;
                text-shadow: 0 1px #e3f1f1;
                background: #cde5ef;
                border: 1px solid;
                border-color: #b4ccce #b3c0c8 #9eb9c2;
                border-radius: 16px;
                outline: 0;
            </style>
        </head>
        <body>
            <h1 align="center"> Security Manager</h1>
            <section class="container">
                <div class="login">
                    <h1>Login</h1>
                    <form>
                        <p><input type="text" id="txt11" value="" name="txt1" placeholder="Username or Email"></p>
                        <p><input type="password" id="txt2" value="" name="txt2" placeholder="Password"></p>
                        <input class="submit" type="submit" name="btn1" id="btn" value="Login">
                        <span style="color:red">
						<?php echo $error ?>
                        </form>

                    </div>
                </section>        
            </body>
        </html>



