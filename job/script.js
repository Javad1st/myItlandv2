function selectCategory(elem) {
  // حذف کلاس 'active' از تمام دسته‌بندی‌ها
  document.querySelectorAll('.category').forEach(cat => {
    cat.classList.remove('active');
  });

  // اضافه کردن کلاس 'active' به دسته‌بندی انتخاب شده
  elem.classList.add('active');

  // دریافت دسته‌بندی بر اساس data-id
  const categoryId = elem.getAttribute('data-id');

  // فیلتر کردن آگهی‌ها بر اساس دسته‌بندی انتخابی
  filterJobs(categoryId);
}

function filterJobs(categoryId) {
  const jobCards = document.querySelectorAll('.job-card');

  if (categoryId === "همه") {
    // نمایش تمام آگهی‌ها
    jobCards.forEach(card => {
      card.style.opacity = "0";
      card.style.display = "block";
      setTimeout(() => {
        card.style.opacity = "1";
      }, 0);
    });
  } else {
    // فیلتر کردن آگهی‌ها بر اساس دسته‌بندی
    jobCards.forEach(card => {
      if (card.dataset.category == categoryId) {
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
