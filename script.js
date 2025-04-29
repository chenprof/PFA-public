const userIcon = document.getElementById('userIcon');
const sidebar = document.getElementById('sidebar');

// Toggle sidebar quand on clique sur l'icône utilisateur
userIcon.addEventListener('click', (e) => {
  e.stopPropagation();
  sidebar.classList.toggle('open');
});

// Fermer la sidebar si on clique ailleurs
document.addEventListener('click', (e) => {
  if (!sidebar.contains(e.target) && !userIcon.contains(e.target)) {
    sidebar.classList.remove('open');
  }
});

window.addEventListener('DOMContentLoaded', () => {
  const username = localStorage.getItem('username');
  const niveau = localStorage.getItem('niveau');

  if (username) {
    const usernameElement = document.getElementById('username');
    if (usernameElement) {
      usernameElement.textContent = username;
    }
    const welcomeMessage = document.querySelector('header h1');
    if (welcomeMessage) {
      welcomeMessage.textContent = `Bienvenue ${username} !`;
    }
  }

  if (niveau) {
    const niveauElement = document.querySelector('.niveau');
    if (niveauElement) {
      niveauElement.textContent = niveau;
    }
  }
});
const username = localStorage.getItem('username');
const welcomeTitle = document.getElementById('welcomeTitle');

if (username && welcomeTitle) {
    welcomeTitle.textContent = `Bienvenue ${username} !`;
}
if (localStorage.length === 0) {
  console.log("Le localStorage est vide !");
} else {
  console.log("Le localStorage contient des données.");
}
