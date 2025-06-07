<?php

class MessageController
{
    private $messageModel;

    public function __construct() {
        $this->messageModel = new Message();
    }

    public function getAllMessages() {
        $messages = $this->messageModel->getAll();
        echo json_encode($messages);
    }

    public function createMessage() {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(['info' => 'Invalid JSON input']);
            return;
        }

        if (!isset($data['username']) || !isset($data['message'])) {
            http_response_code(400);
            echo json_encode(['info' => 'Username and message are required']);
            return;
        }

        $message = $this->messageModel->create($data);
        $message = $this->messageModel->findById($message);
        if ($message) {
            http_response_code(201);
            echo json_encode(['info' => 'Message created successfully', 'message' => $message]);
        } else {
            http_response_code(500);
            echo json_encode(['info' => 'Failed to create message']);
        }
    }
}

?>