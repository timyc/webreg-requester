<!doctype html>
<html>
	<head>
		<title>Scheduler</title>
	</head>
	<body>
<?php
if (!empty($_GET['CODE'])) {
	$courseCode = $_GET['CODE'];
} else {
	$courseCode = '0';
}
function getStringBetween($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
$link = 'https://www.reg.uci.edu/perl/WebSoc?Submit=Display+Web+Results&YearTerm=2020-03&ShowFinals=on&Breadth=ANY&Dept=+ALL&CourseNum=&Division=ANY&CourseCodes=' . $courseCode . '&InstrName=&CourseTitle=&ClassType=ALL&Units=&Days=&StartTime=&EndTime=&MaxCap=&FullCourses=ANY&FontSize=100&CancelledCourses=Exclude&Bldg=&Room=';
$doGet = file_get_contents($link);

$stuff = getStringBetween($doGet, '<div class="course-list">', '</div>');
echo '<form action="/index.php">
  Course Code:<br>
  <input type="text" name="CODE" value="' . $courseCode . '"><br><br>
  <input type="submit" value="Submit">
</form>';
if (strlen($stuff) < 100) {
	echo 'Invalid course code';
} else {
	echo $stuff;
}
?>
	</body>
</html>