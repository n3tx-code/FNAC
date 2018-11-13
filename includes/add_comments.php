<?php

include('bdd.php');

if(!isset($_SESSION['id']) OR empty($_SESSION['id']) OR !isset($_POST['reference']) OR empty($_POST['reference'])
   OR !isset($_POST['grade']) OR empty($_POST['grade']) OR !isset($_POST['comment']) OR empty($_POST['comment']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

$client = $_SESSION['id'];
$reference = $_POST['reference'];
$grade = $_POST['grade'];
$comment = $_POST['comment'];

// create wordlist
$list = [];
foreach ($list as $word)
{
    if(strpos($comment, $word) !== false)
    {
        echo "pas bien d'insulter :o !";
        exit();
    }
}

$sql = 'INSERT INTO opinion(client, reference, grade, comment) VALUES(:client, :reference, :grade, :comment)';
$req = $bdd->prepare($sql);
$req->execute(array(
   'client' => $client,
    'reference' => $reference,
    'grade' => $grade,
    'comment' => $comment
));

?>