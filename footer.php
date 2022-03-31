<footer class="page-footer font-small unique-color-dark pt-4">
  <a href="https://www.edinboro.edu/" target="_blank"><div class="footer-copyright text-center py-3">© 2022 Copyright:
    <img src="pictures/Edinboro_University_logo.png" class="footer-pic"></a>
  </div>
  <div class="admin log-in">
    <?php
      if(isset($_SESSION["username"])){
        echo '<div class="login">
        <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
        </div>';
      }else{
        echo '<div class="login">
        <a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
        </div>';
      }
    ?>
  </div>
</footer>