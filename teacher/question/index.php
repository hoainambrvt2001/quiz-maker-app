<?php
// Create new quiz object:
$quiz = new Quiz($_SESSION['courseId'], $_SESSION['quizId']);

if (isset($_POST['btnAddQuestion'])) {
  $quiz->addQuestion(
    htmlspecialchars($_POST['add-description']),
    htmlspecialchars($_POST['add-option1']),
    htmlspecialchars($_POST['add-option2']),
    htmlspecialchars($_POST['add-option3']),
    htmlspecialchars($_POST['add-option4']),
    $_POST['add-lvlOption']
  );
}

if (isset($_POST['BtnDeleteQuestion'])) {
  $quiz->deleteQuestion($_POST['questionId']);
}

if (isset($_POST['BtnEditQuestion'])) {
  $quiz->editQuestion(
    $_POST['questionId'],
    htmlspecialchars($_POST['edit-description']),
    htmlspecialchars($_POST['edit-option1']),
    htmlspecialchars($_POST['edit-option2']),
    htmlspecialchars($_POST['edit-option3']),
    htmlspecialchars($_POST['edit-option4']),
    $_POST['edit-lvlOption']
  );
}
?>

<!-- Form Add -->
<form class="form-question" action="./?page=question" method="POST" id="form-question">
  <div class="form-header">
    <div class="form-question-desc">
      <p>Question:<span class="wrong"></span></p>
      <textarea name="add-description" rows="2" placeholder="Question Description"></textarea>
    </div>
    <div class="form-level">
      <div class="form-select">
        <select name="add-lvlOption">
          <option value="1">Easy</option>
          <option value="2">Medium</option>
          <option value="3">Hard</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-body">
    <div class="form-option">
      <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
      <textarea name="add-option1" rows="2" placeholder="Option A (correct answer)"></textarea>
    </div>
    <div class="form-option">
      <p>Option B <span class="wrong"></span></p>
      <textarea name="add-option2" rows="2" placeholder="Option B"></textarea>
    </div>
    <div class="form-option">
      <p>Option C <span class="wrong"></span></p>
      <textarea name="add-option3" rows="2" placeholder="Option C"></textarea>
    </div>
    <div class="form-option">
      <p>Option D <span class="wrong"></span></p>
      <textarea name="add-option4" rows="2" placeholder="Option D"></textarea>
    </div>
  </div>
  <div class="form-button">
    <div class="cancel">Cancel</div>
    <button class="submit" type="submit" name="btnAddQuestion">Submit</button>
  </div>
</form>

<!-- Form Edit -->
<div class="form-wrapper">
  <form class="form-edit" action="./?page=question" method="POST" id="form-edit">
    <div class="form-header">
      <div class="form-question-desc">
        <p>Question:<span class="wrong"></span></p>
        <textarea name="edit-description" rows="2" placeholder="Question Description"></textarea>
      </div>
      <div class="form-level">
        <div class="form-select">
          <select name="edit-lvlOption">
            <option value="1">Easy</option>
            <option value="2">Medium</option>
            <option value="3">Hard</option>
          </select>
        </div>
      </div>
    </div>
    <div class="form-body">
      <div class="form-option">
        <p>Option A<span style="color: red">*</span><span class="wrong"></span></p>
        <textarea name="edit-option1" rows="2" placeholder="Option A (correct answer)"></textarea>
      </div>
      <div class="form-option">
        <p>Option B <span class="wrong"></span></p>
        <textarea name="edit-option2" rows="2" placeholder="Option B"></textarea>
      </div>
      <div class="form-option">
        <p>Option C <span class="wrong"></span></p>
        <textarea name="edit-option3" rows="2" placeholder="Option C"></textarea>
      </div>
      <div class="form-option">
        <p>Option D <span class="wrong"></span></p>
        <textarea name="edit-option4" rows="2" placeholder="Option D"></textarea>
      </div>
      <!-- ==================================================== -->
      <input type="hidden" name="questionId">
    </div>
    <div class="form-button">
      <button type="submit" class="delete" name="BtnDeleteQuestion">Delete</button>
      <div class="cancel">Cancel</div>
      <button type="submit" class="submit" name="BtnEditQuestion">Submit</button>
    </div>
  </form>
</div>

<div class="function-button">
  <a href="./?page=result">
    <button class="view">View results</button>
  </a>
  <a href="./print">
    <button class="download">Download PDF</button>
  </a>
</div>

<?php
// Create new quiz object:
$quiz = new Quiz($_SESSION["courseId"], $_SESSION["quizId"]);

// Get all questions belongs to quiz:
$questions = $quiz->getAllQuestionsBelongsTo();

$numberOfQuestion = 0;
foreach ($questions as $question) {
  $numberOfQuestion++;
  echo '<div class="card">
        <div class="card-top">
          <p><span>Question ' . $numberOfQuestion . ': </span>' . $question->description . '</p>
          <i class="fa fa-edit">
            <input type="hidden" value="' . $question->description . '" />
            <input type="hidden" value="' . $question->option1 . '">
            <input type="hidden" value="' . $question->option2 . '">
            <input type="hidden" value="' . $question->option3 . '">
            <input type="hidden" value="' . $question->option4 . '">
            <!-- This is the level -->
            <input type="hidden" value="' . $question->level . '" >
            
            <!-- This is the QuestionId -->
            <input type="hidden" name="questionId" value="' . $question->_id . '"> 
          </i>
        </div>
        <div class="answer">
          <p class="correct">A: <span>' . $question->option1 . '</span></p>
          <p>B: <span>' . $question->option2 . '</span></p>
          <p>C: <span>' . $question->option3 . '</span></p>
          <p>D: <span>' . $question->option4 . '</span></p>
        </div>
      </div>';
}
?>

<script src="./question/question.js"></script>
<script>
  window.onload = function() {
    history.replaceState("", "", "./?page=question");
  }
</script>