<form action="Test.php" method="POST">
    Please enter your password:<br>
    <input type="text" name ="username"><br>
    <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>
<?php
$pwd = 'password';
if (isset($_POST['password']) && !empty($_POST['password'])) {
    echo 'Submitted and fill with'.$_POST['password'];
}
?>
