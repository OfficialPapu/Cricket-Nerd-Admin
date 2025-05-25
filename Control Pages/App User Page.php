<?php
session_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';

$search = '';
$result = null;

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT DISTINCT `email` FROM `app` WHERE `Email` LIKE ? ORDER BY `email` ASC";
    $stmt = $conn->prepare($query);
    $search_param = '%' . $search . '%';
    $stmt->bind_param('s', $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $_SESSION['toast'] = "No matching emails found.";
    }
} else {
    $query = "SELECT DISTINCT `email` FROM app ORDER BY `email` ASC";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App User List | The Cricket Nerd</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .toast {
            transition: opacity 0.5s ease-in-out;
            position: fixed;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            opacity: 0;
            visibility: hidden;
        }
        .toast.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['toast'])): ?>
                showToast('<?php echo $_SESSION['toast']; unset($_SESSION['toast']); ?>');
            <?php endif; ?>
        });

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    </script>
</head>
<body class="bg-gray-100" style="background-image: url('Media/Logo/bg-cn.jpg'); background-size: cover; background-position: center;">
    <div id="toast" class="toast"></div>

    <div class="container mx-auto py-8 px-1">
       <h1 class="text-2xl font-bold text-center text-white mt-10 mb-4">App User List | The Cricket Nerd</h1>
        <form method="GET" action="" class="mb-6 flex flex-col sm:flex-row gap-2">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by email" class="border rounded-lg px-4 py-2 flex-grow">
            <button type="submit" class="bg-blue-700 text-white rounded-lg px-4 py-2">Search</button>
        </form>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full table-fit text-sm">
                    <thead>
                        <tr class="bg-blue-700 text-white px-20">
                            <th class="px-8 py-6 text-left">SN</th>
                            <th class="px-8 py-6 text-left">Email</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php $sn = 1; ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-8 py-6"><?php echo $sn++; ?></td>
                                    <td class="px-8 py-6"><?php echo htmlspecialchars($row['email']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td class="px-4 py-2 text-center" colspan="2">No emails found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
