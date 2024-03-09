<?php

$targetFolder = 'C:\\Users\\Arifiansyah\\OneDrive\\Documents\\GitHub\\akad.in\\storage\\app\\public';
$linkFolder = 'C:\\Users\\Arifiansyah\\OneDrive\\Documents\\GitHub\\akad.in\\public\\storage';

// Use shell_exec to execute the mklink command
$command = "mklink /D $linkFolder $targetFolder";
$result = shell_exec($command);

if ($result === null) {
    die('Error creating symbolic link.');
}

echo 'Symbolic link process successfully completed';

?>
