<?php

class UserController
{
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['info' => 'Invalid JSON input']);
            return;
        }

        if (!isset($data['username']) || !isset($data['password'])) {
            http_response_code(400);
            echo json_encode(['info' => 'Username and password are required']);
            return;
        }

        $user = $this->userModel->findByUsername($data['username']);
        if ($user && password_verify($data['password'], $user['password'])) {
            http_response_code(200);
            echo json_encode(['info' => 'Login successful', 'user' => [
                'id' => $user['id'],
                'username' => $user['username']
            ]]);
        } else {
            http_response_code(401);
            echo json_encode(['info' => 'Invalid username or password']);
        }
    }

    public function register() {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['info' => 'Invalid JSON input']);
            return;
        }

        if (!isset($data['username']) || !isset($data['password'])) {
            http_response_code(400);
            echo json_encode(['info' => 'Username and password are required']);
            return;
        }

        $userId = $this->userModel->create($data);
        if(!$userId) {
            http_response_code(500);
            echo json_encode(['info' => 'Failed to create user']);
            return;
        }
        $user = $this->userModel->findById($userId);
        if ($user) {
            http_response_code(201);
            echo json_encode(['info' => 'User created successfully', 'user' => [
                'id' => $user['id'],
                'username' => $user['username']
            ]]);
        } else {
            http_response_code(500);
            echo json_encode(['info' => 'Failed to create user']);
        }
    }
}

?>