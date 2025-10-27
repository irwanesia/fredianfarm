<p>Dear <?= $mail_data['user']->name ?></p>
<br>
<p>
    Your password on CI4Blog system was changed succesfully. Here are your new login credentials:
    <br><br>
    <b>Login ID:</b> <?= $mail_data['user']->username ?>
    <br>
    <b>Password:</b> <?= $mail_data['new_password'] ?>
    <br>
    <br>
    Please, keep your credentials confidentials. Your username and password are your own crendentials and you should never share with anybody else.
<p>
    CI4Blog will not be liable for any misuse of your username or password.
</p>
<br>
<p>
    This email was automatically sent by CI4Blog system. Do not reply it.
</p>
</p>