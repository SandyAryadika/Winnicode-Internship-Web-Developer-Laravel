<div class="news-category">
    <!-- Header Kategori -->
    <div class="category-header" id="header-politik" onclick="toggleCategory('politik')">
        <span>Politik</span>
        <span class="toggle-icon" id="icon-politik">+</span>
    </div>

    <!-- Isi Kategori, default hidden -->
    <div class="category-content" id="politik">
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/berita1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <small class="text-muted">Alya R. | 08/04/2024</small>
                        <p class="card-text">Parlemen membahas anggaran untuk keperluan publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news-category">
    <!-- Header Kategori -->
    <div class="category-header" id="header-ekonomiDanBisnis" onclick="toggleCategory('ekonomiDanBisnis')">
        <span>Ekonomi & Bisnis</span>
        <span class="toggle-icon" id="icon-ekonomiDanBisnis">+</span>
    </div>

    <!-- Isi Kategori, default hidden -->
    <div class="category-content" id="ekonomiDanBisnis">
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/berita1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <small class="text-muted">Alya R. | 08/04/2024</small>
                        <p class="card-text">Parlemen membahas anggaran untuk keperluan publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news-category">
    <!-- Header Kategori -->
    <div class="category-header" id="header-olahraga" onclick="toggleCategory('olahraga')">
        <span>Olahraga</span>
        <span class="toggle-icon" id="icon-olahraga">+</span>
    </div>

    <!-- Isi Kategori, default hidden -->
    <div class="category-content" id="olahraga">
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/berita1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <small class="text-muted">Alya R. | 08/04/2024</small>
                        <p class="card-text">Parlemen membahas anggaran untuk keperluan publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news-category">
    <!-- Header Kategori -->
    <div class="category-header" id="header-hiburanDanSelebriti" onclick="toggleCategory('hiburanDanSelebriti')">
        <span>Hiburan & Selebriti</span>
        <span class="toggle-icon" id="icon-hiburanDanSelebriti">+</span>
    </div>

    <!-- Isi Kategori, default hidden -->
    <div class="category-content" id="hiburanDanSelebriti">
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/berita1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <small class="text-muted">Alya R. | 08/04/2024</small>
                        <p class="card-text">Parlemen membahas anggaran untuk keperluan publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news-category">
    <!-- Header Kategori -->
    <div class="category-header" id="header-kesehatanDanGayaHidup" onclick="toggleCategory('kesehatanDanGayaHidup')">
        <span>Kesehatan & Gaya Hidup</span>
        <span class="toggle-icon" id="icon-kesehatanDanGayaHidup">+</span>
    </div>

    <!-- Isi Kategori, default hidden -->
    <div class="category-content" id="kesehatanDanGayaHidup">
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/berita1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <small class="text-muted">Alya R. | 08/04/2024</small>
                        <p class="card-text">Parlemen membahas anggaran untuk keperluan publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news-category">
    <!-- Header Kategori -->
    <div class="category-header" id="header-teknologi" onclick="toggleCategory('teknologi')">
        <span>Teknologi</span>
        <span class="toggle-icon" id="icon-teknologi">+</span>
    </div>

    <!-- Isi Kategori, default hidden -->
    <div class="category-content" id="teknologi">
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="images/berita1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <small class="text-muted">Alya R. | 08/04/2024</small>
                        <p class="card-text">Parlemen membahas anggaran untuk keperluan publik.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script>
    function toggleCategory(categoryId) {
        const content = document.getElementById(categoryId);
        const icon = document.getElementById('icon-' + categoryId);

        if (content.style.display === "none" || content.style.display === "") {
            content.style.display = "block";
            icon.innerText = "−";
        } else {
            content.style.display = "none";
            icon.innerText = "+";
        }
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</script>