<?php

function exportContactVCF($contactData){



    $fullname = "User Name";

        $fullnameArray = explode(" ",$fullname);

        $first_name = $fullnameArray[0];

        $last_name = $fullnameArray[1];

        $mobile_number = "9898098980";

        $email_address= "user1@domain.com";

        $dataArray ="BEGIN:VCARD\r\nVERSION:4.0\r\nN:$first_name;$last_name\r\nFN:$first_name\r\nTEL;TYPE=work,voice;VALUE=uri:tel:$mobile_number\r\nTEL;TYPE=home,voice;VALUE=uri:$mobile_number\r\nEMAIL:$email_address\r\nEND:VCARD\r\n";


$data = $dataArray;

$size = strlen($data);

$filename = "contact.vcf";

header("Content-Type: application/octet-stream");

header("Content-Length: $size");

header("Content-Disposition: attachment; filename=\"$filename\"");

header("Content-Transfer-Encoding: binary");

return $data;

}

//Call the function

$contactData = '{

    "data": [

        {

        "name": “User Name",

        "mobile_number": “9898098980",

        "email_address": "user1@domain.com"

        }

    ]

}';

//NOTE : You can add multiple contacts or get them from database to generate all contacts VCF file.

echo exportContactVCF($contactData);