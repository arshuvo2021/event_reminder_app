
function addParticipant(eventId, name, email) {
    const participant = { eventId, name, email };

    if (navigator.onLine) {
        // Send data to the server if online
        fetch(`/events/${eventId}/participants`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(participant)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Participant added successfully');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        // Store unsynced data in localStorage if offline
        let unsyncedParticipants = JSON.parse(localStorage.getItem('unsyncedParticipants')) || [];
        unsyncedParticipants.push(participant);
        localStorage.setItem('unsyncedParticipants', JSON.stringify(unsyncedParticipants));
        
        alert('You are offline, the participant will be synced once you are back online.');
    }
}
