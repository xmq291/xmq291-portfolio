<?php
/* Set e-mail recipient */
$email_to  = "xmq291@gwu.edu";
$email_subject = "New Contact Form from my Portfolio";

/* Check all form inputs using check_input function */
$firstname = check_input($_POST['firstname'], "Firstname *");
$lastname = check_input($_POST['lastname'], "Lastname *");
$email    = check_input($_POST['email'], "E-mail *");
$telnum  = check_input($_POST['telnum']);
$comments = check_input($_POST['comments'], "Write your comments");

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

Your contact form has been submitted by:

First Name: $firstname
Last Name: $lastname
E-mail: $email
Telphone: $telnum
Comments:$comments

End of message
";

/* Send the message using mail() function */
mail($email_to, $email_subject, $message);

/* Redirect visitor to the thank you page */
header('Location: index.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>