<?php
if (isset($_POST['Email'])) {

    $email_to = "rizky98ibrahim@gmail.com";
    $email_subject = "New form porfolio";

    function problem($error)
    {
        echo "Maaf ada kesalahan pada form yang anda kirimkan. ";
        echo "Pesan kesalahan berikut ini: <br /> ";
        echo $error . "<br><br>";
        echo "Silahkan kembali dan perbaiki form. <br><br>";
        die();
    }

    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Maaf ada kesalahan pada form yang anda kirimkan.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Format email yang anda masukkan tidak valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'Nama yang anda masukkan tidak valid.<br />';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Pesan yang anda masukkan tidak valid.<br />';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

Thank you for contacting us. We will be in touch with you very soon.
<?php
}
?>