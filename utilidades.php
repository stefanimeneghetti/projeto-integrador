<?php
    function prettyPrintPhone($phone)
    {
        $formattedPhone = substr($phone, 0, (strlen($phone) - 4)) .
                          "-" .
                          substr($phone, strlen($phone) - 4);
        if(strlen($phone) > 9)
        {
            if(strlen($phone) == 14 || strlen($phone) == 11)
                $formattedPhone = (strlen($phone) == 14 ? substr($formattedPhone, 0, 3) : "") .
                                  " (" .
                                  substr($formattedPhone, 12, 2) .
                                  ") " .
                                  substr($formattedPhone, strlen($formattedPhone) - 10);
            else
                $formattedPhone = (strlen($phone) == 13 ? substr($formattedPhone, 0, 3) : "") .
                                  " (" .
                                  substr($formattedPhone, strlen($formattedPhone) - 11, 2) .
                                  ") " .
                                  substr($formattedPhone, strlen($formattedPhone) - 9);
        }
        return $formattedPhone;
    }
?>