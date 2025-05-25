<?php
session_start();
ob_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';

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
    ob_end_clean();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
$query = "SELECT * FROM `videos` ORDER BY `Post Date` DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function confirmDeletion(event) {
            if (!confirm('Are you sure you want to delete this video?')) {
                event.preventDefault();
            }
        }

        function showToast(message) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.classList.add("visible", "opacity-100");
            setTimeout(function () {
                toast.classList.remove("visible", "opacity-100");
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
        <h1 class="text-2xl font-bold text-center text-white mt-10 mb-4">All Videos | The Cricket Nerd</h1>

        <div class="space-y-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
                    <img src="Media/Images/<?php echo htmlspecialchars($row['Thumbnail']); ?>" alt="<?php echo htmlspecialchars($row['Title']); ?>" class="w-20 h-20 max-w-full max-h-full object-contain rounded-lg mr-4">
                    <div class="flex-1">
                        <h2 class="text-sm font-medium text-gray-800"><?php echo htmlspecialchars($row['Title']); ?></h2>
                        <p class="text-sm text-gray-600"><?php echo htmlspecialchars($row['Post Date']); ?></p>
                    </div>
                    <form action="" method="POST" onsubmit="confirmDeletion(event)" class="ml-4">
                        <input type="hidden" name="video_id" value="<?php echo htmlspecialchars($row['ID']); ?>">
                        <button type="submit" class="bg-blue-700 rounded-full px-4 py-2 text-white hover:text-red-700 text-sm">Delete</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>


<?php
$conn->close();
?>
