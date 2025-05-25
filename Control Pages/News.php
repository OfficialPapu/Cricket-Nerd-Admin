<?php
session_start();
ob_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
// $base_url = $_SERVER['DOCUMENT_ROOT'] . "/The Cricket Nerd Admin/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags($input));
}

@session_start();
@ob_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $deleteId = sanitizeInput($_POST['delete_id']);
    $deleteQuery = "DELETE FROM `news` WHERE `ID` = '$deleteId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        $_SESSION['message'] = "News has been deleted.";
    } else {
        $_SESSION['message'] = "Error deleting news: " . mysqli_error($conn);
    }

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
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
<body class="bg-white" style="background-image: url('Media/Logo/bg-cn.jpg'); background-size: cover; background-position: center;">
    <div id="toast" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-6 py-2 rounded-lg shadow-lg transition-opacity opacity-0 invisible"></div>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-center text-white mt-10 mb-4">All News | The Cricket Nerd</h1>
        <div class="space-y-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
                    <img src="Media/Images/<?php echo htmlspecialchars($row['Thumbnail']); ?>" alt="<?php echo htmlspecialchars($row['Title']); ?>" class="w-20 h-20 max-w-full max-h-full object-contain rounded-lg mr-4">
                    <div class="flex-1">
                        <h2 class="text-sm font-medium text-gray-800"><?php echo htmlspecialchars($row['Title']); ?></h2>
                        <p class="text-sm text-gray-600"><?php echo htmlspecialchars($row['Post Date']); ?></p>
                    </div>
                    
                    <div class="flex items-center space-x-2 ml-4">
            <a href="Control Pages/Edit News.php?NewsID=<?php echo $row['ID']; ?>" target="_blank" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-600 text-sm">Edit</a>
            <form action="" method="POST" onsubmit="confirmDeletion(event)">
                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['ID']); ?>">
                <button type="submit" class="bg-red-700 rounded-full px-4 py-2 text-white hover:text-green-700 text-sm">Delete</button>
            </form>
        </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>
