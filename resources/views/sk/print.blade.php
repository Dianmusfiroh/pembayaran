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
    @foreach ($prints as $kec => $p)
        @foreach ($p['jenjangs'] as $jenjang => $data)
            <table style="font-weight: bold;">
                <tr><td>LAMPIRAN</td><td>: {{ $p['lampiran'] }}</td></tr>
                <tr><td>NOMOR</td><td>: {{ $p['nomor'] }}</td></tr>
                <tr><td>TANGGAL</td><td>: {{ $p['tanggal'] }}	</td></tr>
                <tr><td>TENTANG</td><td>: {{ $p['tentang'] }}</td></tr>
                <tr><td>SUMBER DANA</td><td>: {{ $p['sumber_dana'] }} </td></tr>
                <tr><td>KECAMATAN</td><td>	: {{ $kec }}	</td></tr>
                <tr><td>JENJANG	</td><td>: {{ $jenjang }} </td></tr>
            </table>
            <table border="1" cellspacing="0" cellpadding="2" style="font-size: 8pt;">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>NIK</th>
                        <th>NUPTK</th>
                        <th>JK</th>
                        <th>TTL</th>
                        <th>INSTANSI</th>
                        <th>Jenjang</th>
                        <th>Jabatan</th>
                        <th>TMT Awal</th>
                        <th>Kualifikasi</th>
                        {{-- <th>Kategori</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($p['jenjangs'][$jenjang] as $key => $val)
                        <tr>
                            <td>{{ ($key+1) }}</td>
                            <td>{{ $val['nama'] }}</td>
                            <td>{{ $val['nik'] }}</td>
                            <td>{{ $val['nuptk'] }}</td>
                            <td>{{ $val['jenis_kelamin'] }}</td>
                            <td>{{ $val['ttl'] }}</td>
                            <td>{{ $val['instansi'] }}</td>
                            <td>{{ $val['jenjang'] }}</td>
                            <td>{{ $val['jabatan'] }}</td>
                            <td>{{ $val['tmt_awal'] }}</td>
                            <td>{{ $val['pendidikan_terakhir'] }}</td>
                            {{-- <td>{{ $val['kategori'] }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="width: 60%; float:left; margin-top:10px;">
            <br>
            {{-- <table class="tableizer-table" style="font-size: 9pt;" align="center" border="1" cellpadding="2" cellspacing="0">
            <thead>
                <tr class="tableizer-firstrow">
                    <th style="width: 16%;">Kadis Pendidikan</th>
                    <th style="width: 16%;">Kepala BKPP</th>
                    <th style="width: 16%;">Kabag Hukum</th>
                    <th style="width: 16%;">Asisten I</th>
                    <th style="width: 16%;">Sekda</th>
                    <th style="width: 16%;">Wagub</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><br><br><br></td>
                    <td><br><br><br></td>
                    <td><br><br><br></td>
                    <td><br><br><br></td>
                    <td><br><br><br></td>
                    <td><br><br><br></td>
                </tr>
            </table>
        </div> --}}
        <div style="float:right; text-center;">
            <p><strong>BUPATI GORONTALO UTARA</strong></p>
            <br>
            <br>
            <br>
            <strong>INDRA YASIN</strong>
        </div>
        <div class="page_break"></div>
        @endforeach
    @endforeach
@endif
