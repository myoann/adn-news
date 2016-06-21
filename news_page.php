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
        $( document ).ready(function() {


            $("body").css("background-image", "url('http://bgfons.com/upload/newspaper_texture2847.jpg')");
            var _news_id = getParameterByName('news_id');
            var _urlGetNews = './DB/DB.php?action=getNewsById&news_id=' + _news_id;
            $.getJSON(_urlGetNews, function (value, index) {
                var _data = value[0];
                $(".card-img-top").attr("src", _data.Image);
                $(".card-title").html(_data.Title);
                $(".card-likes").html(_data.Nb_Likes + "<i class=\"fa fa-thumbs-up\"></i>");
                $(".card-text").html(_data.Description);
                $(".url-source").attr("href", _data.Link);
                var nbLines = value.NbLines;
                for (var i = 0; i < nbLines; i++) {
                    var com_username = value[i].Comment_Username;
                    var com_message = value[i].Comment_Message;
                    var com_date = value[i].Comment_Date;
                    if (com_date != null && com_message != null && com_username != null) {
                        $(".comments-list").append("<div class='card' style='width:500px; margin-left:auto; margin-right:auto;'>" +
                            "<div class='card-header'>" + com_username + "</div>" +
                            "<div class='card-block'>" +
                            "<blockquote class='card-blockquote'>" +
                            "<p>" + com_message + "</p>" +
                            "<footer><small>" + com_date + "</small></footer>" +
                            "</blockquote>" +
                            "</div>" +
                            "</div>");
                    }
                }
            })
        });
    })
</script>
<div class="card-deck-wrapper">
    <div class="card-deck" style="margin-left:auto; margin-right:auto;">
        <div class="card" style="width:500px;">
            <img class="card-img-top" src="" alt="Card image cap" width="500px" height="425px">
            <div class="card-block" style="text-align: center;">
                <h4 class="card-title"></h4>
                <p class="card-text" style="text-align: justify;"></p>
                <hr size="75%"/>
                <button id="likeArticle" name="likeArticle" type="button" class="btn btn-primary" value="<?= $theNews_id ?>" >Click to Like this article</button><br/>
                <p class="card-likes"></p>
                <p class="source" style="text-align: right; text-decoration:none; color:grey;"><a class="url-source" href="" target="_blank">source</a></p>
            </div>
        </div>
    </div>
</div>

<div class="comments-list">

</div>


<div class="addNewComment">
    <div class="addNewComment-triangle"></div>

    <h2 class="addNewComment-header">Add a comment</h2>

    <form class="addNewComment-container">
        <p><input id="comment_username" class="comment_username" type="text" placeholder="Your name"></p>
        <p><textarea id="comment_message" class="comment_message" type="text" placeholder="Your comment"></textarea></p>
        <p><button id="addComment" class="addComment" value="<?= $theNews_id ?>">SEND</button></p>
    </form>
</div>


<!--
==============================
    IMPORT FOOTER
==============================
-->
<?php include("./section/_footer.php"); ?>