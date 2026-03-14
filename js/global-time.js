setInterval(() => {
  let current_time = document.getElementById('current-time');
  let days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
  let d = new Date();
  current_time.textContent = `${days[d.getDay()]} ${d.toLocaleDateString('fr-FR')} ${d.toLocaleTimeString('fr-FR')}`;
}, 100);