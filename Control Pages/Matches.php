<?php
session_start(); 
ob_start();

$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';

$result = []; 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM `matches` WHERE `ID` = ?");
    $stmt->bind_param("i", $deleteId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Match deleted successfully.";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$query = "SELECT * FROM `matches` ORDER BY `Post Date` DESC";
if ($result = $conn->query($query)) {
    // Successful query
} else {
    $_SESSION['message'] = "Error fetching data: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function showToast(message) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = "fixed bottom-5 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-6 py-2 rounded-lg shadow-lg transition-opacity opacity-100";
            setTimeout(function () { toast.className = toast.className.replace("opacity-100", "opacity-0"); }, 3000);
        }

        function confirmDeletion(event, form) {
            event.preventDefault(); 
            if (confirm('Are you sure you want to delete this match?')) {
                form.submit();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['message'])): ?>
                showToast('<?php echo $_SESSION['message']; unset($_SESSION['message']); ?>');
            <?php endif; ?>
        });
    </script>
</head>
<body class="bg-white" style="background-image: url('Media/Logo/bg-cn.jpg'); background-size: cover; background-position: center;">
    <div id="toast" class="opacity-0 invisible"></div>
    <h1 class="text-2xl font-bold text-center text-white mt-20 mb-4"> All Matches | The Cricket Nerd</h1>
    <div class="container mx-auto rounded-lg shadow-lg mt-8">
        
        <div class="space-y-4 mt-4">
            <?php if ($result): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 flex items-center">
                        <div class="flex-1">
                            <h2 class="text-sm font-bold text-gray-800"><?php echo htmlspecialchars($row['Tournament Name']); ?></h2>
                            <p class="text-xs text-gray-600 mt-1"><?php echo htmlspecialchars($row['Country A']) . " vs " . htmlspecialchars($row['Country B']); ?></p>
                            <p class="text-xs text-gray-600"><strong>Schedule:</strong> <?php echo htmlspecialchars($row['Schedule']); ?></p>
                            <p class="text-xs text-gray-600"><strong>Time:</strong> <?php echo htmlspecialchars($row['Time']); ?></p>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <form action="" method="POST" class="inline" onsubmit="confirmDeletion(event, this)">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['ID']); ?>">
                                <button type="submit" class="text-white bg-red-500 px-3 py-1 rounded-lg hover:bg-red-600 text-xs">Delete</button>
                            </form>
                            
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center text-gray-600">
                    No matches found.
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
