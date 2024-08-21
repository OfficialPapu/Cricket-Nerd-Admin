<?php
session_start(); // Start the session at the very beginning
ob_start(); // Start output buffering

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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 100px auto;
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

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        table, th, td {
            border: none;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            color:blue;
        }

        .button {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #c0392b;
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
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

        @media screen and (max-width: 768px) {
            h1 {
                font-size: 1.75rem;
            }

            table, th, td {
                font-size: 14px;
            }

            .button {
                font-size: 12px;
                padding: 8px 12px;
            }
        }

        @media screen and (max-width: 480px) {
            .container {
                padding: 10px;
            }

            table, th, td {
                font-size: 12px;
            }

            th, td {
                padding: 8px;
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            td {
                text-align: right;
                position: relative;
                padding-left: 50%;
                white-space: normal;
                box-sizing: border-box;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 10px;
                font-weight: bold;
                white-space: nowrap;
            }

            .button {
                font-size: 10px;
                padding: 6px 10px;
            }
        }
    </style>
    <script>
        function showToast(message) {
            var toast = document.getElementById("toast");
            toast.textContent = message;
            toast.className = "toast show";
            setTimeout(function () { toast.className = toast.className.replace("show", ""); }, 3000);
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
<body>
    <div class="toast" id="toast"></div>
    <div class="container">
        <h1>Matches Gallery</h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tournament Name</th>
                        <th>Country A</th>
                        <th>Country B</th>
                        <th>Schedule</th>
                        <th>Time</th>
                        <th>Post Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td data-label="ID"><?php echo htmlspecialchars($row['ID']); ?></td>
                                <td data-label="Tournament Name"><?php echo htmlspecialchars($row['Tournament Name']); ?></td>
                                <td data-label="Country A"><?php echo htmlspecialchars($row['Country A']); ?></td>
                                <td data-label="Country B"><?php echo htmlspecialchars($row['Country B']); ?></td>
                                <td data-label="Schedule"><?php echo htmlspecialchars($row['Schedule']); ?></td>
                                <td data-label="Time"><?php echo htmlspecialchars($row['Time']); ?></td>
                                <td data-label="Post Date"><?php echo htmlspecialchars($row['Post Date']); ?></td>
                                <td data-label="Actions">
                                    <form action="" method="POST" style="display:inline;" onsubmit="confirmDeletion(event, this)">
                                        <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['ID']); ?>">
                                        <button type="submit" class="button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No matches found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
