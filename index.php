<?php
$question = $_post['question'];
$masgs = explode("\n", file_get_contents("messages.txt"));
$peaople = file_get_contents("people.json");
$j_peaople = json_decode($peaople,true);
if($_post['person']==""){
    $en_name = array_rand($j_peaople);
    $msg = 'سوال خود را بپرسید!';
}
else{
    $en_name = $_post['person'];
    $msg = $masgs[hexdec(substr(sha1($question . $en_name), 0, 10)) % count($masgs)];
}
$fa_name = $j_peaople[$en_name];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/default.css">
    <title>مشاوره بزرگان</title>
</head>
<body>
<p id="copyright">تهیه شده برای درس کارگاه کامپیوتر،دانشکده کامییوتر، دانشگاه صنعتی شریف</p>
<div id="wrapper">
    <div id="title">
        <span id="label">پرسش:</span>
        <span id="question"><?php echo $question ?></span>
    </div>
    <div id="container">
        <div id="message">
            <p><?php echo $msg ?></p>
        </div>
        <div id="person">
            <div id="person">
                <img src="images/people/<?php echo "$en_name.jpg" ?>"/>
                <p id="person-name"><?php echo $fa_name ?></p>
            </div>
        </div>
    </div>
    <div id="new-q">
        <form method="post">
            سوال
            <input type="text" name="question" value="<?php echo $question ?>" maxlength="150" placeholder="..."/>
            را از
            <select name="person">
                <?php
                foreach($j_Peaople as $key => $value){
                    if($key == $en_name)
                        echo '<option value='.$key.' selected>'.$value.'</option>';
                    else
                        echo '<option value='.$key.'>'.$value.'</option>';
                }
                ?>
            </select>
            <input type="submit" value="بپرس"/>
        </form>
    </div>
</div>
</body>
</html>