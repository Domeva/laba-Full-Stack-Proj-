<!DOCTYPE html>
<html lang="uk">
<head>
    <title>Введення інформації</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body style="text-align: center;">
<div class="container my-5">
    <h2>Вхід</h2>
    <form action="login.inc.php" method="POST">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="username">username</label>
            <div class="col-sm-6">
                <input type="text" name="username" placeholder="Enter username">
            </div></div><div class="row mb-3">

            <label class="col-sm-3 col-form-label" for="password">password</label>
            <div class="col-sm-6">
                <input type="text" name="password" placeholder="Enter password">
            </div>
        </div>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <input type="submit" name="submit" value="submit">
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/product_directory.php" role="button">Вийти</a>
            </div>
        </div>
    </form>
</div>

</body>
</html>
