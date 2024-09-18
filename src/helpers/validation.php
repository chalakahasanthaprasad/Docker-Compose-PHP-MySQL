<?php
function validate_input($input, $field_name)
{
    if (empty($input)) {
        return "$field_name cannot be empty.";
    }

    if (preg_match('/[^A-Za-z0-9\s]/', $input)) {
        return "$field_name contains special characters which are not allowed.";
    }
    return true;
}
?>