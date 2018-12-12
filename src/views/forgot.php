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
    <label class="label">Email</label>
    <div class="control">
        <input class="input" name="email" type="email" value="<?php if ($data) { echo $data['input']['email']; } ?>">
    </div>
</div>

<input type="hidden" name="command" value="forgot_password">

<div class="control">
    <button class="button is-link">Reset Password</button>
    <a class="button is-link" href="/">Cancel</a>
</div>

            </form>
        </div>
    </div>
</section>
<?php view('footer'); ?>