document.getElementById('preferences-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form values
    const courses = document.getElementById('courses').value.split(',').map(course => course.trim());
    const activities = document.getElementById('activities').value.split(',').map(activity => activity.trim());
    const studyHabits = document.getElementById('study-habits').value.split(',').map(habit => habit.trim());

    const schedule = generateSchedule(courses, activities, studyHabits);

    // Display the schedule
    displaySchedule(schedule);
});

function generateSchedule(courses, activities, studyHabits) {
    // Placeholder function for AI-based schedule generation
    const schedule = {
        Monday: [courses[0] || "Course1", activities[0] || "Activity1", studyHabits[0] || "Study"],
        Tuesday: [courses[1] || "Course2", activities[1] || "Activity2", studyHabits[1] || "Study"],
        Wednesday: [courses[2] || "Course3", activities[0] || "Activity1", studyHabits[2] || "Study"],
        Thursday: [courses[0] || "Course1", activities[1] || "Activity2", studyHabits[0] || "Study"],
        Friday: [courses[1] || "Course2", activities[0] || "Activity1", studyHabits[1] || "Study"]
    };

    return schedule;
}

function displaySchedule(schedule) {
    const scheduleOutput = document.getElementById('schedule-output');
    scheduleOutput.innerHTML = '';

    for (const day in schedule) {
        const daySchedule = schedule[day];
        const dayElement = document.createElement('div');
        dayElement.classList.add('day-schedule');
        dayElement.innerHTML = `<strong>${day}</strong>: ${daySchedule.join(', ')}`;
        scheduleOutput.appendChild(dayElement);
    }
}
