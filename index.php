<!DOCTYPE html>
<meta charset="utf-8" />

<style>
.btn-link{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color:#0000EE;
  padding:0;
  text-decoration:underline;
  font-family:inherit;
  font-size:inherit;
}
</style>
<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
echo "<p>안녕하세요. $user_name($user_id)님</p>";
echo "<p><a href='logout.php'>로그아웃</a></p>";

echo "<form enctype='multipart/form-data' action='upload_ok.php' method='post'>
<input type='hidden' name='user' value='";
echo $user_id;
echo "'>	
<input type='file' name='myfile'>
	<button>보내기</button>
</form>";

// 폴더명 지정
$dir = "./files/".$user_id;
 
// 핸들 획득
$handle  = opendir($dir);
 
$files = array();
 
// 디렉터리에 포함된 파일을 저장한다.
while (false !== ($filename = readdir($handle))) {
    if($filename == "." || $filename == ".."){
        continue;
    }
 
    // 파일인 경우만 목록에 추가한다.
    if(is_file($dir . "/" . $filename)){
        $files[] = $filename;
    }
}
 
// 핸들 해제 
closedir($handle);
 
// 정렬, 역순으로 정렬하려면 rsort 사용
sort($files);
echo "<form method=\"post\" action=\"./download.php\">";
// 파일명을 출력한다.
foreach ($files as $f) {
	echo "<input type=\"hidden\" name=\"user\" value=\"";
	echo $user_id."\" />";
	echo "<button type=\"submit\" name=\"name\" value=\"";
	echo $f;
	echo "\" class=\"btn-link\">";
	echo $f;
	echo "</button>";
    echo "<br />";
} 
echo "</form>";
?>
