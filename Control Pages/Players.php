<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';
@session_start();

$result = [];
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $format = $_POST['format'];

    switch ($format) {
        case 't20i':
            $Table = 't20i_statistics';
            break;
        case 'odi':
            $Table = 'odi_statistics';
            break;
        case 'domestic':
            $Table = 'domestic_statistics';
            break;
        default:
            echo "Invalid format.";
            exit;
    }

    $sql = "DELETE FROM $Table WHERE `Player ID` = '$delete_id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['delete_success'] = true;
        $_SESSION['redirect'] = $_SERVER['PHP_SELF'];
    } else {
        echo "Error: " . $conn->error;
    }
}

$format = $_GET['format'] ?? 't20i';
switch ($format) {
    case 't20i':
        $Table = 't20i_statistics';
        break;
    case 'odi':
        $Table = 'odi_statistics';
        break;
    case 'domestic':
        $Table = 'domestic_statistics';
        break;
    default:
        echo "Invalid format.";
        exit;
}

$sql = "SELECT
    P.`ID` AS `Player ID`,
    P.`Player Name`,
    P.`Player Photo`
FROM players P ORDER BY P.ID ASC";

$records = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white" style="background-image: url('Media/Logo/bg-cn.jpg'); background-size: cover; background-position: center;">
    <h1 class="text-2xl font-bold text-center text-white mt-20 mb-4"> All Players | The Cricket Nerd</h1>
    <div class="container mx-auto rounded-lg shadow-lg mt-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if ($records->num_rows > 0): ?>
                <?php while ($row = $records->fetch_assoc()): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center p-4">
                            <img src="<?php echo 'https://admin.thecricnerd.com/Media/Images/' . htmlspecialchars($row['Player Photo']); ?>" alt="Player Photo" class="w-16 h-16 rounded-full object-cover mr-4">
                            <div>

                                <p class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($row['Player Name']); ?></p>
                                <p class="text-sm text-gray-600">Player ID: <?php echo htmlspecialchars($row['Player ID']); ?></p>
                            </div>
                        </div>
                        <div class="flex justify-between p-4 border-t border-gray-200">
                            <form action="" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['Player ID']); ?>">
                                <input type="hidden" name="format" value="<?php echo htmlspecialchars($format); ?>">
                                <button type="submit" class="text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
                            </form>
                            <a href="Control Pages/Statistics.php?PlayerID=<?php echo htmlspecialchars($row['Player ID']); ?>" class="text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">Update</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-1 md:col-span-2 lg:col-span-4 text-center text-gray-600">
                    No records found.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div id="toast" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg opacity-0 invisible transition-opacity"></div>

    <script>
        function showToast(message) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = "fixed bottom-5 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg opacity-100";
            setTimeout(function() {
                toast.className = toast.className.replace("opacity-100", "opacity-0");
            }, 3000);
        }

        <?php if (isset($_SESSION['delete_success']) && $_SESSION['delete_success']): ?>
            <?php unset($_SESSION['delete_success']); ?>
            showToast('Record deleted successfully.');
        <?php endif; ?>
    </script>
</body>

</html>