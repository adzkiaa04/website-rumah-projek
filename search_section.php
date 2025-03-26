<!-- File: search_section.php -->
<section id="search" class="d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2>Temukan Rumah yang kamu inginkan</h2>
        <p>
          sekarang anda dapat menghemat waktu dan biaya dengan memilih
          ratusan rumah dengan harga yang terjangkau
        </p>
      </div>
      <div class="col-10 mx-auto mt-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button
              class="nav-link active"
              id="home-tab"
              data-bs-toggle="tab"
              data-bs-target="#jual"
              type="button"
              role="tab"
              aria-controls="home"
              aria-selected="true"
            >
              Jual
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="profile-tab"
              data-bs-toggle="tab"
              data-bs-target="#sewa"
              type="button"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
            >
              Sewa
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button
              class="nav-link"
              id="contact-tab"
              data-bs-toggle="tab"
              data-bs-target="#propertybaru"
              type="button"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
            >
              Property Baru
            </button>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="jual"
            role="tabpanel"
            aria-labelledby="home-tabe"
          >
            <!-- Dropdown Tipe Rumah -->
            <div class="input-group input-cari mb-3">
              <button
                class="button-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img src="Assets/img/Home Icon.png" alt="" />
                Tipe Rumah
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li>
                  <a class="dropdown-item" href="#">Another action</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Separated link</a>
                </li>
              </ul>
              <!-- Dropdown Range Harga -->
              <button
                class="button-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img src="Assets/img/Money-icon.png" alt="" />
                Range Harga
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li>
                  <a class="dropdown-item" href="#">Another action</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Separated link</a>
                </li>
              </ul>

              <input
                type="text"
                class="form-control"
                aria-label="Text input with dropdown button"
                placeholder="cari berdasarkan lokasi, ID, Property"
              />
              <button
                class="button-primary"
                type="button"
                id="button-addon2"
              >
                Cari
              </button>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="sewa"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
            <div class="input-group input-cari mb-3">
              <button
                class="button-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img src="Assets/img/Home Icon.png" alt="" />
                Tipe Rumah
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li>
                  <a class="dropdown-item" href="#">Another action</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Separated link</a>
                </li>
              </ul>
              <!-- Dropdown Range Harga -->
              <button
                class="button-secondary dropdown-toggle"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img src="Assets/img/Money-icon.png" alt="" />
                Range Harga
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li>
                  <a class="dropdown-item" href="#">Another action</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Something else here</a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="#">Separated link</a>
                </li>
              </ul>

              <form action="search.php" method="GET">
    <div class="input-group input-cari mb-3">
        <button
            class="button-secondary dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <img src="Assets/img/Home Icon.png" alt="" />
            Tipe Rumah
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>

        <button
            class="button-secondary dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <img src="Assets/img/Money-icon.png" alt="" />
            Range Harga
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>

        <input
            type="text"
            name="search" <!-- Tambahkan name untuk input -->
            class="form-control"
            aria-label="Text input with dropdown button"
            placeholder="cari berdasarkan lokasi, ID, Property"
        />
        <button
            class="button-primary"
            type="submit" <!-- Ganti type menjadi submit -->
            id="button-addon2"
        >
            Cari
        </button>
    </div>
</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>