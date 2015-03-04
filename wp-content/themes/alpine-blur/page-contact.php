<?php
/*
Template Name: Contact
*/

get_header(); ?>
 
<?php
session_start();        // starting user session to pass variables through the POST-REDIRECT-GET process

$echoedName = "";       // vars to hold persistant display of user input
$echoedEmail = "";
$echoedMessage = "";
$alert = "";
$_SESSION['conSubmit'] = false;

function validEmail ($email) {      // true email validation by Douglas Lovell http://www.linuxjournal.com/article/9585
    $isValid = true;        // var to return success/fail of validation
    $atIndex = strrpos($email, "@");        // var to find location of @ symbol

    if (is_bool($atIndex) && !$atIndex) {
        $isValid = false;        // incorrect location or lack of @ symbol
    } else {
        $local = substr($email, 0, $atIndex);   // var to hold first half of address, local part
        $domain = substr($email, $atIndex+1);   // var to hold last half of address, domain part
        $localLen = strlen($local);     // finding length of local part
        $domainLen = strlen($domain);   // finding length of domain part

        if ($localLen < 1 || $localLen > 64) {
            $isValid = false;       // local part length exceeded
        } else if ($domainLen < 1 || $domainLen > 255) {
            $isValid = false;       // domain part length exceeded
        } else if ($local[0] == '.' || $local[$localLen-1] == '.') {
            $isValid = false;       // local part starts or ends with '.'
        } else if (preg_match('/\\.\\./', $local)) {
            $isValid = false;       // local part has two consecutive dots
        } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
            $isValid = false;       // character not valid in domain part
        } else if (preg_match('/\\.\\./', $domain)) {
            $isValid = false;       // domain part has two consecutive dots
        } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
            if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))) {
                $isValid = false;   // character not valid in local part unless local part is quoted
            }
        }
            
        if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
            $isValid = false;       // domain not found in DNS
        }
   }
    
    return $isValid;        // valid email address
}

if(count($_POST) > 0) {     // P-R-G process
    $_SESSION['conName'] = Trim(stripslashes($_POST['conName']));     // get POSTs from form submission
    $_SESSION['conEmail'] = Trim(stripslashes($_POST['conEmail']));   // strip slashes and whitespaces
    $_SESSION['conMessage'] = Trim(stripslashes($_POST['conMessage']));   // save values to session

    header("HTTP/1.1 303 See Other");
    $location = get_template_directory_uri();
    //header("Location: " . $location . "/page-contact.php");      // redirect back to here
    header("Location: http://portfolio.dev/contact/");
    die();
} else if (isset($_SESSION['conName'])) {      // if session variables are set...
    $echoedName = $_SESSION['conName'];        // save session variables to working variables
    $echoedEmail = $_SESSION['conEmail'];
    $echoedMessage = $_SESSION['conMessage'];
            
    if (validEmail($echoedEmail) == true) {     // check for valid email
        $EmailTo = "zachfedor@gmail.com";       // set recipient
        $Subject = "Message From Portfolio Contact Page";   // set email subject line

        $Body = "";     // prepare email body text
        $Body .= "Name: ";
        $Body .= $_SESSION['conName'];
        $Body .= "\n";
        $Body .= "Email: ";
        $Body .= $_SESSION['conEmail'];
        $Body .= "\n";
        $Body .= "Message: ";
        $Body .= $_SESSION['conMessage'];
        $Body .= "\n";
 
        $success = wp_mail($EmailTo, $Subject, $Body, "From: <$echoedEmail>");       // send email

        if ($success) {      // on success...
            $alert = "<h2 class=\"contactThanks\">Thanks ".htmlspecialchars($echoedName).".<br>I'll get back to you as soon as I can!</h2>";        // print thank you message after send
            
            $_SESSION['conSubmit'] = true; // tracks submission to disable submit button
        } else {        // on fail...
            $alert = "<p class=\"contactError\">There seems to have been a problem sending the message. Try refreshing the page and submitting it again.</p>";  // print error message
        }

        session_unset();
        session_destroy();
    } else {
        $alert = "<p class=\"contactError\">Please enter a valid email address.</p>";
    }
}

?>

<main class="row">
    <div class="col one-third">
        <h1><?php the_title(); ?></h1>
    </div>
    <div class="col two-thirds entry-content">
        <?php echo $alert; ?>
        <form method="post" action="">
            <label for="conName">Name:</label>
            <input type="text" name="conName" id="conName" autofocus="autofocus" required="required" value="<?php echo htmlspecialchars($echoedName); ?>"/><br />

            <label for="conEmail">Email:</label>
            <input type="email" name="conEmail" id="conEmail" required="required" value="<?php echo htmlspecialchars($echoedEmail); ?>"/><br>
                    
            <label for="conMessage">Message:</label>
            <textarea rows="5" name="conMessage" id="conMessage" required="required" ><?php echo htmlspecialchars($echoedMessage); ?></textarea><br>

            <input type="submit" name="submit" value="Submit" class="submit-button" />
        </form>
    </div><!-- .entry-content -->
</main><!-- #post-<?php the_ID(); ?> -->           
 
<?php get_footer(); ?>
