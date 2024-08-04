<?php
    session_start();
    require_once __DIR__ . '/../Models/Database.php';
    require_once __DIR__ . '/../Models/Hub.php';
    use App\Models\Database;
    use App\Models\Hub;
    $database = new Database();
    $db = $database->connect();
    
    $hubModel = new Hub($db);
    $hub = $hubModel->getAllHubs();
?>
<h2>Add a new course</h2>
<form
  class="schoolForm__course"
  action="index.php?router=course&action=add"
  method="post"
>
  <div>
    <label for="courseName">Name:</label>
    <input
      type="text"
      id="courseName"
      name="courseName"
      placeholder="Ex: Computer Science"
      required
    />
  </div>
  <div>
    <label for="courseDescription">Description:</label>
    <input
      type="text"
      id="courseDescription"
      name="courseDescription"
      placeholder="Ex: lorem ipsum dolor sit amet"
      required
    />
  </div>
  <div>
    <label for="courseType">Type:</label>
    <select id="courseType" name="courseType">
        <option value="Bachelor degree" selected>Bachelor degree</option>
        <option value="Master's degree" selected>Master's degree</option>
        <option value="Doctorate degree" selected>Doctorate degree</option>
        <option value="Technologist">Technologist</option>
    </select>
  </div>
  <div>
    <label for="hubId">Select hub:</label>
    <select id="hubId" name="hubId" required>
      <option value="">Select a hub</option>
      <?php
      while ($row = $hub->fetch(PDO::FETCH_ASSOC)) {
          $hubId = htmlspecialchars($row['hubId']);
          $hubName = htmlspecialchars($row['hubName']);
          echo "<option value=\"{$hubId}\">{$hubName}</option>";
      }
      ?>
    </select>
  </div>
  <div>
    <button type="submit">Add</button>
  </div>
</form>
