const searchInput = document.getElementById("searchInput");
const dataBuku = document.getElementById("dataBuku");
const loader = document.getElementById("loader");

let typingTimer;

// Fungsi memuat data dari JSON
async function loadBooks(keyword = "") {
  loader.classList.remove("d-none");
  dataBuku.innerHTML = "";

  try {
    const res = await fetch(
      `buku.json.php?cari=${encodeURIComponent(keyword)}`
    );
    const result = await res.json();

    loader.classList.add("d-none");

    if (result.data.length > 0) {
      result.data.forEach((buku) => {
        const row = `
          <tr class="fade-in">
            <td>${buku.id_buku}</td>
            <td>${buku.kategori}</td>
            <td class="text-start fw-medium">${buku.nama_buku}</td>
            <td>Rp ${buku.harga}</td>
            <td>${buku.stok}</td>
            <td>${buku.penerbit}</td>
          </tr>
        `;
        dataBuku.insertAdjacentHTML("beforeend", row);
      });
    } else {
      dataBuku.innerHTML = `
        <tr>
          <td colspan="6" class="text-muted text-center py-3">
            😕 Tidak ada buku ditemukan
          </td>
        </tr>
      `;
    }
  } catch (err) {
    console.error("Gagal memuat data:", err);
    loader.classList.add("d-none");
    dataBuku.innerHTML = `
      <tr>
        <td colspan="6" class="text-danger text-center py-3">
          ⚠️ Terjadi kesalahan saat memuat data
        </td>
      </tr>`;
  }
}

// Muat data pertama kali
loadBooks();

// Event pencarian otomatis
searchInput.addEventListener("keyup", () => {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(() => {
    loadBooks(searchInput.value.trim());
  }, 800); // jeda 0.8 detik setelah mengetik
});
