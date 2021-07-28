<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartur Registrasi</title>
    <style>
        body{
            width: 0 auto;
        }
        table.header{
            width: 100%;
            text-align: center;
        }
        .left{
            width: 50%;
            float: left;
        }
        .right{
            width: 50%;
            float: right;
            text-align: right;
        }
        .right img{
            margin-right: 10px;
            margin-top: 20px;
        }
        table.isi{
            padding: 10px;
            width: 100%;
        }
        table.isi td{
            padding: 10px;
        }
    </style>
</head>
<body>
    <div>
        <table class="header">
            <tr>
                <td>
                    <img src="{{ asset('img/logo_gorut.jpg') }}" alt="logo kabupaten" style="width: 100px">
                </td>
                <td>
                    <h3>KARTU REGISTRASI</h3>
                    <h3>PEREKRUTAN GTK NON PNS</h3>
                    <p><strong>DINAS PENDIDIKAN KABUPATEN GORONTALO UTARA</strong></p>
                </td>
            </tr>
        </table>
        <hr>
        <div class="left">
            <table class="isi">
            <tr>
                <td>NOMOR REG</td>
                <td>: {{ $formation->id }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $formation->candidate->candidateProfile ? $formation->candidate->candidateProfile->nik : '' }}</td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td>: {{ $formation->candidate->candidateProfile ? $formation->candidate->candidateProfile->title_ahead . " " . $formation->candidate->candidateProfile->full_name . " " . $formation->candidate->candidateProfile->back_title : '' }} </td>
            </tr>
            <tr>
                <td>TTL</td>
                <td>: {{ $formation->candidate->candidateProfile ? $formation->candidate->candidateProfile->place_of_birth.', '.$formation->candidate->candidateProfile->date_of_birth : '' }}</td>
            </tr>
            <tr>
                <td>JK</td>
                <td>: {{ $formation->candidate->candidateProfile->jenis_kelamin ? 'Pria' : 'Wanita' }}</td>
            </tr>
        </table>
        </div>
        <div class="right">
            @if ($formation->candidate->avatar != '' && file_exists(public_path().$formation->candidate->avatar))
             <img src="{{ asset($formation->candidate->avatar) }}" alt="" style="width: 100px">   
            @else
            <img src="{{ asset('img/logo_gorut.jpg') }}" alt="logo kabupaten" style="width: 100px">
             @endif
        </div>
        <div style="clear: both; padding-right:10px;">
            <p style="text-align: left;">
                Selamat anda telah mendaftar pada {{ $formation->formation_needs->institute->name }} sebagai {{ $formation->formation_needs->position->name }}.
                Silahkan pantau pengumuman kelulusan pada halaman dashboard <a href="https://sipenas.id">SIPENAS.ID</a>
            </p>
        </div>
    </div>
</body>
</html>