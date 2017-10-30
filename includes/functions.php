<?php
$errors = array();

/**
 * Adds HTML line breaks and HTML entities
 *
 * @param $str
 *      The input string
 * @return string
 *      The HTML-compliant string
 */
function make_HTML_compliant($str)
{
    $str = nl2br($str);
    $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
    return $str;
}

/**
 * Validates a specific HTML field is not blank
 *
 * @param $var
 *      The field in question
 * @return array|string
 *      Returns the fields that are empty
 */
function validate_fields($var)
{
    global $errors;
    foreach ($var as $field) {
        $val = make_HTML_compliant($_POST[$field]);
        if (isset($val) && $val == '') {
            $errors = $field . " can't be blank.";
            return $errors;
        }
    }
}

/**
 * Makes an alert message from session message
 *
 * @param string $msg
 *      The message with the key - i.e. success, danger
 * @return array|string
 *      The output <div> tag that contains our alert.
 */
function make_alert_msg($msg = '')
{
    $output = array();
    if (!empty($msg)) {
        foreach ($msg as $key => $value) {
            $output = "<div class=\"alert alert-{$key}\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
            $output .= make_HTML_compliant(capitalize_first_letter($value));
            $output .= "</div>";
        }
        return $output;
    } else {
        return "";
    }
}

/**
 * Redirects to a certain page
 *
 * @param $url
 *      The redirect URL
 * @param bool $permanent
 *      Changes response code from 301 if true to 302 if false
 */
function redirect_to_page($url, $permanent = false)
{
    if (headers_sent() === false) {
        if ($permanent === true) {
            header('Location: ' . $url, true, 301);
        } else {
            header('Location: ' . $url, true, 302);
        }
    }

    exit();
}

/**
 * Calculate the total selling price and the profit for the sales
 *
 * @param $totals
 *      The totals of the products
 * @return array
 *      The total sum and the profit of the products
 */
function total_price($totals)
{
    $sum = 0;
    $sub = 0;
    foreach ($totals as $total) {
        $sum += $total['total_selling_price'];
        $sub += $total['total_cost_price'];
        $profit = $sum - $sub;
    }
    return array($sum, $profit);
}

/**
 * Reads date from DB and makes sure it's in the right format
 *
 * @param $str
 *      The date string from the DB
 * @return false|null|string
 *      False/null if the string doesn't exist. Otherwise the formatted date time.
 */
function read_date($str)
{
    if ($str) {
        return date('F j, Y, g:i:s a', strtotime($str));
    } else {
        return null;
    }
}

/**
 * Capitalizes the first letter of any text and removes dashes
 *
 * @param $str
 *      The passed in text
 * @return mixed|string
 *      The properly spaced and capitalized string.
 */
function capitalize_first_letter($str)
{
    $val = str_replace('-', " ", $str);
    $val = ucfirst($val);
    return $val;
}
