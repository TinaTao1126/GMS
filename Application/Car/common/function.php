<?php
/**
 * 保存base64图片
 */
function save_base64_image($base64_image_content){
	//echo  123;exit;
	header('Content-type:text/html;charset=utf-8');
	//保存base64字符串为图片
	//匹配出图片的格式
	if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
		$type = $result[2];
		$new_file = "/Applications/MAMP/htdocs/onethink/test.{$type}";
		if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
			echo '新文件保存成功：', $new_file;
		}

	}
}
