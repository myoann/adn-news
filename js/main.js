var _url_DB="./DB/DB.php";

function ajaxPOST(_data,_messageSuccess,_redirection){
    console.log("received : ");
    console.log(_data);
    $.ajax({
        type: 'POST',
        url: _url_DB,
        data:_data,
        success:function(data){
            console.log(_messageSuccess);
        }
    })
}

function getNewsByTitle(){
    var _url_getNews='./DB/DB.php?action=getNewsByTitle&title_news='+getParameterByName('title_news');
    $.getJSON(_url_getNews,function(data){
        var _cardNews="";
        var _sectionHome=$("section#home").find("div.content");
        $.each(data,function(index,object){
            _cardNews=build_cardNews(object);
            _sectionHome.append(_cardNews);
        });
    });
}

function displayNews(){
    var _url_getNews='./DB/DB.php?action=getNews';
    $.getJSON(_url_getNews,function(data){
        var _cardNews="";
        var _sectionHome=$("section#home").find("div.content");
        $.each(data,function(index,object){
            _cardNews=build_cardNews(object);
            _sectionHome.prepend(_cardNews);
        });
    });
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function build_cardNews(object){
    var _cardNews="<div class='card_news'>";
    _cardNews+="<span class='card_nb_likes'>"+object.Nb_Likes+"<i class=\"fa fa-thumbs-up\"></i></span>";
    _cardNews+="<img class='card_img card_bg_img' src='"+object.Image+"' />";
    _cardNews+="<span class='card_title'>"+object.Title;
    _cardNews+="</div>";
    return "<a href='./news_page.php?action=getNewsById&news_id="+object.News_Id+"'>"+_cardNews+"</a>"
}

$(function(){
    init();
})

function init() {
    /* ----- REGISTER ----- */
    $("button#signup").unbind("click").bind("click", function () {
        // get the data of the signup form
        var _FirstName = $.trim($("#firstname").val());
        var _LastName = $.trim($("#lastname").val());
        var _Email = $.trim($("#email").val());
        var _Password = $.trim($("#pwd").val());

        // if they exist and are not null
        if (_FirstName && _LastName && _Email && _Password) {
            var _data = {
                action: 'addNewUser',
                FirstName: _FirstName,
                LastName: _LastName,
                Email: _Email,
                Password: _Password
            }
            var _messageSuccess = "Thanks for your subscription.";
            ajaxPOST(_data, _messageSuccess, "home.php");
        }
    })

    /* ----- LOGIN ----- */
    $("button#login").unbind("click").bind("click",function(){
        var _Email=$.trim($("#Email").val());
        var _Password=$.trim($("#Password").val());

        // s'ils existent et ne sont pas nul :
        if (_Email && _Password){
            var _data={
                action: 'loginUser',
                Email: _Email,
                Password: _Password
            }
            var _messageSuccess="You are now connected";
            ajaxPOSTLogin(_data,_messageSuccess, "home.php");
        }
    });

    /* ----- ADD A NEWS ----- */
    $("button#addnews").unbind("click").bind("click", function () {
        // get the data of the add news form
        var _Title = $.trim($("#title").val());
        var _ImageLink = $.trim($("#imagelink").val());
        var _Description = $.trim($("#description").val());
        var _Link = $.trim($("#link").val());

        // if they exist and are not null
        if (_Title && _ImageLink && _Description && _Link) {
            var _data = {
                action: 'addNewNews',
                Title: _Title,
                ImageLink: _ImageLink,
                Description: _Description,
                Link: _Link
            }
            var _messageSuccess = "Thanks for adding this news.";
            ajaxPOST(_data, _messageSuccess, "home.php");
        }
    })

    /* ----- ADD A COMMENT ----- */
    $("button#addComment").unbind("click").bind("click", function () {
        // get the data of the add comment form
        var _Username = $.trim($("#comment_username").val());
        var _CommentMessage = $.trim($("#comment_message").val());
        var _NewsId = $.trim($("#addComment").val());

        // if they exist and are not null
         if (_Username && _CommentMessage && _NewsId) {
            var _data = {
                action: 'addNewComment',
                Username: _Username,
                CommentMessage: _CommentMessage,
                NewsId: _NewsId
            }
            var _messageSuccess = "Thanks for adding this comment.";
            ajaxPOST(_data, _messageSuccess, "home.php");
        }
    })

    /* ----- LIKE AN ARTICLE ----- */
    $("button#likeArticle").unbind("click").bind("click", function () {
        // get the data of the article liked
        var _NewsId = $.trim($("#likeArticle").val());
        
        // if it exists and is not null
        if (_NewsId) {
            var _data = {
                action: 'updateNbLikes',
                NewsId: _NewsId
            }
            var _messageSuccess = "Thanks for liking the article.";
            ajaxPOST(_data, _messageSuccess, "home.php");
        }
    })
}