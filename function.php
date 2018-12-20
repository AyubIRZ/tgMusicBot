<?php
require_once 'config.php';
define('API_TOKEN', '558862229:AAFmQDLeqhKQ1ye_O7vVUgs-_kcNRwdDkrk');
////////////////////////// Functions /////////////////////////
function bot($data){
    return json_decode(file_get_contents("https://api.telegram.org/bot".API_TOKEN."/".$data),true);
}
function message($chat_id,$msg,$markup=null){
    if($markup!=null)
    {
        bot("sendMessage?chat_id=".$chat_id."&text=".$msg."&reply_markup=".$markup);
    }
    else
    {
        bot("sendMessage?chat_id=".$chat_id."&text=".$msg);
    }
}

function forwardMessage($user_id,$message_id,$from_chat_id){
    bot("forwardMessage?chat_id=".$user_id."&from_chat_id=".$from_chat_id."&message_id=".$message_id);
}

function editMessage($chat_id,$message_id,$msg){
        bot("editMessageText?chat_id=".$chat_id."&message_id=".$message_id."&text=".$msg);
}

function photo($chat_id,$photo_link,$caption=null)
{
    bot("sendPhoto?chat_id=".$chat_id."&photo=".$photo_link."&caption=".$caption);
}
function video($chat_id,$video_link,$caption=null)
{
    bot("sendVideo?chat_id=".$chat_id."&video=".$video_link."&caption=".$caption);
}

function send_file($chat_id,$file_id,$caption=null)
{
    bot("sendDocument?chat_id=".$chat_id."&document=".$file_id."&caption=".$caption);
}

function action($chat_id,$action)
{
    bot("sendChatAction?chat_id=".$chat_id."&action=".$action);
}

function answer_query($query_id,$text,$show_alert=false)
{
    bot("answerCallbackQuery?callback_query_id=".$query_id."&text=".$text."&show_alert=".$show_alert);
}

function getStep($user_id){
    global $db;
    $query="select step from users WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    $res=mysqli_fetch_assoc($res);
    return $res['step'];
}

function setStep($user_id,$step){
    global $db;
    $query="update users set step='".$step."' WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    return $res;
}

function addDownload($user_id){
    global $db;
    $query="update users set downloaded_music=downloaded_music+1 WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    return $res;
}

function getDownload($user_id){
    global $db;
    $query="select downloaded_music from users WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    $res=mysqli_fetch_assoc($res);
    return $res['downloaded_music'];
}

function addSent($user_id){
    global $db;
    $query="update users set sent_music=sent_music+1 WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    return $res;
}

function getSent($user_id){
    global $db;
    $query="select sent_music from users WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    $res=mysqli_fetch_assoc($res);
    return $res['sent_music'];
}

function addMusic($file_id,$title,$performer,$duration,$file_size,$mime_type){
    global $db;
    $query="insert into music(file_id,performer,title,duration,file_size,mime_type) VALUES('$file_id','$performer','$title','$duration','$file_size','$mime_type')";
    $res=mysqli_query($db, $query);
    return $res;
}

function addDownloades($id,$file_id,$title,$performer,$duration,$file_size,$user_id){
    global $db;
    $query="insert into downloads(file_id,performer,title,duration,file_size,music_id,user_id) VALUES('$file_id','$performer','$title','$duration','$file_size','$id','$user_id')";
    $res=mysqli_query($db, $query);
    return $res;
}

function isDownloaded($user_id,$id){
    global $db;
    $query="select * from downloads WHERE user_id=".$user_id." and music_id=".$id;
    $res=mysqli_query($db, $query);
    $res=mysqli_fetch_assoc($res);
    return (isset($res['music_id']))?true:false;
}

function setSearch($user_id,$search_string){
    global $db;
    $query="update users set last_search='".$search_string."' WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    return $res;
}

function getSearch($user_id){
    global $db;
    $query="select last_search from users WHERE user_id=".$user_id;
    $res=mysqli_query($db, $query);
    $res=mysqli_fetch_assoc($res);
    return $res['last_search'];
}
function inline_btn($i){
    $ar=array();
    $button=array();
    for($c=0;$c<count($i);$c=$c+2)
    {
        $button[$c/2 % 2]=array("text"=>urlencode($i[$c]),"callback_data"=>$i[$c+1]);
        if($c/2 % 2){
            array_push($ar,array($button[0],$button[1]));
            $button=array();
        }elseif(count($i)-$c<=2){
            array_push($ar,array($button[0]));
            $button=array();
        }
    }
    return "&reply_markup=".json_encode(array("inline_keyboard"=>$ar));
}

function getMusic($id){
    global $db;
    $query="select * from music WHERE id=".$id;
    $res=mysqli_query($db, $query);
    $res=mysqli_fetch_assoc($res);
    return $res;
}

function isMember($user_id,$chat_id){
    $status=bot("getChatMember?chat_id=".$chat_id."&user_id=".$user_id);
    return $status['result']['status'];
}

function getMusicCount(){
    global $db;
    $query="select * from music";
    $res=mysqli_query($db, $query);
    $res=mysqli_num_rows($res);
    return $res;
}

function getMemberCount(){
    global $db;
    $query="select * from users";
    $res=mysqli_query($db, $query);
    $res=mysqli_num_rows($res);
    return $res;
}