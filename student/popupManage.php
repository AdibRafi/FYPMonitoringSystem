<?php
    //Get values
    $value = $_GET['id'];
    $option = $_GET['option'];

    //generate div for popup + form
    if ($option == "edit") {
        echo '<div class="popup-content">
            <form method="get" action="../src/modifyGoal.php">
            <h2><label>Change Percentage</label></h2>
            <a href="#" onclick="closeGoalEdit()"><img class="closeBtn" src="../src/icon/exitIcon.png"
                                                       style="width: 42px; height: 42px;" alt="exit"></a>
            <input type="text" class="popupInput" placeholder="New Percentage">
            <input type="hidden" name ="goal_id" value="'.$value.'">
            <p class="button"><input type="Submit" value="Save Changes"></p>
            </form>
            </div>';
    } else {
        echo '<div class="popup-content">
        <form method="get" action="../src/modifyGoal.php">
        <h2><label>Are you sure you want to remove this goal?</label></h2>
        <input type="hidden" name ="goal_id" value="'.$value.'">
        <a href="#" onclick="closeGoalRemove()"><img class="closeBtn" src="../src/icon/exitIcon.png"
                                                     style="width: 42px; height: 42px;" alt="exit"></a>
        <a href="../src/removeGoal.php" class="button">Yes</a>
        <a href="#" onclick="closeGoalRemove()" class="button">No</a>
        </form>
        </div>';
    }
?>
