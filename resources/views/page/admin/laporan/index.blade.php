<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Laporan Penjualan - Bootstrap</title>
  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 2rem;
    }
    .content-header {
      margin-bottom: 1.5rem;
    }
    .report-wrapper {
      background: white;
      padding: 1.5rem;
      border-radius: 0.375rem;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
    }
    .filter-row {
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    .no-data {
      text-align: center;
      font-style: italic;
      color: #888;
      padding: 1rem 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <section class="content-header">
      <h1><i class="fas fa-chart-line"></i> Laporan Penjualan</h1>
    </section>

    <section class="content">
      <div class="report-wrapper">
        <form id="filterForm" class="d-flex filter-row flex-wrap align-items-center">
          <div class="form-group flex-grow-1">
            <label for="startDate" class="form-label">Tanggal Mulai</label>
            <input type="date" id="startDate" class="form-control" />
          </div>
          <div class="form-group flex-grow-1">
            <label for="endDate" class="form-label">Tanggal Akhir</label>
            <input type="date" id="endDate" class="form-control" />
          </div>
          <div class="form-group mt-4 mt-sm-0">
            <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
          </div>
        </form>

        <table class="table table-striped table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th scope="col">Tanggal</th>
              <th scope="col">Produk</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Total Harga</th>
            </tr>
          </thead>
          <tbody id="reportTableBody">
            <tr>
              <td>2024-06-01</td>
              <td>Produk A</td>
              <td>10</td>
              <td>Rp 1.000.000</td>
            </tr>
            <tr>
              <td>2024-06-05</td>
              <td>Produk B</td>
              <td>5</td>
              <td>Rp 750.000</td>
            </tr>
            <tr>
              <td>2024-06-07</td>
              <td>Produk C</td>
              <td>8</td>
              <td>Rp 1.600.000</td>
            </tr>
            <tr>
              <td>2024-06-10</td>
              <td>Produk A</td>
              <td>3</td>
              <td>Rp 300.000</td>
            </tr>
          </tbody>
        </table>
        <p id="noDataMessage" class="no-data d-none">Tidak ada data laporan untuk tanggal yang dipilih.</p>
      </div>
    </section>
  </div>

  <!-- Bootstrap 5 JS Bundle CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const filterForm = document.getElementById('filterForm');
    const reportTableBody = document.getElementById('reportTableBody');
    const noDataMessage = document.getElementById('noDataMessage');

    filterForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const startDate = document.getElementById('startDate').value;
      const endDate = document.getElementById('endDate').value;

      if (startDate && endDate && startDate > endDate) {
        alert('Tanggal Mulai harus sebelum atau sama dengan Tanggal Akhir.');
        return;
      }

      let visibleRows = 0;
      const rows = reportTableBody.querySelectorAll('tr');

      rows.forEach(row => {
        const date = row.cells[0].textContent.trim();
        const isAfterStart = !startDate || date >= startDate;
        const isBeforeEnd = !endDate || date <= endDate;

        if (isAfterStart && isBeforeEnd) {
          row.style.display = '';
          visibleRows++;
        } else {
          row.style.display = 'none';
        }
      });

      noDataMessage.classList.toggle('d-none', visibleRows > 0);
    });
  </script>
</body>
</html>
