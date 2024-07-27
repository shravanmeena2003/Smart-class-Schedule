CREATE DATABASE smart_scheduling_system;

USE smart_scheduling_system;

CREATE TABLE preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    courses VARCHAR(255),
    activities VARCHAR(255),
    study_habits VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    available_courses VARCHAR(255),
    available_days VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE teacher_schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT,
    day VARCHAR(50),
    course VARCHAR(255),
    time_slot VARCHAR(255),
    FOREIGN KEY (teacher_id) REFERENCES teachers(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
