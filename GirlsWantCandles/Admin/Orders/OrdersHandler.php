<?php
    include '../ConnectionRoot.php';

    $orders = [];

    if(isset($_POST['action']))
    {  
        if($_POST['action'] == 'update')
        {
            $querySelect = "SELECT {$_POST['key']} FROM orders WHERE id = '{$_POST['id']}'";
            $resultSelect = mysqli_query($db, $querySelect);

            if($resultSelect)
            {
                $row = mysqli_fetch_assoc($resultSelect);

                $queryUpdate = "UPDATE orders SET {$_POST['key']} = '{$_POST['value']}' WHERE id = '{$_POST['id']}'";
                $resultUpdate = mysqli_query($db, $queryUpdate);

                if($resultUpdate)
                {
                    $orders['update'] = [
                        'id' => $_POST['id'],
                        'key' => $_POST['key'],
                        'old_value' => $row[$_POST['key']],
                        'new_value' => $_POST['value'],
                        'message' => 'Запись изменена'
                    ];
                }
                else{
                    $orders['update'] = [
                        'id' => $_POST['id'],
                        'key' => $_POST['key'],
                        'old_value' => $row[$_POST['key']],
                        'new_value' => $_POST['value'],
                        'message' => 'Ошибка'
                    ];
                }
            }
        }
        else if($_POST['action'] == 'delete')
        {
            $querySelect = "SELECT * FROM orders WHERE id = '{$_POST['id']}'";
            $resultSelect = mysqli_query($db, $querySelect);

            if($resultSelect)
            {
                $row = mysqli_fetch_assoc($resultSelect);

                $queryDelete = "DELETE FROM orders WHERE id = '{$_POST['id']}'";
                $resultDelete = mysqli_query($db, $queryDelete);

                if($resultDelete)
                {
                    $orders['delete'] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'telephone' => $row['telephone'],
                        'address' => $row['address'],
                        'id_product' => $row['id_product'],
                        'quantity' => $row['quantity'],
                        'date' => $row['date'],
                        'sost' => $row['sost'],
                        'message' => 'Запись удалена'
                    ];
                }
                else{
                    $orders['delete'] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'telephone' => $row['telephone'],
                        'address' => $row['address'],
                        'id_product' => $row['id_product'],
                        'quantity' => $row['quantity'],
                        'date' => $row['date'],
                        'sost' => $row['sost'],
                        'message' => 'Ошибка'
                    ];
                }
            }
        }

    }

    $queryRead = "SELECT * FROM orders";
    $resulrRead =  mysqli_query($db, $queryRead);

    if($resulrRead)
    {
        while($row = mysqli_fetch_assoc($resulrRead))
        {
            $orders['read'][]=[
                'id' => $row['id'],
                'name' => $row['name'],
                'telephone' => $row['telephone'],
                'address' => $row['address'],
                'id_product' => $row['id_product'],
                'quantity' => $row['quantity'],
                'date' => $row['date'],
                'sost' => $row['sost']
            ];
        }
    }

    echo json_encode($orders);
?>