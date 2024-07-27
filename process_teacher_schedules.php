<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $teacherName = $_POST['teacher_name'];
    $availableCourses = $_POST['available_courses'];
    $availableDays = $_POST['available_days'];
    $timeSlots = $_POST['time_slots'];

    // Sanitize inputs
    $teacherName = filter_var($teacherName, FILTER_SANITIZE_STRING);
    $availableCourses = filter_var($availableCourses, FILTER_SANITIZE_STRING);
    $availableDays = filter_var($availableDays, FILTER_SANITIZE_STRING);
    $timeSlots = filter_var($timeSlots, FILTER_SANITIZE_STRING);

    // Save teacher schedule to the database
    $stmt = $conn->prepare("INSERT INTO teachers (name, available_courses, available_days) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $teacherName, $availableCourses, $availableDays);
    $stmt->execute();
    $teacherId = $stmt->insert_id;

    $days = explode(',', $availableDays);
    $courses = explode(',', $availableCourses);
    $timeSlotsArray = explode(',', $timeSlots);

    foreach ($days as $day) {
        foreach ($courses as $course) {
            foreach ($timeSlotsArray as $timeSlot) {
                $stmt = $conn->prepare("INSERT INTO teacher_schedules (teacher_id, day, course, time_slot) VALUES (?, ?, ?, ?)");
              //  $stmt->bind_param("isss", $teacherId, trim($day), trim($course), trim($timeSlot));
                $stmt->execute();
            }
        }
    }

    // Redirect back to the main page
    header("Location: index.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
