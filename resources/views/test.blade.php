<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

</head>

<body>
    <form method="POST">
        <select id="provinsi" name="provinsi">
            <option value="ACEH">ACEH</option>
            <option value="RIAU">RIAU</option>
            <option value="JAMBI">JAMBI</option>
            <option value="SUMATERA UTARA">SUMATERA UTARA</option>
            <option value="BENGKULU">BENGKULU</option>
            <option value="LAMPUNG">LAMPUNG</option>
            <option value="DKI JAKARTA">DKI JAKARTA</option>
            <option value="JAWA BARAT">JAWA BARAT</option>
            <option value="JAWA TENGAH">JAWA TENGAH</option>
            <option value="JAWA TIMUR">JAWA TIMUR</option>
        </select>
    </form>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#provinsi').select2();
        });
    </script>

</body>

</html>