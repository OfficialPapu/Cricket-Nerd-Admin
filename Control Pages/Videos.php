<?php
session_start(); // Start the session at the very beginning
ob_start(); // Start output buffering
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';



// Handle video deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_id = $_POST['video_id'];

    $stmt = $conn->prepare("DELETE FROM `videos` WHERE `ID` = ?");
    if ($stmt) {
        $stmt->bind_param("i", $video_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Video deleted successfully.";
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }

    // Flush the buffer and redirect
    ob_end_clean();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch data from the database
$query = "SELECT * FROM `videos` ORDER BY `Post Date` DESC";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
                margin-top: 10px;
                margin-bottom: 15px;
            
                font-weight: 500;
                font-size: 1.8rem;


                max-width: 1200px;
                margin: 40px auto;
                padding: 20px;
                text-align: center;
                margin-bottom: 20px;
                color: blue;
            
                background-color: #fff;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
        }

        .video-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .video-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
            max-width: 300px;
            display: flex;
            flex-direction: column;
        }

        .video-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .video-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .video-item h2 {
            font-size: 1.2em;
            margin: 10px;
            color: #333;
            flex-grow: 1;
        }

        .video-item p {
            margin: 0 10px 10px 10px;
            color: #666;
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 10px;
        }

        .actions a, .actions button {
            flex: 1;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
        }

        .actions a {
            background: #007bff;
            color: #fff;
        }

        .actions button {
            background: red;
            color: #fff;
        }

        .actions a:hover {
            background: #0056b3;
        }

        .actions button:hover {
            background: #c0392b;
        }

        .toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            transform: translateX(-50%);
        }

        .toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from { bottom: 0; opacity: 0; }
            to { bottom: 30px; opacity: 1; }
        }

        @keyframes fadeout {
            from { bottom: 30px; opacity: 1; }
            to { bottom: 0; opacity: 0; }
        }

        @media screen and (max-width: 768px) {
            h1 {
                font-size: 1.75rem;
            }

            .video-item h2 {
                font-size: 1em;
            }

            .video-item p {
                font-size: 0.9em;
            }

            .actions a, .actions button {
                font-size: 0.9em;
                padding: 8px;
            }
        }
    </style>
    <script>
        function confirmDeletion(event) {
            if (!confirm('Are you sure you want to delete this video?')) {
                event.preventDefault();
            }
        }

        function showToast(message) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = "toast show";
            setTimeout(function () { toast.className = toast.className.replace("show", ""); }, 3000);
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
        <h1>Video Gallery</h1>
        <div class="video-gallery">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="video-item">
                    <img src="Media/Images/<?php echo htmlspecialchars($row['Thumbnail']); ?>" alt="<?php echo htmlspecialchars($row['Title']); ?>">
                    <h2><?php echo htmlspecialchars(mb_strimwidth($row['Title'], 0, 30, "...")); ?></h2>
                    <p><?php echo htmlspecialchars(mb_strimwidth($row['Description'], 0, 30, "...")); ?></p>
                    <div class="actions">
                        <a href="<?php echo htmlspecialchars($row['Link']); ?>" target="_blank">Watch Video</a>
                        <form action="" method="POST" onsubmit="confirmDeletion(event)">
                            <input type="hidden" name="video_id" value="<?php echo htmlspecialchars($row['ID']); ?>">
                            <button type="submit">Delete Video</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
