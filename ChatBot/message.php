    <?php
    // connecting to database
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "mjassistance";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        //     echo "success";
        // }
        // else{
        die("Error" . mysqli_connect_error());
    }

    // getting user message through ajax
    $getMesg = mysqli_real_escape_string($conn, $_POST['text']);

    //checking user query to database query
    $sql = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
    $result = mysqli_query($conn, $sql) or die("Error");

    // if user query matched to database query we'll show the reply otherwise it go to else statement
    if (mysqli_num_rows($result) > 0) {
        //fetching replay from the database according to the user query
        $fetch_data = mysqli_fetch_assoc($result);
        //storing replay to a varible which we'll send to ajax
        $replay = $fetch_data['replies'];
        echo $replay;
    } else {
        echo "Sorry can't be able to understand you! Try again.";
    }

    ?>