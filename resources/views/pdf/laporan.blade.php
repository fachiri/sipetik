<!DOCTYPE html>
<html>
<head>
    <style>
      @page {
        /* margin-top: 3cm; */
        /* margin-bottom: 3cm; */
        /* margin-left: 100px;
        margin-right: 100px; */
      }
      body {
          line-height: 1.5;
      }
      .header {
          text-align: center;
          margin-bottom: 2px;
          border-bottom: 4px solid black;
          padding-bottom: 10px;
      }
      .logo {
          float: left;
          width: 100px;
          height: 100px;
      }

      .logo img {
          width: 100%;
          height: auto;
      }
      .header-text {
        font-weight: bold;
        font-size: 14pt;
        margin: 0;
        padding: 0;
      }
      .header-address-text {
        font-size: 10pt;
        font-style: italic;
        margin: 0;
        padding: 0;
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid #363636;
      }
      .content {
        font-size: 10pt;
      }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('assets/ung.png') }}" alt="Logo">
        </div>
        <div>
            <p class="header-text" style="font-size: 12pt;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</p>
            <p class="header-text">UNIVERSITAS NEGERI GORONTALO</p>
            <p class="header-text">UPT TEKNOLOGI INFORMASI DAN KOMUNIKASI</p>
            <p class="header-address-text">Kampus Jambura: Jl. Jend. Sudirman No. 6 Kota Gorontalo Telp. (0435) 821125-821752 <br> Fax(0435)821752,Email: pustikom@ung.ac.id</p>
        </div>
    </div>
    <div style="margin-bottom: 20px; border-bottom: 1px solid black;"></div>
    <table class="content">
      <thead>
          <tr>
              <th>No.</th>
              <th>ID Laporan</th>
              <th>Jenis</th>
              <th>Kategori</th>
              <th>Judul</th>
              <th>Isi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($reports as $report)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $report->report_id }}</td>
                  <td>{{ $report->jenis }}</td>
                  <td>{{ $report->kategori }}</td>
                  <td>{{ $report->judul }}</td>
                  <td>{{ $report->isi }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
</body>
</html>
