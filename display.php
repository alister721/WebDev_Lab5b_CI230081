<?php
// session_start();
include('authUser.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Display Information</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
        }

        a:visited {
            color: inherit; /* Use the default color (same as non-visited links) */
            text-decoration: none; /* Ensure no underlines or other decorations */
        }

        .update {
            color: brown;
        }

        .delete {
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Matric</th>
                <th>Name</th>
                <th>Role</th>
                <th colspan="2" style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                require('db.php');
                $i = 1;
                $id = $_SESSION['id'];
                $sqlGetDisplay = $con->prepare("SELECT * FROM `users`");
                $sqlGetDisplay->execute();
                $resultSqlGetDisplay = $sqlGetDisplay->get_result();
                while ($tableGetDisplay = $resultSqlGetDisplay->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $tableGetDisplay['matric']; ?></td>
                    <td><?php echo $tableGetDisplay['name']; ?></td>
                    <td><?php echo $tableGetDisplay['role']; ?></td>
                    <td style="text-align:center;color:brown;"><a class="update" href="update.php?id=<?php echo $tableGetDisplay['id']; ?>">Update</a></td>
                    <td style="text-align:center;">
                        <a class="delete" data-id="<?php echo $tableGetDisplay['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php
            $i++;
                }
            ?>
        </tbody>
    </table>
    <button><a href="logout.php">Logout</a></button>

    <script>
        $(document).ready(function() {
            $(".delete").on("click", function(e) {
                e.preventDefault();
                let deleteUrl = `delete.php?id=${$(this).data('id')}`;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    </script>
</body>
</html>
