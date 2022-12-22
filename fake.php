<?php include './pages/header.php'; ?>
<h1>Fake login form</h1>
<form method="POST" action="<?php echo $baseName.'log.php'; ?>">
    <div class="mb-3">
      <select class="form-select form-select-lg" name="role">
        <option>Please Select</option>
        <option value="applyer">Job Applyer</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <div class="form-item">
      <label for="email"></label>
      <input type="email" name="email" required="required" placeholder="Email Address"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="pass" required="required" placeholder="Password"></input>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="Sign In" value="Sign In"></input>
    </div>
</form>