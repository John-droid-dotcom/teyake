<?php
include_once "../database.php";



if(!isset($_GET["exam-key"])){
  header('Location: /teyake/index.php');
}

$exam_key = $_GET["exam-key"];

$dummy_key = $exam_key;

$retrieve_exam_query = "SELECT * FROM exam WHERE ExamKey = " . $exam_key;
$retrieve_exam_row = mysqli_query($conn, $retrieve_exam_query);
if (!mysqli_num_rows($retrieve_exam_row)) {
  header('Location: /teyake/index.php?exam=none');
}

$retrieve_institution_query = "SELECT Name, ID FROM institution";
$retrieve_institution_result = mysqli_query($conn, $retrieve_institution_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/takeexam.css">
</head>
<body>
    <div class="container">
    <div class="modal">
      <div class="modal-content">
        <h1 style="text-align: center">Enter Exam</h1>
        <form action="/teyake/takeexam/takeexam.php" method="POST" class="flex flex-col gap-4">
          <input type="text" placeholder="Name" id="student-name" name="examineeName" required value="Yohannes Assefa"/>
          <input type="email" placeholder="Email" id="student-email" name="examineeEmail" required  value="mail@mail.com"/>
          <input type="text" placeholder="ID" id="student-id" name="examineeID" required value="123"/>
          <select name="sex" id="sex">
            <option value="" disabled>Gender</option>
            <option value="M" selected>Male</option>
            <option value="F">Female</option>
          </select>
          <select name="institution" id="institution">
            <option value="" disabled selected>Institution</option>
            <?php 
              while($row = mysqli_fetch_assoc($retrieve_institution_result)){
                echo "<option value=\"".$row["ID"]."\">".$row["Name"]."</option>";
              }
              ?>
              <option value="none">Not Listed</option>
          </select>
          <input type="text" placeholder="Section" id="student-section" name="examineeSection" maxlength="1" value="D"/>
          <input type="text" placeholder="Key" id="exam-key" name="examKey" value = "<?php echo $dummy_key ?>" disabled/>
          <input type="hidden" placeholder="Key" id="exam-key" name="examKey" value = "<?php echo $exam_key ?>"/>
          <button type="submit" id="enter-exam">Enter</button>
        </form>
        <p id="errorMsg"></p>
      </div>
    </div>
    </div>
    <script src="js/examinee-form.js" type="module"></script>
</body>
</html>