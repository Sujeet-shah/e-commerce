<?php
include 'authcontroller.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Signup process
        $data = $user->emptyField($_POST);

        if (empty($data) && $_POST['action'] = 'signup') {
            $first_name = strip_tags(trim($_POST['first_name']));
            $middle_name = strip_tags(trim($_POST['middle_name']));
            $last_name = strip_tags(trim($_POST['last_name']));
            $email = strip_tags(trim($_POST['email']));
            $password = password_hash(strip_tags(trim($_POST['password'])), PASSWORD_DEFAULT);
            $role = strip_tags(trim($_POST['role']));

            $array = [
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $password,
                'role' => $role
            ];

            $user->signup($array);
        } else {
            echo json_encode($data);   
            return $data;
        }
    } else if (isset($_POST['email']) && isset($_POST['password']) && $_POST['action'] = 'login') {
        // Login process

        $email = strip_tags(trim($_POST['email']));
        $password = strip_tags(trim($_POST['password']));

        $data = [
            'email' => $email,
            'password' => $password,
        ];
     
        $user->Login($data);
    } else if (isset($_POST['email']) && $_POST['action'] = 'forget') {
        //forget password otp
        $data = [
            'email' => $_POST['email']
        ];
        $user->forget($data);
        // } else if (isset($_POST['otp']) && isset($_POST['new_password'])  && $_POST['action'] = 'changepassword') {
        //     //change passwword

        //     $data = [
        //         'email' => $_SESSION['email'],
        //         'otp' => $_POST['otp'],
        //         'password' => $_POST['password']
        //     ];

        //     $user->changePassword($data);
        // } else {
        //     echo json_encode(['error' => 'Invalid request']);
        // }
    }
}




if ($_SERVER['REQUEST_METHOD'] = 'GET') {
    if (isset($_GET['token'])) {
        $email = $_GET['email'];
        $token = $_GET['token'];
        $array = [
            'email' => $email,
            'token' => $token
        ];

        $user->signupValidate($array);
    }
}




if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    if (isset($_POST['otp']) && isset($_POST['new_password']) && $_POST['action'] = 'changepassword') {
        //change passwword

        $data = [
            'email' => $_SESSION['email'],
            'otp' => $_POST['otp'],
            'password' => $_POST['new_password']
        ];

        $user->changePassword($data);
    }
}
