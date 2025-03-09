<?php
require_once '../repositories/studRepository.php';
require_once '../core/response.php';

class studController {
    private $repositories;

    public function __construct($db) {
        $this->repositories = new studRepository($db);
    }

    public function getAllStudents() {
        $studRepository = $this->repositories->getAllStudents();
        response::json($studRepository);
    }

    public function getStudentById($id) {
        $studRepository = $this->repositories->getStudentById($id);
        if ($studRepository) {
            response::json($studRepository);
        } else {
            response::json(["message" => "Student not found."], 404);
        }
    }

    public function addStudent($data) {
        if (isset($data['STUD_NAME'], $data['MID_SCORE'], $data['FINAL_SCORE'])) {
            $this->repositories->addStudent($data['STUD_NAME'], $data['MID_SCORE'], $data['FINAL_SCORE']);
            response::json(["message" => "Student added successfully."]);
        } else {
            response::json(["message" => "Invalid input."], 400);
        }
    }

    public function updateStudent($data) {
        if (isset($data['STUD_ID'], $data['MID_SCORE'], $data['FINAL_SCORE'])) {
            $this->repositories->updateStudent($data['STUD_ID'], $data['MID_SCORE'], $data['FINAL_SCORE']);
            response::json(["message" => "Student updated successfully."]);
        } else {
            response::json(["message" => "Invalid input."], 400);
        }
    }

    public function deleteStudent($id) {
        $this->repositories->deleteStudent($id);
        response::json(["message" => "Student deleted successfully."]);
    }
}
?>