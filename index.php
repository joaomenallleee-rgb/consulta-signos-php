<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Descubra o seu Signo</h4>
                </div>
                <div class="card-body">
                    <form action="show_zodiac_sign.php" method="POST">
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Consultar Signo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>