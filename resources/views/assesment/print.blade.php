<style>
    table{
        width: 100%;
    }
 body{
     font-size:11pt;
 }
 .page_break { page-break-before: always; }
</style>
@if (!empty($prints))
 <table style="font-weight: bold;">
                <tr><td>LAMPIRAN</td><td>: -</td></tr>
                <tr><td>NOMOR</td><td>: </td></tr>
                <tr><td>TANGGAL</td><td>: {{ date('Y-m-d') }}	</td></tr>
                <tr><td>TENTANG</td><td>: DAFTAR PESERTA LULUS TAHAP I (BERKAS)</td></tr>																							
            </table>
    <table border="1" cellspacing="0" cellpadding="2" style="font-size: 8pt;">
        <thead>
            <tr>
                <th>No</th>
                <th>NOPES</th>
                <th>NIK</th>
                <th>NAMA</th>
                <th>NPSN</th>
                <th>NAMA SEKOLAH</th>
                <th>JENJANG</th>
                <th>JABATAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prints as $key => $val)
                <tr>
                    <td>{{ ($key+1) }}</td>
                    <td>{{ $val->id }}</td>
                    <td>{{ $val->nik }}</td>
                    <td>{{ $val->full_name }}</td>
                    <td>{{ $val->npsn }}</td>
                    <td>{{ $val->instansi }}</td>
                    <td>{{ strtoupper($val->jenjang) }}</td>
                    <td>{{ $val->jabatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif