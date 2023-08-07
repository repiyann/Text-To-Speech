<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Text-To-Speech </title>

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

    <!-- My Style -->
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .card {
            margin-top: 100px;
        }

        .btn {
            color: #fff;
            background-color: #16a085;
            margin-top: 0.3rem;
            padding: 0.2rem;
            border-radius: 0.5rem;
        }

        .btn:hover {
            background-color: #0c5a4a;
            color: #fff;
        }

        p.msg {
            background-color: rgba(255, 0, 0, 0.5);
            color: #fff;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color:#16a085">
        <div class="d-flex justify-content-center align-items-center container">
            <h1> Text-To-Speech </h1>
        </div>
    </nav>

    <div class="d-flex justify-content-center align-items-center container">
        <div class="card py-3 px-3 w-50">
            <h5 class="fw-bold text-center"> Input Text-To-Speech </h5>
            <form method="post">
                <div class="form-floating my-3">
                    <textarea class="form-control" id="floatingTextarea" required name="txt" style="height: 200px" oninput="this.value = this.value.replace(/\n/g, '')"><?php if (isset($_POST['txt'])) { echo htmlentities($_POST['txt']); } ?></textarea>
                    <label for="floatingTextarea"> Masukkan Teks </label>
                </div>
                <div class="form-floating my-4">
                    <select class="form-select" name="bahasa" id="floatingSelect" aria-label="Floating label select example">
                        <option value="" disabled selected> Pilihan Bahasa </option>
                        <option value="id-id"> Indonesia </option>
                        <option value="en-us"> Inggris </option>
                    </select>
                    <label for="floatingSelect"> Pilih Bahasa </label>
                </div>
                <div class="text-center">
                    <input name="submit" type="submit" class="btn p-2" value="Convert to Speech" />
                </div>
                <?php
                if (isset($_POST['submit'])) {
                    $txt = $_POST['txt'];
                    $txt = htmlspecialchars($txt);
                    $txt = rawurlencode($txt);
                    if (isset($_POST['bahasa'])) {
                        $selected = $_POST['bahasa'];
                        $audio = file_get_contents('http://api.voicerss.org/?key=39ff74059fb14b0396fc3e47c37e4bcf&hl=' . $selected . '&f=16khz_16bit_mono&src=' . $txt);
                        $speech = "<audio controls='controls'><source src='data:audio/mp3;base64," . base64_encode($audio) . "'></audio>";
                ?>
                        <hr class="mt-4">
                        <div class="text-center">
                            <h5 class="fw-bold text-center"> Output Speech </h5>
                            <?= $speech; ?>
                        </div>
                        <hr>
                    <?php
                    } else {
                    ?>
                        <p class="text-center msg rounded-2 mt-3 p-1"> Pilih Bahasa yang Tersedia </p>
                <?php
                    }
                }
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>