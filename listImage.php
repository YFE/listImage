<?php
//遍历子目录
function dir_path($path)
{ 
	$path = str_replace('\\', '/', $path); 
	if (substr($path, -1) != '/') $path = $path . '/'; 
	return $path; 
} 
/** 
* 列出目录下的所有文件 
* 
* @param str $path 目录 
* @param str $exts 后缀 
* @param array $list 路径数组 
* @return array 返回路径数组 
*/ 
function dir_list($path, $exts = '', $list = array()) 
{ 
	$path = dir_path($path); 
	$files = glob($path . '*'); 
	foreach($files as $v) { 
		if (!$exts || preg_match("/\.($exts)/i", $v))
		{ 
			$list[] = $v; 
			if (is_dir($v)) 
			{ 
				$list = dir_list($v, $exts, $list); 
			} 
		} 
	} 
	return $list; 
} 
?> 
<?php
//图片文件夹设置
$r = dir_list('images/');
$l = "[";
$len = 0;
foreach( $r as $k )
{
	//图片后缀名设置
	if( preg_match("/\.(jpg|png|gif)$/",$k) ){
		if( $len != 0 ){
			$l .= ',';
		}
		$l .= '"'.$k.'"';
		$len++;
	}
}
$l .= "]";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>图片</title>
<style>
	body { background: #333; color: #fff; }
</style>

</head>
<body>
	<textarea name="" id="" cols="80" rows="30"><?=$l?></textarea>
	<?=$len?>
</body>
</html>