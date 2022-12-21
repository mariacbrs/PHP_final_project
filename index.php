<?php include './pages/header.php'; ?>
<div class="row justify-content-center align-items-center g-2" style="padding-top: 5vh; width:100%">
    <div class="col-5">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: <?php
            if(isset($_GET['msg'])) echo "block";
            else echo "none";
        ?> ;">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          <strong>Warning!</strong> username and password not found!
        </div>
        
        <script>
          var alertList = document.querySelectorAll('.alert');
          alertList.forEach(function (alert) {
            new bootstrap.Alert(alert)
          })
        </script>
        <?php 
        if(!isset($_SESSION['token'])){
          $token = bin2hex(random_bytes(32));
          $_SESSION['token'] = $token;
        }
        ?>
        
    <form method="POST" action="<?php echo $baseName.'log.php'; ?>">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <div class="mb-3">
            <select class="form-select form-select-lg" name="role">
                <option value="ds" disabled selected>Please select one</option>
                <option value="employer" >Employer</option>
                <option value="admin">Admin</option>
          </select>
        </div>
        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control" name="email" placeholder="cd" required>
          <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control" name="pass" placeholder="cd" required>
          <label for="pass">Password</label>
        </div>
        <button type="submit" class="btn btn-primary">LOGIN</button>
      </form>
      <div class="form-footer">
       <p><a href="<?php echo $baseName.'applyer.php'; ?>">Create an account</a></p>
      </div>
    </div>
</div>
<?php include './pages/footer.php'; ?>