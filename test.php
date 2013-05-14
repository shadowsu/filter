<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>form</title>
</head>

<body>

<?php 

  $name = isset($_GET['name'])?$_GET['name']:null;
	$height = isset($_GET['height'])?$_GET['height']:null;
	$weight = isset($_GET['weight'])?$_GET['weight']:null;

?>

<h1>身高体重比例测试表单</h1>
<form method="get" name="form1" action="test.php">
    <label>姓名</label>
    <input type="text"  maxlength="30"  name="name" value="<?php echo $name;?>"/><br />
    <label>身高(cm)</label>
    <input type="text"  maxlength="30"  name="height" value="<?php echo $height;?>"/><br />
    <label>体重(kg)</label>
    <input type="text"  maxlength="30"  name="weight" value="<?php echo $weight;?>"/><br /><br />
    <input type="submit"  name="submit" value="提交"/>
    <input type="reset"   name="cancel" value="重置"/>
</form>
<hr />
<?php
	
	if (isset($_GET['submit'])) {
		if(empty($_GET['name'])){
			echo "请输入名字";
			exit(0);
		}
		if(empty($_GET['height'])){
			echo "请输入身高";
			exit(0);
		}
		if(empty($_GET['weight'])){
			echo "请输入体重";
			exit(0);
		}
		
		
		function isStr($str){//字符型否
			return preg_match("/^[a-zA-Z][a-zA-Z0-9_]{5,19}$", $str); //6-20个字符
		}
			
			
		function isNum($str){//字符型否
			return preg_match("/^[1-9]\d+$/", $str); 
		}
		
		
		
		if(strlen($_GET['name'])>=6&&strlen($_GET['name'])<=20){
			$name=$_GET['name'];
			echo "Name:".$name."<br />";
			
			if(!filter_var($_GET['height'], FILTER_VALIDATE_FLOAT)){
				echo "身高浮点类型数据<br/>";
						
			}else{
				
				if($_GET['height']>0&&$_GET['height']<=260){
					$height=$_GET['height'];
					echo "Height:".$height."<br />";
					
					if(!filter_var($_GET['weight'], FILTER_VALIDATE_FLOAT,array("option"=>array("min_range"=>2.0,"max_range"=>100.0)))){
						echo "体重浮点类型数据，且大于2.0，小于150.0<br/>";
					}else{
						
						if($_GET['weight']>0&&$_GET['weight']<=200){
							$weight=$_GET['weight'];
							echo "Weight:".$weight."<br />";
							
							$result=($_GET['height']-$_GET['weight'])*0.8;
							echo "结果：".$result."<br/>";
							
							if($result>150){
								echo "胖了";
							}else if($result<40){
								echo "偏瘦";
							}else{
								echo "适中";
							}
							
						}else{
							echo "0<体重<=200<br/>";}}
				}else{
					echo "0<身高<=260<br/>";}}
		}else{
			echo "6<=名字长度<=20个字符<br />";}
			
			
	}
?>
</body>
</html>
