<?php view('header', $data); ?>
<section class="hero">
    <div class="hero-body">
        <div class="container">
            <form method="post" action="/">

<?php
    if ($data && $data['errors']) {
?>
<div class="notification is-danger">
<?php
    echo "Errors:";
    echo $data['errorMessage'];
?>  
</div>
<?php
    }
?>

<div class="field">
    <label class="label">First Name</label>
    <div class="control">
        <input class="input" name="first_name" type="text" value="<?php if ($data) { echo $data['input']['first_name']; } ?>">
    </div>
</div>

<div class="field">
    <label class="label">Last Name</label>
    <div class="control">
        <input class="input" name="last_name" type="text" value="<?php if ($data) { echo $data['input']['last_name']; } ?>">
    </div>
</div>

<div class="field">
    <label class="label">Email</label>
    <div class="control">
        <input class="input" name="email" type="email" value="<?php if ($data) { echo $data['input']['email']; } ?>">
    </div>
</div>

<div class="field">
    <label class="label">Password</label>
    <div class="control">
        <input class="input" name="password" type="password" value="">
    </div>
</div>

<div class="field">
    <label class="label">Repeat Password</label>
    <div class="control">
        <input class="input" name="repeat_password" type="password" value="">
    </div>
</div>

<input type="hidden" name="command" value="register">

<div class="control">
    <button class="button is-link">Register</button>
    <a class="button is-link" href="/">Cancel</a>
</div>

            </form>
        </div>
    </div>
</section>
<?php view('footer'); ?>