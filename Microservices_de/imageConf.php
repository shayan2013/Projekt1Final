<?php
$dir          = 'Uploads';
$file_display = array(
    'jpg',
    'jpeg',
    'png',
    'gif'
);

if (file_exists($dir) == false) {
    echo 'Directory \''. $dir. '\' not found!';
} else {
    $dir_contents = scandir($dir);
    echo "<table>";
    foreach ($dir_contents as $file) {
        $file_type = strtolower(end(explode('.', $file)));
	    echo "<tr>";
        if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true) {
			echo "<td>";
			echo '<img src="'. $dir. '/'. $file. '" alt="'. $file. '" />';
			echo "</td>";
        }
		echo "</tr>";
    }
	echo "</table>";
}
?>