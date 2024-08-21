<?php
session_start(); // Start the session at the very beginning
ob_start(); // Start output buffering
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

@session_start(); // Start the session at the very beginning
@ob_start(); // Start output buffering

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $deleteId = sanitizeInput($_POST['delete_id']);
    $deleteQuery = "DELETE FROM `news` WHERE `ID` = '$deleteId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        $_SESSION['message'] = "News has been deleted.";
    } else {
        $_SESSION['message'] = "Error deleting news: " . mysqli_error($conn);
    }

    // Close connection before redirect
  
   
    ob_end_clean();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$query = "SELECT * FROM `news` ORDER BY `Post Date` DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Gallery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 70px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 15px;
            font-weight: 500;
            font-size: 1.8rem;
            color: blue;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .news-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .news-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
        }

        .news-item:hover {
            transform: translateY(-5px);
        }

        .news-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .news-item h2 {
            font-size: 1.4em;
            margin: 10px 0;
        }

        .news-item p {
            margin: 10px 0;
            color: #666;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .news-item button, .news-item a {
            display: block;
            text-align: center;
            padding: 10px;
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.3s;
            margin: 5px 0;
            border: none;
            cursor: pointer;
        }

        .news-item button {
            background: #dc3545;
            color: #fff;
        }

        .news-item a {
            background: #007bff;
            color: #fff;
        }

        .news-item a:hover, .news-item button:hover {
            opacity: 0.8;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .actions a, .actions button {
            flex: 1;
        }

        .toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        .toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
    <script>
        function confirmDeletion(event) {
            if (!confirm('Are you sure you want to delete this news?')) {
                event.preventDefault();
            }
        }

        function showToast(message) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = "toast show";
            setTimeout(function () { 
                toast.className = toast.className.replace("show", "");
                // Reload the page to reflect changes
                window.location.reload();
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['message'])): ?>
                showToast('<?php echo $_SESSION['message']; unset($_SESSION['message']); ?>');
            <?php endif; ?>
        });
    </script>
</head>
<body>
    <div class="toast" id="toast"></div>
    <div class="container">
        <h1>News Gallery</h1>
        <div class="news-gallery">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="news-item">
                    <img src="Media/Images/<?php echo htmlspecialchars($row['Thumbnail']); ?>" alt="<?php echo htmlspecialchars($row['Title']); ?>">
                    <h2><?php echo htmlspecialchars(mb_strimwidth($row['Title'], 0, 30, "...")); ?></h2>
                    <p><?php echo htmlspecialchars(mb_strimwidth($row['Description'], 0, 30, "...")); ?></p>
                    <div class="actions">
                        <a href="<?php echo htmlspecialchars($row['Slug Url']); ?>" target="_blank">Read More</a>
                        <form action="" method="POST" onsubmit="confirmDeletion(event)">
                            <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['ID']); ?>">
                            <button type="submit">Delete News</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php
// Ensure the connection is closed
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>
