<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>To do Php</title>
</head>
<body>
    <?php include_once 'includes/database.php'?>
    <?php include_once 'includes/Navbar.php' ?>

    <div class="container mx-auto">
        <section>
            <?php
                $title = "";
                
                if(isset($_POST['add'])){
                    $title = htmlspecialchars($_POST['title']);

                    if(!empty($title)){
                        $result = $pdo->prepare('INSERT INTO tasks VALUES(null,?)');
                        $objectResult = $result->execute([$title]);
                    }
                    else{
                        $error = "";
                        $error = "Please fill your Field !";
                    }
                }
            ?>
            <form action="" method="post" class="px-8 py-24">
                <div class="flex flex-col gap-5">
                    <label for="title" class="font-semibold text-xl">Title <span class="text-red-500">*</span></label>
                    <div class="flex gap-5">
                        <input type="text" id="title" name="title" class="border border-black rounded-xl outline-none flex-1 p-5">
                        <button class="bg-black font-bold rounded-xl text-white px-8" name="add">
                            Send
                        </button>
                    </div>
                </div>
                <?php
                    if(!empty($error)){
                        ?>
                            <p class="my-5 text-red-500 font-bold">
                                <?= $error ?>
                            </p>
                        <?php
                    }
                ?>
            </form>
        </section>

        <section class="px-8">
            <div class="relative overflow-x-auto">
                <?php
                    $sqlState = $pdo->query('SELECT * FROM todo.tasks');
                    $Tasks = $sqlState->fetchAll(PDO::FETCH_OBJ);
                ?>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Task
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($Tasks as $key => $item){
                                ?>
                                    <tr class="bg-white border-b text-black">
                                        <th scope="row" class="px-6 py-4 font-medium">
                                            <?= $item->id ?>
                                        </th>
                                        <td class="px-6 py-4 w-full">
                                            <?= $item->title ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form method="post" class="flex gap-5">
                                                <input type="hidden" name="id" value="<?php echo $item->id ?>">
                                                <input formaction="Update.php" type="submit" name="update" value='&#10000;' class="cursor-pointer">
                                                <input formaction="Delete.php" type="submit" name="delete" value='&#10008;' class="cursor-pointer">
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>