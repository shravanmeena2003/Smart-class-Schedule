<?php
include 'db_connect.php';
include 'generate_schedule.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $courses = $_POST['courses'];
    $activities = $_POST['activities'];
    $study_habits = $_POST['study_habits'];

    // Sanitize inputs
    $courses = filter_var($courses, FILTER_SANITIZE_STRING);
    $activities = filter_var($activities, FILTER_SANITIZE_STRING);
    $study_habits = filter_var($study_habits, FILTER_SANITIZE_STRING);

    // Save preferences to the database
    $stmt = $conn->prepare("INSERT INTO preferences (courses, activities, study_habits) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $courses, $activities, $study_habits);
    $stmt->execute();

    // Fetch teacher schedules
    $teacherSchedules = [];
    $result = $conn->query("SELECT teachers.name AS teacher, teacher_schedules.day, teacher_schedules.course, teacher_schedules.time_slot FROM teacher_schedules JOIN teachers ON teacher_schedules.teacher_id = teachers.id");
    while ($row = $result->fetch_assoc()) {
        $teacherSchedules[] = $row;
    }

    // Generate schedule
    $schedule = generateSchedule($courses, $activities, $study_habits, $teacherSchedules);

    // Redirect back to the main page with the schedule
    header("Location: index.php?schedule=" . urlencode($schedule));
    exit();
} else {
    echo "Invalid request method.";
}
?>
