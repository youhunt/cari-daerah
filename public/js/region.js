document.addEventListener("DOMContentLoaded", () => {
  loadProvinsi();
});

function loadProvinsi() {
  fetch("/api/region/provinsi")
    .then((r) => r.json())
    .then((data) => {
      const select = document.getElementById("provinsi");
      data.forEach((item) => {
        select.innerHTML += `<option value="${item.id}" data-name="${item.name}">${item.name}</option>`;
      });
    });
}

document.getElementById("provinsi").addEventListener("change", function () {
  reset(["kabupaten", "kecamatan", "desa"]);

  const id = this.value;
  if (!id) return;

  setHidden(this, "province");

  fetch(`/api/region/kabupaten/${id}`)
    .then((r) => r.json())
    .then((data) => fill("kabupaten", data));
});

document.getElementById("kabupaten").addEventListener("change", function () {
  reset(["kecamatan", "desa"]);

  const id = this.value;
  if (!id) return;

  setHidden(this, "city");

  fetch(`/api/region/kecamatan/${id}`)
    .then((r) => r.json())
    .then((data) => fill("kecamatan", data));
});

document.getElementById("kecamatan").addEventListener("change", function () {
  reset(["desa"]);

  const id = this.value;
  if (!id) return;

  setHidden(this, "district");

  fetch(`/api/region/desa/${id}`)
    .then((r) => r.json())
    .then((data) => fill("desa", data, true));
});

document.getElementById("desa").addEventListener("change", function () {
  setHidden(this, "village");
});

function fill(id, data, optional = false) {
  const select = document.getElementById(id);
  select.disabled = false;
  select.innerHTML = `<option value="">-- Pilih ${select.previousElementSibling.innerText} --</option>`;

  data.forEach((item) => {
    select.innerHTML += `<option value="${item.id}" data-name="${item.name}">${item.name}</option>`;
  });
}

function reset(ids) {
  ids.forEach((id) => {
    const el = document.getElementById(id);
    el.innerHTML = '<option value="">-- Pilih --</option>';
    el.disabled = true;
  });
}

function setHidden(select, prefix) {
  const option = select.options[select.selectedIndex];

  document.getElementById(`${prefix}_code`).value = select.value;
  document.getElementById(`${prefix}_name`).value = option.dataset.name;
}
