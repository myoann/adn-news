<?php
session_start();
if (isset($_SESSION["USER_ID"]) && isset($_SESSION["EMAIL"])){
    $USER_ID=$_SESSION['USER_ID'];
    $EMAIL=$_SESSION['EMAIL'];
    header("location: home.php");
}
?>
<!--
==============================
    IMPORT HEADER
==============================
-->
<?php include("./section/_header.php"); ?>

<!--
==============================
    CONTENT
==============================
-->
<?php
    // Default values
    $theNews_id="1";
    // Get the News ID in the URL
    if (isset($_GET["news_id"])){
        $news_id=trim($_GET["news_id"]);
        if (!empty($news_id)){
            $theNews_id=$news_id;
        }
    }
?>
<script>
    $(function(){
        var _news_id=getParameterByName('news_id');
        var _urlGetNews='./DB/DB.php?action=getNewsById&news_id='+_news_id;
        $.getJSON(_urlGetNews,function(value,index){
            var _data=value[0];
            console.log(_data);
            $(".news_img").attr("src",_data.Image);
            $(".news_title").html("<h1>" + _data.Title + "</h1>");
            $(".news_likes").html(_data.Nb_Likes + "<i class=\"fa fa-thumbs-up\"></i>");
            $(".news_description").find("p").html(_data.Description);
        })
    })
</script>
<div id="viewNews">
    <div class='card_news'>
        <img class='news_img' width='250px' height='250px' src=''><br/>
        <span class='news_title'></span></span><br/>
    </div>
    <div class="news_description">
        <h2>Description</h2><br>
        <p></p>
    </div>
    <span class='news_likes'></span>
    <button id="likeArticle" name="likeArticle" type="button" class="btn btn-primary" value="<?= $theNews_id ?>">Click to Like this article</button>
</div>

<div id="viewComments">

</div>

<div id="addANewComment">
    <textarea id="comment_username" class="comment_username" placeholder="Your name"></textarea>
    <textarea id="comment_message" class="comment_message" placeholder="Your comment"></textarea>
    <button id="addComment" class="addComment" value="<?= $theNews_id ?>">SEND</button>
</div>

<!--
==============================
    IMPORT FOOTER
==============================
-->
<?php include("./section/_footer.php"); ?>