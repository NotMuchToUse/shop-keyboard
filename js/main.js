// Hàm filter với sort, search
function applyFilters() {
  const keyword = document.getElementById("searchInput").value.trim();
  const sort = document.getElementById("sortSelect").value;
  const checkedBoxes = document.querySelectorAll(".filter-checkbox:checked");

  const filterValues = Array.from(checkedBoxes).map(
    (checkbox) => checkbox.value,
  );

  const urlParams = new URLSearchParams();
  urlParams.set("page", "product");

  if (keyword !== "") {
    urlParams.set("keyword", keyword);
  }

  if (sort !== "") {
    urlParams.set("sort", sort);
  }

  if (filterValues.length > 0) {
    urlParams.set("filter", filterValues.join(","));
  }

  urlParams.set("p", "1");
  window.location.href = "index.php?" + urlParams.toString();
}

// Bắt sự kiện bàn phím nhấn nút Enter
function handleEnter(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    applyFilters();
  }
}
