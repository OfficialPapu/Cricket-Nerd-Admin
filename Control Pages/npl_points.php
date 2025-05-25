<?php 
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/"; 
// $base_url = $_SERVER['DOCUMENT_ROOT'] . "/The Cricket Nerd Admin/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';
@session_start();

$data = [];
$query = "SELECT * FROM `npl_points_table`";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; 
    }
} else {
    error_log("DB Error: " . mysqli_error($conn));
    $data = ["error" => "Error fetching records."];
}

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM `npl_stats_batting` WHERE `ID` = $delete_id";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Player deleted successfully'); window.location.href = 'current_page.php';</script>";
    } else {
        error_log("Delete Query Error: " . mysqli_error($conn));
        echo "<script>alert('Error deleting player');</script>";
    }
}


if (isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $Match_played = $_POST['MatchPlayed'] ?? 0;
    $Wins = $_POST['Wins'] ?? 0;
    $Lost = $_POST['Losses'] ?? 0;
    $No_result = $_POST['Nr'] ?? 0;
    $Points = $_POST['Points'] ?? 0;
    $Net_run_rate = $_POST['Nrr'] ?? 0;
    $stmt = $conn->prepare("UPDATE `npl_points_table` SET 
        `Match Played` = ?, 
        `Wins` = ?, 
        `Loss` = ?, 
        `Nr` = ?, 
        `Points` = ?, 
        `Nrr` = ? 
        WHERE `id` = ?");
    $stmt->bind_param("iiiiisi", $Match_played, $Wins, $Lost, $No_result, $Points, $Net_run_rate, $update_id);
    if ($stmt->execute()) {
        echo "<script>alert('Table updated successfully'); window.location.href = 'https://admin.thecricnerd.com/Control%20Pages/npl_points.php';</script>";
    } else {
        echo "<script>alert('Error updating player: " . $stmt->error . "');</script>";
    }
    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch and Display Data</title>
    <link rel="stylesheet" href="Assets/CSS/Quill.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .data-item {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .data-field {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        h1 {
            color: #007BFF;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            gap: 10px;
        }

        .action-buttons .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-update {
            background-color: #007BFF;
            color: white;
        }

        .btn-update:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: #f83a6f;
            color: white;
        }

        .btn-delete:hover {
            background-color: #d02c56;
            transform: scale(1.05);
        }
        #updateModal {
    display: none;
    margin: 40px;
}

#updateModal .modal-overlay {
    position: fixed;
    top: 12%; 
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

#updateModal .modal-content {
    background: #fff;
    padding: 25px;
    width: 100%;
    max-width: 400px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    overflow-y: auto; 
    max-height: 90vh; 
}

#updateModal .modal-content h3 {
    margin-bottom: 15px;
    font-size: 1.4rem;
    color: #333;
    font-weight: 600;
}

#updateModal .form-group {
    margin-bottom: 20px;
    text-align: left;
}

#updateModal .form-group label {
    font-size: 1rem;
    color: #555;
    margin-bottom: 5px;
    display: block;
}

#updateModal .form-group input {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    color: #333;
    transition: border-color 0.3s;
}

#updateModal .form-group input:focus {
    border-color: #007BFF;
    outline: none;
}

#updateModal .form-buttons {
    display: flex;
    justify-content: space-between;
}

#updateModal .btn {
    padding: 8px 15px;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

#updateModal .btn-update {
    background-color: #007BFF;
    color: white;
    width: 48%;
}

#updateModal .btn-update:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

#updateModal .btn-cancel {
    background-color: #f83a6f;
    color: white;
    width: 48%;
}

#updateModal .btn-cancel:hover {
    background-color: #d02c56;
    transform: scale(1.05);
}

@media (max-width: 600px) {
    #updateModal .modal-content {
        padding: 15px;
        width: 90%;
        max-width: none; 
    }

    #updateModal .modal-buttons {
        flex-direction: column; 
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Team Data</h1>

        <div id="dataList">
            <?php
            if (!empty($data)) {
                foreach ($data as $item) {
                    $player_id = $item['ID'];
                    echo "<div class='data-item'>";
                    foreach ($item as $key => $value) {
                        if ($key != 'id') {
                            echo "<div class='data-field'><strong>$key</strong>: $value</div>";
                        }
                    }
                    
                    echo "<div class='action-buttons'>";
                    echo "<button onclick='updatePlayer($player_id)' class='btn btn-update'>Update</button>";
                    
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No data found or error fetching data.</p>";
            }
            ?>
        </div>
    </div>

    <div id="updateModal">
        <div class="modal-overlay">
            <div class="modal-content">
                <h3>Update Player</h3>
                <form id="updateForm" method="POST">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group">
                        <label for="Match Played">Match Played</label>
                        <input type="text" id="MatchPlayed" name="MatchPlayed" >
                    </div>
                    <div class="form-group">
                        <label for="RunScored">Wins</label>
                        <input type="text" id="Wins" name="Wins" >
                    </div>
                    <div class="form-group">
                        <label for="Lost">Lost</label>
                        <input type="text" id="Lost" name="Losses" >
                    </div>
                    <div class="form-group">
                        <label for="No Result (NR) ">No Result (NR) </label>
                        <input type="text" id="Nr" name="Nr" >
                    </div>
                    <div class="form-group">
                        <label for="Points">Points</label>
                        <input type="text" id="Points" name="Points" >
                    </div>
                    <div class="form-group">
                        <label for="Net Run Rate">Net Run Rate (eg. +1.33, -2.106)</label>
                        <input type="text" id="Nrr" name="Nrr" >
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-update">Update</button>
                        <button type="button" class="btn btn-cancel" onclick="closeModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updatePlayer(playerId) {
            document.getElementById('updateModal').style.display = 'block';
            document.getElementById('update_id').value = playerId;
        }

        function closeModal() {
            document.getElementById('updateModal').style.display = 'none';
        }

        function deletePlayer(playerId) {
    if (confirm("Are you sure you want to delete this player?")) {
        console.log(playerId);
        window.location.href = `?delete_id=${playerId}`;
    }
}

        
    </script>
</body>
</html>