<?php
/* General */
function isLoggedIn()
{
    if (
        !isset($_SESSION['id']) || !isset($_SESSION['username']) || !isset($_SESSION['fname'])
        || !isset($_SESSION['lname'])
    ) {

        header("Location: /netciety/");
    }
}

function confirmQuery($query)
{
    global $connection;

    if (!$query) {

        die("QUERY FAILED: " . mysqli_error($connection));
    }
}

function getLink($prev_page, $username)
{
    global $connection;

    if ($prev_page == 'main') {

        return "index.php";
    } elseif ($prev_page == 'dash') {

        if ($username == $_SESSION['username']) {

            return "dashboard";
        }

        return "Fprofiles?user=$username";
    }
}
/* GENERAL END */

/* ABOUT LIKE */
function userLikeExist($user_id, $post_id)
{
    global $connection;

    $query = "SELECT * FROM likes WHERE like_post_id = $post_id AND like_user_id = $user_id";
    $getQuery = mysqli_query($connection, $query);

    if (mysqli_num_rows($getQuery) > 0) {

        return true;
    }
    return false;
}

function likePost($user_id, $post_id)
{
    global $connection;

    // Check if user exist in database

    if (userLikeExist($user_id, $post_id)) {

        // User alread exists
        // Check if current like status is dislike
        if (isDislike($user_id, $post_id)) {

            $query = "UPDATE posts SET post_like_count = post_like_count + 1 
            WHERE post_id = $post_id";
            $updatePost = mysqli_query($connection, $query);

            $query = "UPDATE likes SET like_status = 'like' 
            WHERE like_post_id = $post_id AND like_user_id = $user_id";
            $updateLikes = mysqli_query($connection, $query);
        }
    } else {

        // Not like before, create new like
        $query = "INSERT INTO likes(like_post_id,like_user_id,like_status) 
                VALUES($post_id, $user_id, 'like')";
        $createLike = mysqli_query($connection, $query);

        $query = "UPDATE posts SET post_like_count = post_like_count + 1 
                WHERE post_id = $post_id";
        $updatePost = mysqli_query($connection, $query);
    }
}

function dislikePost($user_id, $post_id)
{
    global $connection;

    // Check if current like status is like
    if (isLike($user_id, $post_id)) {

        $query = "UPDATE likes SET like_status = 'unlike' 
        WHERE like_post_id = $post_id AND like_user_id = $user_id";
        $updateLike = mysqli_query($connection, $query);

        $query = "UPDATE posts SET post_like_count = post_like_count - 1 
        WHERE post_id = $post_id";
        $updatePost = mysqli_query($connection, $query);
    }
}

function isLike($user_id, $post_id)
{
    global $connection;

    $query = "SELECT * FROM likes WHERE like_user_id = $user_id 
                AND like_post_id = $post_id AND like_status = 'like'";
    $getQuery = mysqli_query($connection, $query);

    return (mysqli_num_rows($getQuery) > 0) ? true : false;
}

function isDislike($user_id, $post_id)
{
    global $connection;

    $query = "SELECT * FROM likes WHERE like_user_id = $user_id 
                AND like_post_id = $post_id AND like_status = 'unlike'";
    $getQuery = mysqli_query($connection, $query);

    return (mysqli_num_rows($getQuery) > 0) ? true : false;
}

function getLikeCount($post_id)
{
    global $connection;

    $query = "SELECT post_like_count FROM posts WHERE post_id = $post_id";
    $getCount = mysqli_query($connection, $query);

    return mysqli_fetch_array($getCount)['post_like_count'];
}

function getCommentCount($post_id)
{
    global $connection;

    $query = "SELECT post_comment_count FROM posts WHERE post_id = $post_id";
    $getCount = mysqli_query($connection, $query);

    return mysqli_fetch_array($getCount)['post_comment_count'];
}
/* LIKE END */

/* Member details */
function getUsername($member_id)
{
    global $connection;

    $query = "SELECT * FROM member WHERE member_id = $member_id";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['username'];
}

function getID($username)
{
    global $connection;

    $query = "SELECT * FROM member WHERE username = '$username'";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_id'];
}

function getFirstName($member_id)
{
    global $connection;

    $query = "SELECT * FROM member WHERE member_id = $member_id";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_fname'];
}

function getFirstName2($username)
{
    global $connection;

    $query = "SELECT * FROM member WHERE username = '$username'";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_fname'];
}

function getLastName($member_id)
{
    global $connection;

    $query = "SELECT * FROM member WHERE member_id = $member_id";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_lname'];
}

function getLastName2($username)
{
    global $connection;

    $query = "SELECT * FROM member WHERE username = '$username'";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_lname'];
}

function getEmail($member_id)
{
    global $connection;

    $query = "SELECT * FROM member WHERE member_id = $member_id";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_email'];
}

function getEmail2($username)
{
    global $connection;

    $query = "SELECT * FROM member WHERE username = '$username'";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_email'];
}

function getTotalFriend($member_id)
{
    global $connection;

    $query = "SELECT * FROM member WHERE member_id = $member_id";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_total_friend'];
}

function getTotalFriend2($username)
{
    global $connection;

    $query = "SELECT * FROM member WHERE username = '$username'";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_total_friend'];
}

function getTotalPost($member_id)
{
    global $connection;

    $query = "SELECT * FROM member WHERE member_id = $member_id";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_total_post'];
}

function getTotalPost2($username)
{
    global $connection;

    $query = "SELECT * FROM member WHERE username = '$username'";
    $memberQuery = mysqli_query($connection, $query);
    confirmQuery($memberQuery);
    $row = mysqli_fetch_array($memberQuery);

    return $row['member_total_post'];
}

function usernameOrName($username, $fname, $lname)
{
    global $connection;

    if (empty($fname)) {

        return ucfirst($username);
    }

    return $fname . " " . $lname;
}

function getImage($member_id)
{
    global $connection;

    $query = "SELECT * FROM member WHERE member_id = $member_id";
    $getQuery = mysqli_query($connection, $query);
    confirmQuery($getQuery);
    $row = mysqli_fetch_array($getQuery);

    return $row['member_profile_photo'];
}
/* Member Details  END */

/* Friend */
function isFriend($self_id, $other_id)
{
    global $connection;

    $query = "SELECT * FROM friendrequest 
        WHERE (sender_id = $self_id AND receiver_id = $other_id AND request_status = 'accept') 
        OR (sender_id = $other_id AND receiver_id = $self_id AND request_status = 'accept')";
    $friendQuery = mysqli_query($connection, $query);
    confirmQuery($friendQuery);

    return (mysqli_num_rows($friendQuery) == 1) ? true : false;
}
/* Friend END */

/* POST */
function isOwner($post_id)
{
    global $connection;

    $id = $_SESSION['id'];
    $query = "SELECT * FROM posts WHERE post_id = $post_id AND post_user_id = $id";
    $ownerQuery = mysqli_query($connection, $query);
    confirmQuery($ownerQuery);

    return (mysqli_num_rows($ownerQuery) == 1) ? true : false;
}
/* POST END */
