const base = document.createElement('base');
if (location.hostname.includes('github.io')) {
    base.href = '/valermo-weddings_C-J/';
} else {
    base.href = '/';
}
document.head.appendChild(base);