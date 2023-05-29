<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <?php include_once 'includes/database.php'?>
    <?php include_once 'includes/Navbar.php' ?>

    <?php
        if(!isset($_POST['id'])){
            header('location:index.php');
        }

        $id = $_POST['id'];
        $sqlState = $pdo->prepare('SELECT * FROM tasks WHERE id=?');
        $sqlState->execute([$id]);
        $item = $sqlState->fetch(PDO::FETCH_OBJ);

        if(isset($_POST['updating'])){
            $title = $_POST['title'];
            $id = $_POST['id'];

            if(!empty($id) && !empty($title)){
                $sqlState = $pdo->prepare('UPDATE tasks SET title=? WHERE id=?');
                $result = $sqlState->execute([$title, $id]);
                if($result == true){
                    header('location:index.php');
                }
            }else{
                $error = "";
                $error = "Please fill your Field !";
            }
        }
    ?>

    <div class="container mx-auto">
            <section>
                <form method="post" class="px-8 py-24">
                    <input type="hidden" name="id" value="<?= $item->id ?>">
                    <div class="flex flex-col gap-5">
                        <label for="title" class="font-semibold text-xl">Update the Task <span class="text-red-500">*</span></label>
                        <div class="flex gap-5">
                            <input type="text" id="title" value="<?= $item->title ?>" name="title" class="border border-black rounded-xl outline-none flex-1 p-5">
                            <button class="bg-black font-bold rounded-xl text-white px-8" name="updating">
                                Update
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
    </div>
</body>
</html>