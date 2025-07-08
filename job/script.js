function selectCategory(elem) {
  // حذف کلاس 'active' از تمام دسته‌بندی‌ها
  document.querySelectorAll('.categorySec').forEach(cat => {
    cat.classList.remove('active');
  });

  // اضافه کردن کلاس 'active' به دسته‌بندی انتخاب شده
  elem.classList.add('activeSec');

  // دریافت دسته‌بندی بر اساس data-id
  const categoryIdsec = elem.getAttribute('data-id');

  // فیلتر کردن آگهی‌ها بر اساس دسته‌بندی انتخابی
  filterJobs(categoryIdsec);
}

function filterJobs(categoryIdsec) {
  const jobCardssec = document.querySelectorAll('.job-card');

  if (categoryIdsec === "همه") {
    // نمایش تمام آگهی‌ها
    jobCardssec.forEach(card => {
      card.style.opacity = "0";
      card.style.display = "block";
      setTimeout(() => {
        card.style.opacity = "1";
      }, 0);
    });
  } else {
    // فیلتر کردن آگهی‌ها بر اساس دسته‌بندی
    jobCardssec.forEach(card => {
      if (card.dataset.category == categoryIdsec) {
        // آگهی‌هایی که با دسته‌بندی مطابقت دارند نمایش داده می‌شوند
        card.style.opacity = "0";
        card.style.display = "block";
        setTimeout(() => {
          card.style.opacity = "1";
        }, 0);
      } else {
        // آگهی‌هایی که با دسته‌بندی مطابقت ندارند پنهان می‌شوند
        card.style.opacity = "0";
        setTimeout(() => {
          card.style.display = "none";
        }, 0);
      }
    });
  }
}
