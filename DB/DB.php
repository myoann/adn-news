<?php
    // Session will last 3456000 seconds (=40days)
    ini_set('session.cookie_lifetime', 3456000);
    ini_set('session.gc_maxlifetime', 3456000);
    $lifetime=3456000;
    session_start();
    setcookie(session_name(),session_id(),time()+$lifetime);
    if (isset($_SESSION['USER_ID'])){
        $idUser=$_SESSION['USER_ID'];
    }

	include 'connexion.php';
	$dbh=connexion();

	// -- insert functions
    function addNewComment($dbh, $Username, $CommentMessage, $NewsId) {
        $stmt=$dbh->prepare('INSERT INTO comment (Comment_Username,Comment_Message,Comment_News) VALUES (:Username,:CommentMessage,:NewsId)');
        $stmt->bindParam(':Username',$Username);
        $stmt->bindParam(':CommentMessage',$CommentMessage);
        $stmt->bindParam(':NewsId',$NewsId);
        $stmt->execute();
    }

	function addNewUser($dbh,$FirstName,$LastName, $Email,$Password){
        $stmt=$dbh->prepare('INSERT INTO user (First_Name,Last_Name,Email,Password) VALUES (:FirstName,:LastName,:Email,:Password)');
        $stmt->bindParam(':FirstName',$FirstName);
        $stmt->bindParam(':LastName',$LastName);
        $stmt->bindParam(':Email',$Email);
        $stmt->bindParam(':Password',$Password);
        $stmt->execute();
    }

    function addNewNews($dbh,$Title,$ImageLink,$Description,$Link){
        $stmt=$dbh->prepare('INSERT INTO news (Title,Image,Description,Link,Nb_Likes) VALUES (:Title,:ImageLink,:Description,:Link,0)');
        $stmt->bindParam(':Title',$Title);
        $stmt->bindParam(':ImageLink',$ImageLink);
        $stmt->bindParam(':Description',$Description);
        $stmt->bindParam(':Link',$Link);
        $stmt->execute();
    }

    // -- select functions
    function getUser($user_id){
        $sql = 'SELECT * FROM user WHERE User_Id=:user_id';
        $stmt =  connexion()->prepare($sql);
        $stmt->bindParam(':user_id',$user_id);

        $stmt->setFetchMode(PDO::FETCH_OBJ);

        //Compiler et exécuter la requête
        $stmt->execute();

        //Récupérer toutes les données retournées
        $resultJSON=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultJSON);
    }

    function getNewsById($news_id){
        $sql = 'SELECT * FROM news n LEFT JOIN comment c ON n.News_Id=c.Comment_News WHERE n.News_Id=:news_id';
        $stmt =  connexion()->prepare($sql);
        $stmt->bindParam(':news_id',$news_id);

        $stmt->setFetchMode(PDO::FETCH_OBJ);

        //Compiler et exécuter la requête
        $stmt->execute();

        //Récupérer toutes les données retournées
        $resultJSON=$stmt->fetchAll(PDO::FETCH_ASSOC);

        $resultJSON['NbLines'] = sizeof($resultJSON);

        echo json_encode($resultJSON);
    }

    function getNewsByTitle($titleNews){
        $sql = 'SELECT * FROM news WHERE Title LIKE '.'"%'.$titleNews.'%"';
        $stmt =  connexion()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        //Compiler et exécuter la requête
        $stmt->execute();

        //Récupérer toutes les données retournées
        $resultJSON=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultJSON);
    }

    function getNews(){
        $sql = 'SELECT * FROM news ORDER BY Posted_Time DESC';
        $stmt =  connexion()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        //Compiler et exécuter la requête
        $stmt->execute();

        //Récupérer toutes les données retournées
        $resultJSON=$stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultJSON);
    }

    function verifyLoginUser($dbh,$email, $pwd) {
        $stmt=$dbh->prepare('SELECT count(User_Id) as nbUser, User_Id, First_Name, Last_Name, Email FROM user WHERE (Email=:email AND Password=:password)');
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$pwd);
        $stmt->execute();
        $f=$stmt->fetch();

        $_SESSION['USER_ID']=$f['User_Id'];
        $_SESSION['EMAIL']=$f['Email'];
        echo json_encode($f);
    }

    // -- update functions
    function updateNbLikes($dbh,$news_id) {
        $stmt =$dbh->prepare('UPDATE news SET Nb_Likes=Nb_Likes+1 WHERE News_Id=:news_id');
        $stmt->bindParam(':news_id',$news_id);
        $stmt->execute();
    }

    $action=null;
    if (isset($_POST['action'])) $action=$_POST['action'];
    if (isset($_GET['action'])) $action=$_GET['action'];
    if (isset($action)) {
        switch ($action) {
            // -- Adding a new comment
            case "addNewComment":
                addNewComment($dbh, $_GET['Username'], $_GET['CommentMessage'], $_GET['NewsId']);
                break;
            // -- Adding a new user
            case "addNewUser":
                addNewUser($dbh, $_POST['FirstName'], $_POST['LastName'], $_POST['Email'], $_POST['Password']);
                break;
            // -- Adding a new news
            case "addNewNews":
                addNewNews($dbh, $_GET['Title'], $_GET['ImageLink'], $_GET['Description'], $_GET['Link']);
                break;
            case "getNews":
                getNews();
                break;
            case "getNewsById":
                getNewsById($_GET['news_id']);
                break;
            case "getUser":
                getUser($_GET['user_Id']);
                break;
            case "verifyLoginUser":
                verifyLoginUser($dbh, $_POST['Email'], $_POST['Password']);
                break;
            case "updateNbLikes":
                updateNbLikes($dbh, $_GET['news_id']);
                break;
        }
    }
?>