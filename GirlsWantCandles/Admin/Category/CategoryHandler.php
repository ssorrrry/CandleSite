<?php
    include '../ConnectionRoot.php';

    $category = [];

    if(isset($_POST['action']))
    {
        if($_POST['action'] == 'update')
        {
            $querySelect = "SELECT * FROM category WHERE id = '{$_POST['id']}'";
            $resultSelect = mysqli_query($db, $querySelect);
            $row = mysqli_fetch_assoc($resultSelect);
            $old_name = $row['name'];

            $queryCheck = "SELECT * FROM category WHERE name = '{$_POST['name']}'";
            $resultCheck = mysqli_query($db, $queryCheck);

            if(mysqli_num_rows($resultCheck) == 0)
            {
                $queryUpdate = "UPDATE category SET name = '{$_POST['name']}' WHERE id = '{$_POST['id']}'";
                $resultUpdate = mysqli_query($db, $queryUpdate);

                if($resultUpdate){
                    $category['update'] = [
                        'id' => $_POST['id'],
                        'old_name' => $old_name,
                        'new_name' => $_POST['name'],
                        'message' => 'Запись обновлена'
                    ];
                }
                else{
                    $category['update'] = [
                        'id' => $_POST['id'],
                        'old_name' => $old_name,
                        'new_name' => $_POST['name'],
                        'message' => 'Ошибка'
                    ];
                }
            }
            else{
                $category['update'] = [
                    'id' => $_POST['id'],
                    'old_name' => $old_name,
                    'new_name' => $_POST['name'],
                    'message' => 'Запись с таким именем уже существует'
                ];
            }
        }
        else if($_POST['action'] == 'delete')
        {   
            $querySelect = "SELECT * FROM category WHERE id = '{$_POST['id']}'";
            $resultSelect = mysqli_query($db, $querySelect);
            $row = mysqli_fetch_assoc($resultSelect);
            $name = $row['name'];

            $queryDelete = "DELETE FROM category WHERE id = '{$_POST['id']}'";
            $resultDelete = mysqli_query($db, $queryDelete);

            if($resultDelete)
            {
                $category['delete'] = [
                    'id' => $_POST['id'],
                    'name' => $name,
                    'message' => 'Запись удалена'
                ];
            }
            else{
                $category['delete'] = [
                    'id' => $_POST['id'],
                    'name' => $name,
                    'message' => 'Ошибка'
                ];
            }
        }
        else if($_POST['action'] == 'create')
        {
            $queryCheck = "SELECT * FROM category WHERE name = '{$_POST['name']}'";
            $resultCheck = mysqli_query($db, $queryCheck);

            if(mysqli_num_rows($resultCheck) == 0)
            {
                $queryCreate = "INSERT INTO category (`id`, `name`) VALUES (NULL, '{$_POST['name']}');";
                $resultCreate = mysqli_query($db, $queryCreate);

                if($resultCreate){
                    $category['create'] = [
                        'id' => mysqli_insert_id($db),
                        'name' => $_POST['name'],
                        'message' => 'Запись добавлена'
                    ];
                }
                else{
                    $category['create'] = [
                        'id' => mysqli_insert_id($db),
                        'name' => $_POST['name'],
                        'message' => 'Ошибка'
                    ];
                }
            }
            else{
                $category['create'] = [
                    'id' => mysqli_insert_id($db),
                    'name' => $_POST['name'],
                    'message' => 'Запись с таким именем уже существует'
                ];
            }
        }
    }

    $queryRead = "SELECT * FROM category";
    $resultRead = mysqli_query($db, $queryRead);

    if($resultRead)
    {
        $i = 0;
        while($row = mysqli_fetch_assoc($resultRead))
        {
            $i++;
            $category['read'][] = [
                'id' => $row['id'],
                'number' => $i,
                'name' => $row['name']
            ];
        }
    }

    echo json_encode($category);
?>