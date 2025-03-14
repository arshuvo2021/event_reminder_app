import './bootstrap';

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
        .then((registration) => {
            console.log('Service Worker registered:', registration);
        })
        .catch((error) => {
            console.log('Service Worker registration failed:', error);
        });
}

// Detect when the user is back online and sync data
window.addEventListener('online', () => {
    // Sync unsynced participants once the user is online
    navigator.serviceWorker.ready.then((registration) => {
        return registration.sync.register('sync-participants');
    });
});
