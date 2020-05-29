<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-32">
    <title>lab7</title>
</head>
<body>
<h1>Вариант 5</h1>
<?php

$to = isset($_POST['to']) ? $_POST['to'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
$captchaInput = isset($_POST['captcha']) ? $_POST['captcha'] : null;
$captchaPostedKey = isset($_POST['captcha-key']) ? $_POST['captcha-key'] : null;

if (isset($_FILES['my_files'])) {
    $attachments = $_FILES['my_files'];
    $fileCount = count($attachments['name']);
} else {
    $fileCount = 0;
}
$fromEmail = "info@localhost";
$boundary = md5("localhost");

function mailUser($to, $text): bool
{
    global $fileCount;
    global $fromEmail;
    global $boundary;
    if ($fileCount > 0) {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "From:" . $fromEmail . "\r\n";
        $headers .= "Reply-To: " . $to . "" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($text));

        for ($x = 0; $x < $fileCount; $x++) {
            if (!empty($attachments['name'][$x])) {

                if ($attachments['error'][$x] > 0) {
                    $msg = array(
                        1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
                        2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
                        3 => "The uploaded file was only partially uploaded",
                        4 => "No file was uploaded",
                        6 => "Missing a temporary folder");
                    print  $msg[$attachments['error'][$x]];
                    exit;
                }

                $file_name = $attachments['name'][$x];
                $file_size = $attachments['size'][$x];
                $file_type = $attachments['type'][$x];
                $handle = fopen($attachments['tmp_name'][$x], "r");
                $content = fread($handle, $file_size);
                fclose($handle);
                $encoded_content = chunk_split(base64_encode($content));
                $body .= "--$boundary\r\n";
                $body .= "Content-Type: $file_type; name=" . $file_name . "\r\n";
                $body .= "Content-Disposition: attachment; filename=" . $file_name . "\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n";
                $body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
                $body .= $encoded_content;
            }
        }

    } else {
        $headers = "From:" . $fromEmail . "\r\n" .
            "Reply-To: " . $to . "\n" .
            "X-Mailer: PHP/" . phpversion();
        $body = $text;
    }

    $subject = "Тема";
    return mail($to, $subject, $body, $headers);
}

$isCaptchaCorrect = false;
if ($to && $text && $captchaInput && $captchaPostedKey) {
    if ($captchaPostedKey == hash("md5", $captchaInput)) {
        $isCaptchaCorrect = true;
        if (mailUser($to, $text)) {
            echo "Email успешно отправлен.";
        } else {
            echo "Ошибка отправки.";
        }
    }

    unset($_POST['to']);
    unset($_POST['text']);
    unset($_POST['captcha']);
    unset($_POST['captcha-key']);
}

function generateCaptcha(): int
{
    $captchaMin = 100000;
    $captchaMax = 999999;
    $captchaKey = random_int($captchaMin, $captchaMax);

    $captchaWidth = 64;
    $captchaHeight = 28;
    $captchaPath = "images/captcha.png";
    $captcha = imagecreatetruecolor($captchaWidth, $captchaHeight);

    $text = strval($captchaKey);
    $white = imagecolorallocate($captcha, 255, 255, 255);
    $grey = imagecolorallocate($captcha, 128, 128, 128);
    $black = imagecolorallocate($captcha, 0, 0, 0);
    $fontSize = 10;
    $coord = 6;
    imagefilledrectangle($captcha, 0, 0, $captchaWidth, $captchaHeight, $grey);
    imagestring($captcha, $fontSize, $coord, $coord, $text, $white);

    for ($i = 0; $i < 7; $i++) {
        $x1 = random_int(0, $captchaWidth);
        $x2 = random_int(0, $captchaWidth);
        $y1 = 0;
        $y2 = $captchaHeight;
        imageline($captcha, $x1, $y1, $x2, $y2, $black);
    }

    imagepng($captcha, $captchaPath);

    return $captchaKey;
}

$captchaKey = generateCaptcha();

?>
<form action="index.php" method="post">
    <label for="to">Кому:</label>
    <input name="to" id="to" type="email" required><br>

    <label for="text">Текст:</label>
    <textarea name="text" id="text" cols="30" rows="10" required></textarea><br>

    <label for="captcha">Капча:</label>
    <img src="images/captcha.png" alt="img-captcha">
    <input name="captcha" id="captcha" type="text" required><br>
    <span class="captcha-status"><?= $isCaptchaCorrect ? "" : "Капча введена неверно"; ?></span>

    <input type="hidden" name="captcha-key" value="<?= hash("md5", $captchaKey); ?>">

    <label>Вложения <input type="file" name="my_files[]" multiple/></label>
    <button>Отправить</button>
</form>
</body>
</html>
