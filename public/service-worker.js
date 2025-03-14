// public/service-worker.js

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open('event-reminder-cache').then((cache) => {
            return cache.addAll([
                '/',
                '/events',
                '/events/upcoming',
                '/events/completed',
                '/css/app.css',
                '/js/app.js',
                '/images/logo.png', // Add all assets to cache
            ]);
        })
    );
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            return cachedResponse || fetch(event.request);
        })
    );
});

self.addEventListener('sync', (event) => {
    if (event.tag === 'sync-participants') {
        // Sync logic for unsynced participants when online
        event.waitUntil(syncParticipants());
    }
});

// Sync function for participants
async function syncParticipants() {
    // Get unsynced data from localStorage or IndexedDB
    const unsyncedParticipants = JSON.parse(localStorage.getItem('unsyncedParticipants')) || [];
    
    for (let participant of unsyncedParticipants) {
        try {
            const response = await fetch('/api/participants', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(participant),
            });

            if (response.ok) {
                // Remove synced participants from localStorage
                const index = unsyncedParticipants.indexOf(participant);
                if (index > -1) unsyncedParticipants.splice(index, 1);
                localStorage.setItem('unsyncedParticipants', JSON.stringify(unsyncedParticipants));
            }
        } catch (error) {
            console.error('Error syncing participant:', error);
        }
    }
}
