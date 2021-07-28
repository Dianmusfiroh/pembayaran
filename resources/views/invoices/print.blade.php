<style>

    #peserta td, #peserta th {
    border: 1px solid #000;
    padding: 4px;
    font-size: 10px;
    }
    #peserta th {
    text-align: left;
    }
    #header td{
        font-weight: 800;
    }
    .page_break { page-break-before: always; }
</style>
@foreach ($detail as $key => $d)
    <strong>DAFTAR PEMBAYARAN INSENTIF GURU DAN TENAGA KEPENDIDIKAN BUKAN ASN</strong><br/>
    <strong>DINAS PENDIDIKAN KABUPATEN GORONTALO UTARA</strong>
    @foreach ($d['jenjang'] as $kj => $j)
        <table id="header">
             <tr>
                    <td width="20%">KECAMATAN</td>
                    <td>: {{ $key }}</td>
                </tr>
                <tr>
                    <td>PERIODE BULAN</td>
                    <td>: {{ $d['periode'] }}</td>
                </tr>
                <tr>
                    <td>TAHAP</td>
                    <td>: {{ $d['tahap'] }}</td>
                </tr>
                <tr>
                    <td>JENJANG</td>
                    <td>: {{ $kj }}</td>
                </tr>
            </table>
            <table id="peserta" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>NUPTK</th>
                        <th>Nama Lengkap</th>
                        <th>Jenjang</th>
                        <th>Unit Kerja</th>
                        <th>No. Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Pendidikan Terakhir</th>
                        <th>Jabatan</th>
                        <th>Satuan Insentif</th>
                        <th>Kinerja</th>
                        {{-- <th>Volume</th> --}}
                        <th>Jumlah Diterima</th>
                        <th>Tanda Tangan</th>
                        {{-- <th>{{ $k+1 }}......</th> --}}

                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                        @foreach ($d['jenjang'][$kj] as $k => $item)
                            <tr>
                                <td>{{ $item['nik'] }}</td>
                                <td>{{ $item['nuptk'] }}</td>
                                <td>{{ $item['full_name'] }}</td>
                                <td>{{ $item['jenjang'] }}</td>
                                <td>{{ $item['instansi'] }}</td>
                                <td>{{ $item['no_rek'] }}</td>
                                <td>{{ $item['nama_rek'] }}</td>
                                <td>{{ $item['pendidikan_terakhir'] }}</td>
                                <td>{{ $item['jabatan'] }}</td>
                                <td style="text-align: right;">{{ $item['insentif'] }}</td>
                                <td>{{ $item['kinerja'] }}</td>
                                {{-- <td>{{ $item['volume'] }}</td> --}}
                                <td style="text-align: right;">{{ $item['jumlah_bayar'] }}</td>
                                <td>{{ $k+1 }}......</td>
                                {{-- <td></td> --}}
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="12" style="text-align: center;">
                                <strong>Jumlah</strong>
                            </td>
                            <td style="text-align: right;">{{ $d['total_bayar'] }}</td>
                            {{-- <td>{{ $k+1 }}......</td> --}}

                            {{-- <td> --}}
                        </tr>
                </tbody>
            </table>

            <table style="width: 100%; margin-top:10px;font-size:10pt;">
                <tr>
                    <td style="text-align: center;">
                        Mengetahui<br/>
                        <strong>KUASA PENGGUNA ANGGARAN</strong>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <strong>{{ $d['kpa_name'] }}</strong><br/>
                        {{ $d['kpa_eselon'] }}<br/>
                        NIP. {{ $d['kpa_nip'] }}
                    </td>
                    <td style="text-align: center;">
                         &nbsp;<br/>
                        <strong>BENDAHARA PENGELUARAN</strong>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <strong>{{ $d['bendahara_name'] }}</strong><br/>
                        NIP. {{ $d['bendahara_nip'] }}
                    </td>
                </tr>
            </table>
        <div class="page_break"></div>
    @endforeach
@endforeach
