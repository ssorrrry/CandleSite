<?php
    include '../ConnectionRoot.php';

    $products = [];

    if(isset($_POST['action']))
    {
        if($_POST['action'] == 'create')
        {
            $queryCheck = "SELECT * FROM category WHERE name = '{$_POST['name']}'";
            $resultCheck = mysqli_query($db, $queryCheck);

            if(mysqli_num_rows($resultCheck) == 0)
            {
                $queryCreate = "INSERT INTO products (`id`, `name`, `description`, `id_category`, `price`, `path_img`) VALUES (NULL, '{$_POST['name']}', '{$_POST['description']}', '{$_POST['id_category']}', '{$_POST['price']}', '{$_POST['path_img']}')";
                $resultCreate = mysqli_query($db, $queryCreate);

                if($resultCreate){
                    $products['create'] = [
                        'id' => mysqli_insert_id($db),
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'id_category' => $_POST['id_category'],
                        'price' => $_POST['price'],
                        'path_img' => $_POST['path_img'],
                        'message' => 'Запись добавлена'
                    ];
                }
                else{
                    $products['create'] = [
                        'id' => 'NULL',
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'id_category' => $_POST['id_category'],
                        'price' => $_POST['price'],
                        'path_img' => $_POST['path_img'],
                        'message' => 'Ошибка'
                    ];
                }
            }
            else{
                $products['create'] = [
                    'id' => 'NULL',
                    'name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'id_category' => $_POST['id_category'],
                    'price' => $_POST['price'],
                    'path_img' => $_POST['path_img'],
                    'message' => 'Запись с таким именем уже существует'
                ];
            }
        }
        else if($_POST['action'] == 'delete')
        {
            $querySelect = "SELECT * FROM products WHERE id = '{$_POST['id']}'";
            $resultSelect = mysqli_query($db, $querySelect);

            if($resultSelect)
            {
                $row = mysqli_fetch_assoc($resultSelect);

                $queryDelete = "DELETE FROM products WHERE id = '{$_POST['id']}'";
                $resultDelete = mysqli_query($db, $queryDelete);

                if($resultDelete)
                {
                    $products['delete'] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'id_category' => $row['id_category'],
                        'price' => $row['price'],
                        'path_img' => $row['path_img'],
                        'message' => 'Запись удалена'
                    ];
                }
                else{
                    $products['delete'] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'description' => $row['description'],
                        'id_category' => $row['id_category'],
                        'price' => $row['price'],
                        'path_img' => $row['path_img'],
                        'message' => 'Ошибка'
                    ];
                }
            }
        }
        else if($_POST['action'] == 'update')
        {
            $querySelect = "SELECT {$_POST['key']} FROM products WHERE id = '{$_POST['id']}'";
            $resultSelect = mysqli_query($db, $querySelect);

            if($resultSelect)
            {
                $row = mysqli_fetch_assoc($resultSelect);

                $queryUpdate = "UPDATE products SET {$_POST['key']} = '{$_POST['value']}' WHERE id = '{$_POST['id']}'";
                $resultUpdate = mysqli_query($db, $queryUpdate);

                if($resultUpdate)
                {
                    $products['update'] = [
                        'id' => $_POST['id'],
                        'key' => $_POST['key'],
                        'old_value' => $row[$_POST['key']],
                        'new_value' => $_POST['value'],
                        'message' => 'Запись изменена'
                    ];
                }
                else{
                    $products['update'] = [
                        'id' => $_POST['id'],
                        'key' => $_POST['key'],
                        'old_value' => $row[$_POST['key']],
                        'new_value' => $_POST['value'],
                        'message' => 'Ошибка'
                    ];
                }
            }
        }
    }

    $queryRead = "SELECT * FROM products";
    $resultRead = mysqli_query($db, $queryRead);

    if($resultRead)
    {
        while($row = mysqli_fetch_assoc($resultRead))
        {
            $products['read'][] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'id_category' => $row['id_category'],
                'price' => $row['price'],
                'path_img' => $row['path_img'],
                'availability' => $row['availability']
            ];
        } 
    }

    echo json_encode($products);
?>