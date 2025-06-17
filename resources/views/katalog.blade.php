<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Katalog Produk Minimalis Fashion Brand</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #fff;
      color: #111;
      margin: 0;
      padding: 2rem 1rem;
    }

    /* Katalog */
    h2.catalog-title {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 3rem;
      letter-spacing: 0.04em;
      color: #111;
      text-align: center;
    }

    .catalog-grid {
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 3rem;
      padding: 0 1rem;
    }

    .catalog-item {
      background-color: #fff;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      display: flex;
      flex-direction: column;
    }

    .catalog-item:hover,
    .catalog-item:focus-within {
      transform: translateY(-10px);
      box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
      outline: none;
    }

    .catalog-img-wrapper {
      width: 100%;
      aspect-ratio: 4 / 3;
      overflow: hidden;
      border-bottom: 1px solid #f0f0f0;
    }

    .catalog-img-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .catalog-item:hover .catalog-img-wrapper img {
      transform: scale(1.05);
    }

    .catalog-info {
      padding: 1.5rem 1.25rem;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .catalog-name {
      font-weight: 600;
      font-size: 1.125rem;
      color: #222;
      margin: 0;
      text-align: center;
    }
  </style>
</head>

<body>
  @include('layouts.header')

  <h2 class="catalog-title">Our Collection</h2>

  <div class="catalog-grid" role="list" aria-label="Katalog Produk Fashion Minimalis">
    <article class="catalog-item" role="listitem" tabindex="0">
      <div class="catalog-img-wrapper">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/6a3075c6-c7cd-4257-974c-67a31fff2ba7.png" alt="Foto produk fashion minimalis warna hijau dengan desain elegan" />
      </div>
      <div class="catalog-info">
        <h3 class="catalog-name">Nama Produk 1</h3>
      </div>
    </article>
    <article class="catalog-item" role="listitem" tabindex="0">
      <div class="catalog-img-wrapper">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/a155850b-3f46-46c7-801d-38bb18f6e7dd.png" alt="Foto produk fashion minimalis warna hijau tua dengan desain elegan" />
      </div>
      <div class="catalog-info">
        <h3 class="catalog-name">Nama Produk 2</h3>
      </div>
    </article>
    <article class="catalog-item" role="listitem" tabindex="0">
      <div class="catalog-img-wrapper">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/20b13b25-9faf-4d61-bc1d-cce5aa3ea916.png" alt="Foto produk fashion minimalis warna hijau klasik dengan desain elegan" />
      </div>
      <div class="catalog-info">
        <h3 class="catalog-name">Nama Produk 3</h3>
      </div>
    </article>
    <article class="catalog-item" role="listitem" tabindex="0">
      <div class="catalog-img-wrapper">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/3a83054c-5dcd-4ae8-99ea-a0344d9d606e.png" alt="Foto produk fashion minimalis warna hijau segar dengan desain elegan" />
      </div>
      <div class="catalog-info">
        <h3 class="catalog-name">Nama Produk 4</h3>
      </div>
    </article>
    <article class="catalog-item" role="listitem" tabindex="0">
      <div class="catalog-img-wrapper">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/180467f8-daf2-4222-81eb-76d762107ac7.png" alt="Foto produk fashion minimalis warna hijau tua dengan desain elegan" />
      </div>
      <div class="catalog-info">
        <h3 class="catalog-name">Nama Produk 5</h3>
      </div>
    </article>
  </div>

</body>

</html>