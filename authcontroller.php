<?php
include "config.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


class users{

function signup($data){ 
    {
            $first_name = $data['first_name'];
            $middle_name = $data['middle_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $password = $data['password'];
            $role = $data['role'];
            global $connection;
            $token = password_hash($email, PASSWORD_DEFAULT);
     

            $stmt = $connection->prepare("INSERT INTO users (first_name,middle_name,last_name,email,password,role,token) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", $first_name, $middle_name, $last_name, $email, $password, $role, $token);
            if ($stmt->execute()) {

                $array = [
                    'email' => $email,
                    'token' => $token
                ];


                $this->activationlink($array);
                header("location:../pages/login.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }


    function activationlink($array)
    {

        $email = $array['email'];
        $token = $array['token'];
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'allseasonkb28@gmail.com';
        $mail->Password   = 'aerlrdawczbdhnsp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('allseasonkb28@gmail.com', 'activation link');
        $mail->addAddress($email);
        // Content
        $link = 'http://localhost:3000/controller/data.php?token=' . $token . '&email=' . $email;

        $mail->isHTML(true);
        $mail->Subject = 'activation link';
        $mail->Body    = "Click this link to activate your account. <a href='" . $link . "'>" . $link . "</a>";
        $mail->AltBody = "Click this link to activate your account. <a href='" . $link . "'>" . $link . "</a>";;
        $mail->send();
    }

    function signupValidate($array)
    {

        $email = $array['email'];
        $token = $array['token'];
       //var_dump($array);
        global $connection;

        $result = $connection->query("SELECT token FROM users WHERE email='$email' AND token ='$token'");
        $stmt = $result->fetch_assoc();

        if ($stmt > 0) {


            $connection->query("UPDATE users SET is_verified =1 WHERE email='$email'");
            header('location:../pages/login.php');
        }
    }

function emptyField($array)
{

    $errors = [];


        if (empty($array['first_name'])) {
            $errors['first_name'] = 'field is required';
        }
        if (empty($array['last_name'])) {
            $errors['last_name'] = 'field is required';
        }
        if (empty($array['email'])) {
            $errors['email'] = 'field is required';
        }
        if (empty($array['password'])) {
            $errors['password'] = 'field is required';
        }
        if (strcmp($array['password'], $array['confirm_password'])) {
            $errors['confirmpassword'] = 'password does not match';
        }



        if (!empty($array['email'])) {
            global $connection;
            $email = trim($array['email']);
            $result = $connection->query("SELECT count(email) as email_count FROM users WHERE email ='$email'");
            // $stmt->bind_param('s',$email);
            //$stmt->execute();
            $count = $result->fetch_assoc();

            if ($count['email_count'] > 0) {

                $errors['email'] = $email . ' email  already exists';
            }
        }
       
        return $errors;
    }



function Login($array)
{

        global $connection;
        $email = strip_tags($array['email']);
        $password = strip_tags($array['password']);
      
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? AND is_verified=1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $set = $result->fetch_assoc();
       
        if (!empty($set)) {

            if (password_verify($password, $set['password'])) {
                if ($set['role'] == 2) {
                    $id= hash('sha256',$email.$password);
                     setcookie("session_id",$id,time()+3600,'/',httponly:true);
                     $_SESSION['email']=$email;
                    header("location:../pages/seller.php");
                    exit();
                };
                if ($set['role'] == 1) {
                    $id= hash('sha256',$email.$password);
                    setcookie("session_id",$id,time()+3600,'/',httponly:true);
                    $_SESSION['email']=$email;
                    header("location:../pages/admin.php");
                    exit();
                };
                if ($set['role'] == 3) {
                    $id= hash('sha256',$email.$password);
                    setcookie("session_id",$id,time()+3600,'/',httponly:true);
                    $_SESSION['email']=$email;
                    header("location:../index.php");
                    exit();
                };
            } else {

                header("location:../pages/login.php");
            }
        } else {

            header("location:../pages/login.php");
        }
    }

function forget(&$array)
{
        $email = $array['email'];
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'allseasonkb28@gmail.com';
        $mail->Password   = 'aerlrdawczbdhnsp';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('allseasonkb28@gmail.com', 'Mailer');
        $mail->addAddress($email);



        $result = rand(100000, 999999);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = 'This is your OTP: <b>' . $result . '</b>. It expires in 15 minutes.';
        $mail->AltBody = 'This is your OTP: ' . $result . '. It expires in 15 minutes.';

        // Send email
        if ($mail->send()) {
            // After successful send, check if email exists in DB
            global $connection;
            $stmt = $connection->prepare("SELECT COUNT(email) as count FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultStmt = $stmt->get_result();
            $row1 = $resultStmt->fetch_assoc();
            $count1 = $row1['count'];

            if ($count1 == 0) {


                header("location:../pages/forget.php");
                exit();
            } else {

                $date = gmdate("Y-m-d H:i:s");
                $date2 = '15 minutes';
                $time = strtotime($date . "+" . $date2);
                $otp_time = date("Y-m-d H:i:s", $time);

                $stmt2 = $connection->prepare("UPDATE users SET password_reset_code= ?,password_reset_code_expiry = ? WHERE email = ?");
                $stmt2->bind_param("sss", $result, $otp_time, $email);
                $stmt2->execute();
                $_SESSION['email'] = $email;

                header("location:../pages/changepassword.php");
                exit();
            }
        }
    }


    function changePassword($array)
    {
        $email = $array['email'];
        $password = $array['password'];
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $otp = $array['otp'];
        global $connection;
      
       $row =$connection->query("SELECT password_reset_code FROM users WHERE email='$email' ");
       $result=$row->fetch_assoc();
       if($result['password_reset_code']==$otp){
        $connection->query("UPDATE users SET  password='$hash' WHERE email='$email' and password_reset_code ='$otp'");
        header('location:../pages/login.php');
    } else {
        echo $wrong="wrong otp";
        
    }

      
    }
}

$user = new users();

