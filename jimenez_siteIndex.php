<?php
	$servername = "localhost";
	$username = "jimenez";
	$password = "christian0855";
	$dbname = "jimenez_site";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	// Get number of records 
	  $sql = "SELECT count(title) FROM post";
	  $rec_limit=5;
	  $result = mysqli_query($conn,$sql);

	if(!$result)
	{
		die("Could not retrieve data: " .mysqli_error());
	}
	/*
	try {

    // Find out how many items are in the table
    $total[] = mysqli_query($conn,$sql,MYSQLI_USE_RESULT)->mysqli_fetch_column;

    // How many items to list per page
    $limit = 5;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    // The "back" link
    $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

    // The "forward" link
    $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

    // Display the paging information
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    // Prepare the paged query
    $stmt = $conn->prepare('
        SELECT
            *
        FROM
            post
        ORDER BY
            date_time
        LIMIT
            5
        OFFSET
            4
    ');

    // Bind the query params
    $stmt->bindParam('5', $limit, PDO::PARAM_INT);
    $stmt->bindParam('4', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Do we have any results?
    if ($stmt->rowCount() > 0) {
        // Define how we want to fetch the results
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($stmt);

        // Display the results
        foreach ($iterator as $row) {
            echo '<p>', $row['name'], '</p>';
        }

    } else {
        echo '<p>No results could be displayed.</p>';
    }

} catch (Exception $e) {
    echo '<p>', $e->getMessage(), '</p>';
}*/
	$row=mysqli_fetch_array($result,MYSQL_NUM);
	$rec_count=$row[0];

	if(isset($_GET{'page'}))
	{
		$page=$_GET{'page'}+1;
		$offset=$rec_limit*$page;
	}

	else
	{
		$page=0;
		$offset=0;
	}

	$left_rec=$rec_count-($page*$rec_limit);
	$sql="SELECT title,username_thatcreatedpost,date_time FROM post ORDER BY date_time DESC LIMIT $offset,$rec_limit";

	$result=mysqli_query($conn,$sql);

	if(!$result)
	{
		die("Could not retrieve data: " .mysql_error());
	}

	while($row=mysqli_fetch_array($result,MYSQL_ASSOC))
	{
		echo "Title:{$row['title']}<br>".
		"Username:{$row['username_thatcreatedpost']}<br>".
		"Date/Time:{$row['date_time']}<br>".
		"---------------------------------------------------<br>";
	}

	if($page>0)
	{
		$last=$page-1;
		echo "<a href = \"$_PHP_SELF?page = $last\">Last 5 Posts</a> |";
		echo "<a href = \"$_PHP_SELF?page = $page\">Next 5 Posts</a>";
	}

	else if($page==0)
	{
		echo "<a href = \"$_PHP_SELF?page = $page\">Next 5 Posts</a>";
	}

	else if($left_rec<$rec_limit)
	{
		$last=$page-1;
		echo "<a href = \"$_PHP_SELF?page = $last\">Last 5 Posts</a>";
	}
 
	$conn->close();
?>
