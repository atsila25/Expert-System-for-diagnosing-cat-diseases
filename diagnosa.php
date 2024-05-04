<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Diagnose Cat Disease</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body id="page-top" class="landing-page no-skin-config">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <a class="navbar-brand">Welcome!</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="#page-top">Cat Disease Diagnose With Expert System</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>We help<br />
                            cat owners<br />
                            to indentify<br />
                            their cat disease</h1>
                    </div>
                    <div class="carousel-image wow zoomIn">
                        <img src="img/cat.png" alt="cat" />
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back">
                    <img src="img/header_one.jpg" />
                </div>
            </div>
        </div>
    </div>
    <?php
    include "function.php";
    // Proses input form jika ada
    if (isset($_POST['diagnosa'])) {
        if (isset($_POST['gejala'])) {
            $gejala_terpilih = $_POST['gejala'];
            $hasil_diagnosa = forwardChaining($gejala_terpilih, $conn);
        } else {
            // Jika tidak ada gejala yang dipilih, kembalikan pesan error atau lakukan tindakan lain
    ?>
            <div class="alert alert-danger d-flex align-items-center d-grid gap-2 col-6 mx-auto mt-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    Tidak ada gejala yang anda pilih
                </div>
            </div>
    <?php
            header("refresh:3;url=diagnosa.php");
        }
    }
    ?>
    <section id="features" class="wrapper services">
        <div class="wrapper wrapper-content">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-lg-8">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h3 class="card-header bg-primary d-flex 
                                            justify-content-center text-light">DIAGNOSA PENYAKIT KUCING</h3>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-8">
                                        </div>
                                        <div class="card-body">
                                            <table>
                                                <thead>
                                                    <th scope="col">SILAHKAN CHECKLIST GEJALA-GEJALA DIBAWAH INI</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($gejala as $g) : ?>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="gejala[]" value="<?= $g['id'] ?>" id="<?= $g['id'] ?>">
                                                                    <label class="form-check-label" for="<?= $g['id'] ?>">
                                                                        <?= $g['nama'] ?>
                                                                    </label>
                                                                </div>
                                                                <?php $i++; ?>
                                                            <?php endforeach; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <button type="submit" name="diagnosa" class="btn btn-primary">Diagnosa</button>
                                            <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- linebreak -->
                        <br><br><br><br><br><br>
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h3 class="card-header bg-secondary
                                            justify-content ">HASIL ANALISA PENYAKIT</h3>
                            </div>
                            <table>
                                <?php if (isset($hasil_diagnosa)) : ?>
                                    <?php if (count($hasil_diagnosa) > 0) : ?>
                                        <?php foreach ($hasil_diagnosa as $penyakit) : ?>
                                            <tbody>
                                                <tr>
                                                    <td>Penyakit:</td>
                                                    <td>
                                                        <strong>
                                                            <?= $penyakit['nama'] ?>
                                                        </strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><br></td>
                                                </tr>
                                                <tr>
                                                    <td>Solusi:</td>
                                                    <td>
                                                        <?= $penyakit['solusi'] ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>Tidak ada penyakit yang terdiagnosis.</p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </table>
                            <br>
                            <button class="btn btn-secondary reset-button">Reset Diagnose</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>