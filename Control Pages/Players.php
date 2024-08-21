<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';
@session_start();

$result = [];

// Handle deletion
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
        $_SESSION['redirect'] = $_SERVER['PHP_SELF']; // Store redirect URL
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_id'])) {
    $PlayerID = $_POST['update_id'];
    $matches = $_POST['matches'];
    $battinginnings = $_POST['battinginnings'];
    $bowlinginnings = $_POST['bowlinginnings'];
    $runs = $_POST['runs'];
    $strikeRate = $_POST['strikeRate'];
    $highestScore = $_POST['highestScore'];
    $halfCenturies = $_POST['halfCenturies'];
    $centuries = $_POST['centuries'];
    $average = $_POST['average'];
    $economy = $_POST['economy'];
    $bestbowling = $_POST['bestbowling'];
    $wickets = $_POST['wickets'];
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

    $sql = "UPDATE $Table SET
        `Total Matches` = '$matches',
        `Batting Innings` = '$battinginnings',
        `Bowlings Innings` = '$bowlinginnings',
        `Run Scored` = '$runs',
        `Highest Score` = '$highestScore',
        `Half Centuries` = '$halfCenturies',
        `Centuries` = '$centuries',
        `Strike Rate` = '$strikeRate',
        `Batting Average` = '$average',
        `Bowling Economy` = '$economy',
        `Best Bowlings` = '$bestbowling',
        `Wickets Taken` = '$wickets'
        WHERE `Player ID` = '$PlayerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch data for update form
$data = [];
if (isset($_GET['update_id']) && isset($_GET['format'])) {
    $update_id = $_GET['update_id'];
    $format = $_GET['format'];

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

    $sql = "SELECT * FROM $Table WHERE `Player ID` = '$update_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }
}

// Fetch all records for display
$format = $_GET['format'] ?? 't20i'; // Default to 't20i' if format not set
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

// Fetch player names and statistics
$sql = "SELECT
    s.`Player ID`,
    p.`Player Name`
FROM
    $Table s
JOIN players p ON
    s.`Player ID` = p.`ID` ORDER BY p.ID ASC";
$records = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        header {
            max-width: 1200px;
            margin: 100px auto;
            position: relative;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            color: blue;
            font-weight: 600;
            font-size: 1.8rem;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        table, th, td {
            border: none;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #f7f7f7;
            font-weight: bold;
            color: blue;
        }

        td {
            background-color: #fff;
        }

        .button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            color: white;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button-delete {
            background-color: #e74c3c;
        }

        .button-delete:hover {
            background-color: #c0392b;
        }

        .button-update {
            background-color: #3498db;
        }

        .button-update:hover {
            background-color: #2980b9;
        }

        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            th, td {
                display: block;
                text-align: right;
            }
            th {
                display: none;
            }
            td {
                position: relative;
                padding-left: 50%;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding: 5px;
                font-weight: bold;
                background: #f4f4f4;
                border-right: 1px solid #ddd;
                text-align: left;
            }
        }

        h2 {
            text-align: center;
            font-size: 1.75rem;
            margin: 0;
            padding: 20px;
            color: blue;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: -20px;
        }

        /* Toast Notification Styles */
        .toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .toast #img {
            height: 30px;
            width: 30px;
            text-align: center;
            line-height: 30px;
            border-radius: 50%;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .toast #desc {
            display: inline-block;
            vertical-align: middle;
            line-height: 30px;
        }

        .toast.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadein {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @-webkit-keyframes fadeout {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        @keyframes fadeout {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Statistics Management</h1>
    </header>
    <div class="container">
        <h2>All Records</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Player Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($records->num_rows > 0): ?>
                    <?php while ($row = $records->fetch_assoc()): ?>
                        <tr>
                            <td data-label="ID"><?php echo htmlspecialchars($row['Player ID']); ?></td>
                            <td data-label="Player Name"><?php echo htmlspecialchars($row['Player Name']); ?></td>
                            <td data-label="Actions">
                                <form action="" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($row['Player ID']); ?>">
                                    <input type="hidden" name="format" value="<?php echo htmlspecialchars($format); ?>">
                                    <button type="submit" class="button button-delete">Delete</button>
                                </form>
                                <a href="Update Players/Statistics.php?update_id=<?php echo htmlspecialchars($row['Player ID']); ?>&format=<?php echo htmlspecialchars($format); ?>" class="button button-update">Update</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No records found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Toast Notification -->
    <div id="toast" class="toast">
        <div id="img">✔</div>
        <div id="desc">Deleted successfully</div>
    </div>
    
    <script>
        // Function to show toast
        function showToastAndRedirect() {
            var toast = document.getElementById("toast");
            toast.className = "toast show";
            setTimeout(function() {
                toast.className = toast.className.replace("show", "");
                // Redirect after toast hides
                window.location.href = "<?php echo $_SESSION['redirect']; ?>";
                <?php unset($_SESSION['redirect']); // Unset session variable ?>
            }, 3000); // Show toast for 3 seconds
        }

        // Check if session variable is set and show toast
        <?php if (isset($_SESSION['delete_success']) && $_SESSION['delete_success']): ?>
            <?php unset($_SESSION['delete_success']); // Unset session variable after displaying the toast ?>
            showToastAndRedirect();
        <?php endif; ?>
    </script>
</body>
</html>
