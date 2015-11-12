<?=$row[2] =preg_replace_callback("/#{1}[a-zA-Z0-9_]+/",
	function($match){ 
        return '<a href ="./index.php?text=%23'.substr($match[0], 1).'&selser=contents">'.$match[0].'</a>';}, $row[2])
                       ?>