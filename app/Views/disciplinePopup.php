<?php
    session_start();
    require_once __DIR__ . '/../Models/Database.php';
    require_once __DIR__ . '/../Models/Course.php';
    use App\Models\Database;
    use App\Models\Course;
    $database = new Database();
    $db = $database->connect();
    
    $courseModel = new Course($db);
    $course = $courseModel->getAllCourses();
?>
<h2>Add a new discipline</h2>
<form
  class="schoolForm__discipline"
  action="index.php?router=discipline&action=add"
  method="post"
>
  <div>
    <label for="disciplineName">Name:</label>
    <input
      type="text"
      id="disciplineName"
      name="disciplineName"
      placeholder="Ex: English"
      required
    />
  </div>
  <div>
    <label for="disciplineDescription">Description:</label>
    <input
      type="text"
      id="disciplineDescription"
      name="disciplineDescription"
      placeholder="Ex: lorem ipsum dolor sit amet"
      required
    />
  </div>
  <div>
    <label for="disciplineModality">Modality:</label>
    <select id="disciplineModality" name="disciplineModality">
        <option value="EAD" selected>EAD</option>
        <option value="Hybrid">Hybrid</option>
        <option value="Classroom lesson">Classroom lesson</option>
    </select>
  </div>
  <div>
    <label for="courseId">Select Course:</label>
    <select id="courseId" name="courseId" required>
      <option value="">Select a course</option>
      <?php
      while ($row = $course->fetch(PDO::FETCH_ASSOC)) {
          $courseId = htmlspecialchars($row['courseId']);
          $courseName = htmlspecialchars($row['courseName']);
          echo "<option value=\"{$courseId}\">{$courseName}</option>";
      }
      ?>
    </select>
  </div>
  <div>
    <button type="submit">Add</button>
  </div>
</form>