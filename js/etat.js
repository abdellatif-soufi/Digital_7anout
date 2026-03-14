// Export functionality
document.querySelectorAll('.btn-export').forEach(btn => {
  btn.addEventListener('click', () => {
    alert('Export vers Excel - Fonctionnalité à implémenter');
  });
});

// Print functionality
document.querySelectorAll('.btn-print').forEach(btn => {
  btn.addEventListener('click', () => {
    window.print();
  });
});