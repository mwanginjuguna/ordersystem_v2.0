export function useFormatTime () {
    function formatTime(time) {
        // Create a new Date object from the given time string.
        const date = new Date(time);

        // Get the difference between the current time and the given time.
        const diff = date.getTime() - Date.now();

        // Convert the difference to days, hours, and minutes.
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

        // Check if the given time is in the past or future.
        const isPast = diff < 0;

        // Return a human readable string of the time difference.
        return `${days ? days + " days " : ""}${hours ? hours + " hrs " : ""}${minutes} min ${isPast ? "ago" : "from now"}`;
    }
    return {formatTime}
}
