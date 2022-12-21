<style>
</style>
<?php 
include './pages/header.php';
 
?>
<h1>Applyer Registeration Form</h1>
<form method="POST" action="<?php echo $baseName.'applyerReg.php'; ?>">
    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control" name="fname" placeholder="first_name" required>
        <label for="formId1">first_name</label>
    </div>
    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control" name="lname" placeholder="last_name" required>
        <label for="formId1">last_name</label>
    </div>
    <div class="form-floating mb-3">
        <input
            type="email"
            class="form-control" name="email" placeholder="email" required>
        <label for="formId1">email</label>
    </div>
    <div class="form-floating mb-3">
        <input
            type="text"
            class="form-control" name="phone" placeholder="phone" required>
        <label for="formId1">phone</label>
    </div>
    <div class="form-floating mb-3">
        <input
            type="number"
            class="form-control" name="age" placeholder="age" required>
        <label for="formId1">age</label>
    </div>
    <div class="form-floating mb-3">
        <input
            type="password"
            class="form-control" name="pass" placeholder="pass" required>
        <label for="formId1">Password</label>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php include './pages/footer.php'; ?>