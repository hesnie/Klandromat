<?php if($_SERVER['REQUEST_METHOD'] === "POST") : ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new mysqli(MYSQL_PROVIDER, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
    
    $id = $arguements["id"];
    $email = $db->real_escape_string($_POST["email"]);
    $phone = $db->real_escape_string($_POST["phone"]);

    $sql = "UPDATE student SET email = '$email', phone = $phone WHERE student.id = $id;";
    $db->query($sql);

    if ($db->query($sql) === TRUE) {
        header("Location: /"  . $arguements["auid"]);
    }
}
?>

<?php else: ?>

<p><b><?php echo $arguements["name"] . "</b>, " . $arguements["auid"]; ?></p>

<form action="/<?php echo $arguements["auid"]; ?>/edit" id="edit-user" method="POST">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">@</span>
            <input type="email" class="form-control" name="email" value="<?php echo $arguements["email"]; ?>" required>
        </div>
        <br>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i> +45</span>
            <input type="tel" id="tel" class="form-control" name="phone" maxlength="8" minlength="8" value="<?php echo $arguements["phone"]; ?>">
        </div>
        <br>
        <div class="input-group">
            <input type="submit" class="btn btn-default" value="Edit" />
        </div>
    </div>
</form>
<script>$("#edit-user").validate({
rules: {
    phone: { regex: "[0-9]{8}" }
}
});</script>
<?php endif; ?>