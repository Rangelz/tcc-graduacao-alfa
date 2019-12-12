<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./public/dist/css/bootstrap.min.css">
    <style>
        .panel-heading {
            padding: 10px 20px;
            border-bottom: 1px solid transparent;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
        }

        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }
    </style>
</head>

<body style="background-color: gray">
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel panel-heading">Sistema</div>
                    <div class="panel panel-body">
                        <p>
                            <img src="./public/img/fundo.jpg" width="100%">
                        </p>
                        <form method="post" action="./src/Handler/LoginHandler.php">
                            <label>Login</label>
                            <input type="text" class="form-control input-sm" name="login">
                            <label>Senha</label>
                            <input type="password" name="senha" class="form-control input-sm">
                            <p></p>
                            <button class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>

</html>
<script src="./public/dist/js/jquery-3.4.1.min.js"></script>
<script src="./public/dist/js/bootstrap.min.js"></script>
