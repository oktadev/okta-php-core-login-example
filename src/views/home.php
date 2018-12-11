<?php view('header', $data); ?>
<section class="hero">
    <div class="hero-body">
        <div class="container">

<?php
    if (isset($data['thank_you'])) {
?>
<div class="notification is-info">
<?php
    echo $data['thank_you'];
?>  
</div>
<?php
    }
?>

<?php
    if (isset($data['loginError'])) {
?>
<div class="notification is-danger">
<?php
    echo $data['loginError'];
?>
</div>
<?php
    }
?>

<?php
    if (isset($_SESSION['username'])) {
?>
            <p class="subtitle is-4">
            This is some great content for logged in users
            <p>
<?php 
    } else {
?>
            <p class="subtitle is-4">
            You need to login to access the content!
            </p>
<?php
    }
?>
        </div>
    </div>
</section>
<?php view('footer'); ?>